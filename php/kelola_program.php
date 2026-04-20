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
  <title>Kelola Program - Genesis Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
  <div class="max-w-5xl mx-auto px-4 py-6">
    <header class="flex items-center justify-between mb-4">
      <div>
        <h1 class="text-xl font-semibold">Kelola Program</h1>
        <p class="text-xs text-slate-400">
          Halaman dummy untuk pengelolaan program. Nanti bisa dihubungkan dengan tabel program di database.
        </p>
      </div>
      <a href="dashboard.php" class="text-sm text-sky-300 hover:text-sky-100">← Kembali ke Dashboard</a>
    </header>

    <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
      <button type="button" class="inline-flex items-center rounded-lg bg-sky-600 px-3 py-1.5 text-xs font-medium hover:bg-sky-500">
        + Program Baru (dummy)
      </button>
      <span class="text-[11px] text-slate-400">Silakan ganti dengan form CREATE/UPDATE program sesuai kebutuhan.</span>
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900/70 p-4">
      <h2 class="text-sm font-semibold mb-3">Daftar Program (statis)</h2>
      <ul class="text-xs text-slate-300 space-y-1.5">
        <li>• Genesis Studio</li>
        <li>• Inkubasi UMKM</li>
        <li>• Kelas Menulis</li>
      </ul>
    </div>
  </div>
</body>
</html>

