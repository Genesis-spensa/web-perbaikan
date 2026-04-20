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
  <title>Edit Artikel #<?php echo $id; ?> - Genesis Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
  <div class="max-w-3xl mx-auto px-4 py-6">
    <header class="flex items-center justify-between mb-4">
      <div>
        <h1 class="text-xl font-semibold">Edit Artikel #<?php echo $id; ?></h1>
        <p class="text-xs text-slate-400">
          Halaman ini masih dummy. Nanti isi form bisa diisi dengan data artikel dari database berdasarkan ID.
        </p>
      </div>
      <a href="artikel_list.php" class="text-sm text-sky-300 hover:text-sky-100">← Kembali ke Daftar Artikel</a>
    </header>

    <form class="space-y-4 rounded-xl border border-slate-800 bg-slate-900/70 p-4">
      <div>
        <label class="block text-xs text-slate-300 mb-1">Judul</label>
        <input type="text" class="w-full rounded-lg border border-slate-700 bg-slate-950/60 px-3 py-2 text-sm" placeholder="Judul artikel...">
      </div>
      <div>
        <label class="block text-xs text-slate-300 mb-1">Konten</label>
        <textarea rows="6" class="w-full rounded-lg border border-slate-700 bg-slate-950/60 px-3 py-2 text-sm" placeholder="Isi artikel..."></textarea>
      </div>
      <div class="flex flex-wrap items-center justify-between gap-2">
        <button type="button" class="inline-flex items-center rounded-lg bg-sky-600 px-4 py-1.5 text-xs font-medium hover:bg-sky-500">
          Simpan Perubahan (dummy)
        </button>
        <span class="text-[11px] text-slate-400">
          Tombol ini belum menyimpan ke database. Tambahkan query UPDATE sendiri nanti.
        </span>
      </div>
    </form>
  </div>
</body>
</html>

