<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kelola Sejarah - Genesis Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
  <div class="max-w-5xl mx-auto px-4 py-6">
    <header class="flex items-center justify-between mb-4">
      <div>
        <h1 class="text-xl font-semibold">Kelola Sejarah</h1>
        <p class="text-xs text-slate-400">
          Halaman dummy untuk konten sejarah. Bisa satu record panjang atau beberapa bagian (timeline).
        </p>
      </div>
      <a href="dashboard.php" class="text-sm text-sky-300 hover:text-sky-100">← Kembali ke Dashboard</a>
    </header>

    <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-4 space-y-3">
      <h2 class="text-sm font-semibold">Konten Sejarah (dummy)</h2>
      <p class="text-xs text-slate-400">
        Di sini nanti Anda bisa tarik data sejarah dari database (misalnya tabel <code>sejarah</code>), kemudian mengedit dan menyimpannya kembali.
      </p>
      <form class="space-y-3">
        <div>
          <label class="block text-xs text-slate-300 mb-1">Judul Bagian</label>
          <input type="text" class="w-full rounded-lg border border-slate-700 bg-slate-950/60 px-3 py-2 text-sm" placeholder="Sejarah Genesis">
        </div>
        <div>
          <label class="block text-xs text-slate-300 mb-1">Isi</label>
          <textarea rows="6" class="w-full rounded-lg border border-slate-700 bg-slate-950/60 px-3 py-2 text-sm" placeholder="Tuliskan sejarah secara ringkas di sini..."></textarea>
        </div>
        <button type="button" class="inline-flex items-center rounded-lg bg-sky-600 px-4 py-1.5 text-xs font-medium hover:bg-sky-500">
          Simpan (dummy)
        </button>
        <p class="text-[11px] text-slate-500">
          Tombol ini belum melakukan UPDATE ke database. Tambahkan query sendiri sesuai struktur tabel Anda.
        </p>
      </form>
    </section>
  </div>
</body>
</html>

