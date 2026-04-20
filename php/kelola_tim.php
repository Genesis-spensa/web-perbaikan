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
  <title>Kelola Tim - Genesis Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
  <div class="max-w-5xl mx-auto px-4 py-6">
    <header class="flex items-center justify-between mb-4">
      <div>
        <h1 class="text-xl font-semibold">Kelola Tim</h1>
        <p class="text-xs text-slate-400">
          Halaman dummy untuk pengelolaan anggota tim / admin. Nanti bisa dihubungkan dengan tabel user di database.
        </p>
      </div>
      <a href="dashboard.php" class="text-sm text-sky-300 hover:text-sky-100">← Kembali ke Dashboard</a>
    </header>

    <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
      <button type="button" class="inline-flex items-center rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-medium hover:bg-emerald-500">
        + Anggota Baru (dummy)
      </button>
      <span class="text-[11px] text-slate-400">
        Field yang tersedia: foto (URL), jabatan, media sosial, deskripsi singkat, email kontak.
        Silakan sambungkan ke database sesuai struktur tabel Anda.
      </span>
    </div>

    <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-4">
      <h2 class="text-sm font-semibold mb-3">Daftar Tim (statis)</h2>
      <div class="grid gap-3 md:grid-cols-2">
        <!-- Anggota 1 -->
        <article class="rounded-xl border border-slate-700/80 bg-slate-950/60 p-3.5 flex gap-3 hover:border-emerald-400/70 hover:bg-slate-900/80 transition-colors duration-200">
          <div class="shrink-0">
            <div class="h-14 w-14 rounded-full border border-emerald-400/70 bg-slate-900/80 flex items-center justify-center text-sm font-semibold">
              Foto
            </div>
          </div>
          <div class="flex-1">
            <div class="flex items-start justify-between gap-2">
              <div>
                <p class="text-sm font-semibold text-slate-100">rrfkyyy</p>
                <p class="text-[11px] text-emerald-300/90">Ketua</p>
              </div>
              <a href="../tim-detail.html?id=1" class="text-[11px] text-sky-300 hover:text-sky-100">
                Lihat halaman publik
              </a>
            </div>
            <p class="mt-1 text-[11px] text-slate-300 line-clamp-2">
              Deskripsi singkat peran dan fokus kerja ketua tim.
            </p>
            <div class="mt-2 flex flex-wrap items-center gap-2 text-[11px]">
              <span class="text-slate-400">email: <span class="text-slate-100">ketua@genesis.test</span></span>
              <span class="h-1 w-1 rounded-full bg-slate-600"></span>
              <span class="text-slate-400">IG: <span class="text-slate-100">@genesis_ketua</span></span>
            </div>
          </div>
        </article>

        <!-- Anggota 2 -->
        <article class="rounded-xl border border-slate-700/80 bg-slate-950/60 p-3.5 flex gap-3 hover:border-emerald-400/70 hover:bg-slate-900/80 transition-colors duration-200">
          <div class="shrink-0">
            <div class="h-14 w-14 rounded-full border border-emerald-400/70 bg-slate-900/80 flex items-center justify-center text-sm font-semibold">
              Foto
            </div>
          </div>
          <div class="flex-1">
            <div class="flex items-start justify-between gap-2">
              <div>
                <p class="text-sm font-semibold text-slate-100">rrfkyyy</p>
                <p class="text-[11px] text-emerald-300/90">Program</p>
              </div>
              <a href="../tim-detail.html?id=2" class="text-[11px] text-sky-300 hover:text-sky-100">
                Lihat halaman publik
              </a>
            </div>
            <p class="mt-1 text-[11px] text-slate-300 line-clamp-2">
              Mengembangkan dan mengawal program-program utama Genesis.
            </p>
            <div class="mt-2 flex flex-wrap items-center gap-2 text-[11px]">
              <span class="text-slate-400">email: <span class="text-slate-100">program@genesis.test</span></span>
              <span class="h-1 w-1 rounded-full bg-slate-600"></span>
              <span class="text-slate-400">IG: <span class="text-slate-100">@genesis_program</span></span>
            </div>
          </div>
        </article>

        <!-- Anggota 3 -->
        <article class="rounded-xl border border-slate-700/80 bg-slate-950/60 p-3.5 flex gap-3 hover:border-emerald-400/70 hover:bg-slate-900/80 transition-colors duration-200">
          <div class="shrink-0">
            <div class="h-14 w-14 rounded-full border border-emerald-400/70 bg-slate-900/80 flex items-center justify-center text-sm font-semibold">
              Foto
            </div>
          </div>
          <div class="flex-1">
            <div class="flex items-start justify-between gap-2">
              <div>
                <p class="text-sm font-semibold text-slate-100">rrfkyyy</p>
                <p class="text-[11px] text-emerald-300/90">Operasional</p>
              </div>
              <a href="../tim-detail.html?id=3" class="text-[11px] text-sky-300 hover:text-sky-100">
                Lihat halaman publik
              </a>
            </div>
            <p class="mt-1 text-[11px] text-slate-300 line-clamp-2">
              Menjaga operasional harian dan koordinasi lintas divisi.
            </p>
            <div class="mt-2 flex flex-wrap items-center gap-2 text-[11px]">
              <span class="text-slate-400">email: <span class="text-slate-100">ops@genesis.test</span></span>
              <span class="h-1 w-1 rounded-full bg-slate-600"></span>
              <span class="text-slate-400">IG: <span class="text-slate-100">@genesis_ops</span></span>
            </div>
          </div>
        </article>
      </div>
    </div>
  </div>
</body>
</html>

