<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hapus Artikel #<?php echo $id; ?> - Genesis Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
  <div class="max-w-xl mx-auto px-4 py-6">
    <header class="mb-4">
      <h1 class="text-xl font-semibold text-rose-300">Konfirmasi Hapus Artikel</h1>
      <p class="text-xs text-slate-400">
        Ini halaman konfirmasi dummy. Nanti Anda bisa menambahkan logika DELETE dari database berdasarkan ID artikel.
      </p>
    </header>

    <div class="rounded-xl border border-slate-800 bg-slate-900/70 p-4 space-y-3">
      <p class="text-sm">
        Anda yakin ingin menghapus artikel dengan ID <span class="font-semibold text-slate-50">#<?php echo $id; ?></span>?
      </p>
      <div class="flex flex-wrap items-center gap-2">
        <button type="button" class="inline-flex items-center rounded-lg bg-rose-600 px-4 py-1.5 text-xs font-medium hover:bg-rose-500">
          Ya, Hapus (dummy)
        </button>
        <a href="artikel_list.php" class="inline-flex items-center rounded-lg border border-slate-700 px-4 py-1.5 text-xs font-medium text-slate-200 hover:border-sky-500 hover:text-sky-300">
          Batal
        </a>
      </div>
      <p class="text-[11px] text-slate-500">
        Saat ini tombol hapus belum terhubung ke database. Tambahkan eksekusi query DELETE dan redirect sesuai kebutuhan.
      </p>
    </div>
  </div>
</body>
</html>

