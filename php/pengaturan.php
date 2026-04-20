<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// ------- SEO SETTINGS (disimpan di data/seo.json) -------
$seoFile = __DIR__ . '/data/seo.json';

function loadSeo($file)
{
    if (!file_exists($file)) {
        return [];
    }
    $json = file_get_contents($file);
    if ($json === false || trim($json) === '') {
        return [];
    }
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

$seoData = loadSeo($seoFile);
$seoMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save_seo') {
    $page = $_POST['page'] ?? 'home';
    $title = trim($_POST['meta_title'] ?? '');
    $desc  = trim($_POST['meta_description'] ?? '');

    if (!isset($seoData[$page])) {
        $seoData[$page] = [];
    }
    $seoData[$page]['title'] = $title;
    $seoData[$page]['description'] = $desc;

    $dir = dirname($seoFile);
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    $encoded = json_encode($seoData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($seoFile, $encoded, LOCK_EX);
    $seoMessage = 'Pengaturan SEO berhasil disimpan.';
}

// Bantuan untuk ambil nilai form saat ini
function currentSeo($data, $page, $key)
{
    return htmlspecialchars($data[$page][$key] ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengaturan - Genesis Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
  <div class="max-w-5xl mx-auto px-4 py-6">
    <header class="flex items-center justify-between mb-6">
      <h1 class="text-xl font-semibold">Pengaturan Sistem</h1>
      <a href="dashboard.php" class="text-sm text-sky-300 hover:text-sky-100">← Kembali ke Dashboard</a>
    </header>

    <div class="grid gap-4 md:grid-cols-2">
      <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-4">
        <h2 class="text-sm font-semibold mb-3">Informasi Umum</h2>
        <p class="text-xs text-slate-400 mb-3">
          Halaman ini masih berupa template. Silakan tambahkan form penyimpanan pengaturan (nama situs, deskripsi, dsb) sesuai kebutuhan.
        </p>
        <form class="space-y-3">
          <div>
            <label class="block text-xs text-slate-300 mb-1">Nama Situs</label>
            <input type="text" class="w-full rounded-lg border border-slate-700 bg-slate-950/60 px-3 py-2 text-sm" placeholder="Genesis Media">
          </div>
          <div>
            <label class="block text-xs text-slate-300 mb-1">Tagline</label>
            <input type="text" class="w-full rounded-lg border border-slate-700 bg-slate-950/60 px-3 py-2 text-sm" placeholder="Mini CMS Dashboard">
          </div>
          <button type="button" class="mt-2 inline-flex items-center gap-2 rounded-lg bg-sky-600 px-4 py-1.5 text-xs font-medium hover:bg-sky-500">
            Simpan (dummy)
          </button>
        </form>
      </section>

      <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-4">
        <h2 class="text-sm font-semibold mb-3">Status</h2>
        <ul class="text-xs text-slate-300 space-y-1.5">
          <li>• Halaman ini sudah aktif dari menu Dashboard.</li>
          <li>• Tombol simpan belum terhubung ke database (hanya tampilan).</li>
          <li>• Silakan integrasikan dengan tabel pengaturan di database Anda.</li>
        </ul>
      </section>

      <!-- SEO Settings -->
      <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-4 md:col-span-2">
        <h2 class="text-sm font-semibold mb-2">SEO Setting (Meta Title & Description)</h2>
        <p class="text-xs text-slate-400 mb-3">
          Simpan meta title & description untuk halaman penting (home, berita, artikel, dsb). Saat ini disimpan di
          <code>data/seo.json</code>. Untuk dipakai, halaman frontend (mis. <code>index.html</code>) perlu diubah ke PHP dan membaca file ini.
        </p>
        <?php if ($seoMessage): ?>
          <p class="mb-3 rounded-lg border border-emerald-500/60 bg-emerald-500/10 px-3 py-2 text-[11px] text-emerald-200">
            <?= htmlspecialchars($seoMessage, ENT_QUOTES, 'UTF-8') ?>
          </p>
        <?php endif; ?>
        <form method="post" class="space-y-3 text-xs">
          <input type="hidden" name="action" value="save_seo">
          <div class="grid gap-3 md:grid-cols-3">
            <div>
              <label class="block text-slate-300 mb-1">Halaman</label>
              <select name="page" class="w-full rounded-lg border border-slate-700 bg-slate-950/60 px-3 py-2 text-sm">
                <option value="home">Home</option>
                <option value="tentang">Tentang</option>
                <option value="sejarah">Sejarah</option>
                <option value="program">Program</option>
                <option value="berita">Berita</option>
                <option value="artikel">Artikel</option>
                <option value="kegiatan">Kegiatan</option>
                <option value="tim">Tim</option>
              </select>
            </div>
            <div class="md:col-span-2">
              <label class="block text-slate-300 mb-1">Meta Title</label>
              <input name="meta_title" type="text"
                     class="w-full rounded-lg border border-slate-700 bg-slate-950/60 px-3 py-2 text-sm"
                     placeholder="Judul SEO, mis: Genesis - Media Belajar Komunitas">
            </div>
          </div>
          <div>
            <label class="block text-slate-300 mb-1">Meta Description</label>
            <textarea name="meta_description" rows="3"
                      class="w-full rounded-lg border border-slate-700 bg-slate-950/60 px-3 py-2 text-sm"
                      placeholder="Deskripsi singkat (disarankan 140–160 karakter)"></textarea>
          </div>
          <button type="submit"
                  class="inline-flex items-center rounded-lg bg-sky-600 px-4 py-1.5 text-xs font-medium hover:bg-sky-500">
            Simpan SEO
          </button>
        </form>
      </section>
    </div>
  </div>
</body>
</html>

