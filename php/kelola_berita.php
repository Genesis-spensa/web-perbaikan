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
  <title>Kelola Berita - Genesis Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
  <div class="max-w-6xl mx-auto px-4 py-6">
    <header class="flex items-center justify-between mb-4">
      <div>
        <h1 class="text-xl font-semibold">Kelola Berita</h1>
        <p class="text-xs text-slate-400">
          Halaman dummy untuk pengelolaan berita. Nanti bisa dihubungkan dengan tabel berita (banyak record).
        </p>
      </div>
      <a href="dashboard.php" class="text-sm text-sky-300 hover:text-sky-100">← Kembali ke Dashboard</a>
    </header>

    <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
      <button type="button" class="inline-flex items-center rounded-lg bg-sky-600 px-3 py-1.5 text-xs font-medium hover:bg-sky-500">
        + Berita Baru (dummy)
      </button>
      <span class="text-[11px] text-slate-400">Silakan ganti dengan form CREATE/UPDATE berita & query database.</span>
    </div>

    <div class="overflow-x-auto rounded-xl border border-slate-800 bg-slate-900/70">
      <table class="w-full text-left text-xs text-slate-300 border-collapse">
        <thead>
          <tr class="bg-slate-900 text-[11px] uppercase tracking-wide text-slate-400">
            <th class="px-3 py-2.5 font-medium">Judul</th>
            <th class="px-3 py-2.5 font-medium whitespace-nowrap">Tanggal</th>
            <th class="px-3 py-2.5 font-medium whitespace-nowrap">Penulis</th>
            <th class="px-3 py-2.5 font-medium whitespace-nowrap">Kategori</th>
            <th class="px-3 py-2.5 font-medium text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-800/80">
          <tr class="hover:bg-slate-900/80">
            <td class="px-3 py-2.5">Berita Contoh 1</td>
            <td class="px-3 py-2.5 whitespace-nowrap">01 Jan 2026</td>
            <td class="px-3 py-2.5 whitespace-nowrap">Redaksi</td>
            <td class="px-3 py-2.5 whitespace-nowrap">Umum</td>
            <td class="px-3 py-2.5 whitespace-nowrap text-right">
              <a href="#" class="text-[11px] text-sky-300 hover:text-sky-100 mr-2">Edit (dummy)</a>
              <a href="#" class="text-[11px] text-rose-300 hover:text-rose-100">Hapus (dummy)</a>
            </td>
          </tr>
          <tr class="hover:bg-slate-900/80">
            <td class="px-3 py-2.5">Berita Contoh 2</td>
            <td class="px-3 py-2.5 whitespace-nowrap">02 Jan 2026</td>
            <td class="px-3 py-2.5 whitespace-nowrap">Redaksi</td>
            <td class="px-3 py-2.5 whitespace-nowrap">Program</td>
            <td class="px-3 py-2.5 whitespace-nowrap text-right">
              <a href="#" class="text-[11px] text-sky-300 hover:text-sky-100 mr-2">Edit (dummy)</a>
              <a href="#" class="text-[11px] text-rose-300 hover:text-rose-100">Hapus (dummy)</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>

