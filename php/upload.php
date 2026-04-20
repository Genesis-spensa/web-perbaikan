<?php
// upload.php
// Backend upload artikel ke data/articles.json dengan validasi & keamanan

// Mulai sesi untuk CSRF protection
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Konfigurasi dasar
$maxSize    = 2 * 1024 * 1024; // 2MB
$allowedExt = ['jpg', 'jpeg', 'png'];
$uploadDir  = __DIR__ . '/uploads';
$jsonFile   = __DIR__ . '/data/articles.json';

// Helper untuk redirect dengan pesan
function redirectWithMessage($status, $message)
{
    $url = 'upload.html?status=' . urlencode($status) .
           '&message=' . urlencode($message);
    header('Location: ' . $url);
    exit;
}

// Hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectWithMessage('error', 'Metode tidak diizinkan.');
}

// Validasi CSRF token
$postToken    = $_POST['csrf_token'] ?? '';
$sessionToken = $_SESSION['csrf_token'] ?? '';
if (!$postToken || !$sessionToken || !hash_equals($sessionToken, $postToken)) {
    redirectWithMessage('error', 'Token CSRF tidak valid.');
}

// Validasi field teks
$title       = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$author      = trim($_POST['author'] ?? '');
$tag         = trim($_POST['tag'] ?? '');

if ($title === '' || $description === '') {
    redirectWithMessage('error', 'Judul dan deskripsi wajib diisi.');
}

// Validasi upload file
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    redirectWithMessage('error', 'Gambar wajib diunggah.');
}

$file = $_FILES['image'];

// Cek ukuran
if ($file['size'] > $maxSize) {
    redirectWithMessage('error', 'Ukuran gambar melebihi 2MB.');
}

// Cek ekstensi
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (!in_array($ext, $allowedExt, true)) {
    redirectWithMessage('error', 'Hanya gambar JPG, JPEG, atau PNG yang diizinkan.');
}

// Cek MIME type
if (function_exists('finfo_open')) {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime  = $finfo->file($file['tmp_name']);
    $allowedMime = ['image/jpeg', 'image/png'];
    if (!in_array($mime, $allowedMime, true)) {
        redirectWithMessage('error', 'File yang diunggah bukan gambar valid.');
    }
}

// Pastikan folder uploads ada
if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
        redirectWithMessage('error', 'Gagal membuat folder uploads.');
    }
}

// Buat nama file unik
try {
    $baseName = bin2hex(random_bytes(16)) . '.' . $ext;
} catch (Exception $e) {
    $baseName = uniqid('img_', true) . '.' . $ext;
}
$destPath = $uploadDir . '/' . $baseName;

// Pindahkan file
if (!move_uploaded_file($file['tmp_name'], $destPath)) {
    redirectWithMessage('error', 'Gagal menyimpan file gambar.');
}

// Path yang akan disimpan di JSON (relatif dari web root)
$coverPath = 'uploads/' . $baseName;

// Pastikan file JSON ada, jika tidak buat dengan array kosong
$jsonDir = dirname($jsonFile);
if (!is_dir($jsonDir)) {
    @mkdir($jsonDir, 0755, true);
}
if (!file_exists($jsonFile)) {
    file_put_contents($jsonFile, "[]", LOCK_EX);
}

// Baca JSON lama
$articles = [];
$json = file_get_contents($jsonFile);
if ($json !== false && trim($json) !== '') {
    $decoded = json_decode($json, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        $articles = $decoded;
    }
}

// Tentukan ID berikutnya (ikuti struktur sekarang: id = string)
$nextId = 1;
foreach ($articles as $a) {
    if (isset($a['id']) && is_numeric($a['id'])) {
        $nextId = max($nextId, (int)$a['id'] + 1);
    }
}
$nextIdStr = (string)$nextId;

// Bentuk data artikel baru
$dateNow = date('Y-m-d'); // format cocok dengan data yang sudah ada

// Summary sederhana (maks ~150 karakter)
if (function_exists('mb_strimwidth')) {
    $summary = mb_strimwidth($description, 0, 150, '...', 'UTF-8');
} else {
    $summary = substr($description, 0, 147) . (strlen($description) > 150 ? '...' : '');
}

// Escape deskripsi untuk mencegah XSS
$safeDescription = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');

$newArticle = [
    'id'          => $nextIdStr,
    'title'       => $title,
    'date'        => $dateNow,
    'author'      => $author !== '' ? $author : 'Admin',
    'tags'        => $tag !== '' ? [$tag] : [],
    'summary'     => $summary,
    'cover'       => $coverPath,
    // contentHtml digunakan oleh artikel.html
    'contentHtml' => '<p>' . nl2br($safeDescription) . '</p>',
];

// Simpan artikel terbaru di urutan paling atas
array_unshift($articles, $newArticle);

// Simpan kembali ke JSON (dengan locking supaya lebih aman)
$encoded = json_encode($articles, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
if ($encoded === false) {
    redirectWithMessage('error', 'Gagal meng-encode data JSON.');
}

$fp = @fopen($jsonFile, 'c+');
if (!$fp) {
    redirectWithMessage('error', 'Tidak dapat membuka file articles.json.');
}

flock($fp, LOCK_EX);
ftruncate($fp, 0);
fwrite($fp, $encoded);
fflush($fp);
flock($fp, LOCK_UN);
fclose($fp);

redirectWithMessage('success', 'Artikel berhasil disimpan.');

