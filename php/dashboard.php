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
    <title>Admin Dashboard - Genesis</title>

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Inter', 'system-ui', 'sans-serif'],
            },
            colors: {
              'bg-dark-1': '#050816',
              'bg-dark-2': '#0f172a',
              'glass': 'rgba(15,23,42,0.72)',
              'neon-blue': '#38bdf8',
              'neon-purple': '#a855f7',
            },
            boxShadow: {
              'neon': '0 0 25px rgba(56,189,248,0.45)',
            },
          }
        }
      }
    </script>

    <!-- Custom styles -->
    <style>
      body {
        background:
          radial-gradient(circle at top left, rgba(56,189,248,0.25), transparent 55%),
          radial-gradient(circle at bottom right, rgba(168,85,247,0.24), transparent 55%),
          linear-gradient(135deg, #050816 0%, #020617 40%, #0b1120 100%);
        color: #e5e7eb;
        font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      }

      .glass-card {
        background: linear-gradient(145deg, rgba(15,23,42,0.92), rgba(15,23,42,0.78));
        border: 1px solid rgba(148,163,184,0.24);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
      }

      .neon-button {
        position: relative;
        overflow: hidden;
      }
      .neon-button::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(56,189,248,0.6), rgba(168,85,247,0.7));
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
      }
      .neon-button:hover::before {
        opacity: 0.22;
      }

      .sidebar-gradient {
        background:
          linear-gradient(180deg, rgba(15,23,42,0.98), rgba(15,23,42,0.94)),
          radial-gradient(circle at top, rgba(56,189,248,0.22), transparent 55%);
      }

      .menu-item-active {
        background: linear-gradient(90deg, rgba(56,189,248,0.18), rgba(168,85,247,0.16));
        border-left: 3px solid #38bdf8;
      }

      .menu-item:hover {
        background-color: rgba(15,23,42,0.9);
      }

      .fade-in {
        animation: fadeIn 0.45s ease-out;
      }
      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
      }

      @media (max-width: 1023px) {
        #sidebar {
          transition: transform 0.28s ease;
        }
        #sidebar[data-open="false"] {
          transform: translateX(-100%);
        }
      }
    </style>
</head>
<body class="min-h-screen">
<div class="flex min-h-screen">
  <!-- Sidebar -->
  <aside id="sidebar"
         data-open="true"
         class="sidebar-gradient fixed inset-y-0 left-0 z-30 w-64 border-r border-slate-800/70 px-4 py-5 flex flex-col gap-6 lg:translate-x-0 lg:static">
    <!-- Logo -->
    <div class="flex items-center gap-3 px-2">
      <div class="h-9 w-9 rounded-2xl bg-slate-900/90 border border-slate-700/60 flex items-center justify-center shadow-neon">
        <span class="text-neon-blue font-semibold text-lg">G</span>
      </div>
      <div>
        <p class="text-sm font-semibold tracking-wide text-slate-100">Genesis Admin</p>
        <p class="text-[11px] text-slate-400">Mini CMS Dashboard</p>
      </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-2 flex-1 overflow-y-auto">
      <p class="px-2 text-[11px] uppercase tracking-[0.18em] text-slate-500 mb-2">Navigasi</p>
      <ul id="menuList" class="space-y-1 text-sm">
        <li>
          <a href="#"
             data-page="dashboard"
             class="menu-item flex items-center gap-2 rounded-xl px-3 py-2.5 text-slate-200 hover:text-white transition-colors duration-200 cursor-pointer menu-item-active">
            <span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-slate-900/70 text-[13px] text-neon-blue">
              ◼
            </span>
            <span>Dashboard</span>
          </a>
        </li>
        <li><a href="../index.html#tentang"  data-page="tentang"  class="menu-item flex items-center gap-2 rounded-xl px-3 py-2.5 text-slate-300 hover:text-white transition-colors duration-200 cursor-pointer"><span class="w-1 h-1 rounded-full bg-slate-500"></span><span>Tentang</span></a></li>
        <li><a href="../sejarah.html"        data-page="sejarah"  class="menu-item flex items-center gap-2 rounded-xl px-3 py-2.5 text-slate-300 hover:text-white transition-colors duration-200 cursor-pointer"><span class="w-1 h-1 rounded-full bg-slate-500"></span><span>Sejarah</span></a></li>
        <li><a href="../program.html"        data-page="program"  class="menu-item flex items-center gap-2 rounded-xl px-3 py-2.5 text-slate-300 hover:text-white transition-colors duration-200 cursor-pointer"><span class="w-1 h-1 rounded-full bg-slate-500"></span><span>Program</span></a></li>
        <li><a href="../berita.html"         data-page="berita"   class="menu-item flex items-center gap-2 rounded-xl px-3 py-2.5 text-slate-300 hover:text-white transition-colors duration-200 cursor-pointer"><span class="w-1 h-1 rounded-full bg-slate-500"></span><span>Berita</span></a></li>
        <li><a href="../artikel.html"        data-page="artikel"  class="menu-item flex items-center gap-2 rounded-xl px-3 py-2.5 text-slate-300 hover:text-white transition-colors duration-200 cursor-pointer"><span class="w-1 h-1 rounded-full bg-slate-500"></span><span>Artikel</span></a></li>
        <li><a href="../kegiatan.html"       data-page="kegiatan" class="menu-item flex items-center gap-2 rounded-xl px-3 py-2.5 text-slate-300 hover:text-white transition-colors duration-200 cursor-pointer"><span class="w-1 h-1 rounded-full bg-slate-500"></span><span>Kegiatan</span></a></li>
        <li><a href="../tim.html"            data-page="tim"      class="menu-item flex items-center gap-2 rounded-xl px-3 py-2.5 text-slate-300 hover:text-white transition-colors duration-200 cursor-pointer"><span class="w-1 h-1 rounded-full bg-slate-500"></span><span>Tim</span></a></li>
      </ul>

      <p class="px-2 mt-6 text-[11px] uppercase tracking-[0.18em] text-slate-500 mb-2">Akun</p>
      <ul class="space-y-1 text-sm">
        <li>
          <a href="kelola_admin.php"
             class="menu-item flex w-full items-center gap-2 rounded-xl px-3 py-2.5 text-slate-300 hover:text-slate-50 transition-colors duration-200 cursor-pointer">
            <span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-slate-900/80 text-[13px]">
              🛠
            </span>
            <span>Kelola Admin</span>
          </a>
        </li>
        <li>
          <a href="logout.php"
             class="menu-item flex w-full items-center gap-2 rounded-xl px-3 py-2.5 text-rose-300 hover:text-rose-100 hover:bg-rose-900/30 transition-colors duration-200 cursor-pointer">
            <span class="inline-flex h-6 w-6 items-center justify-center rounded-lg bg-rose-900/80 text-[13px]">
              ⏻
            </span>
            <span>Logout</span>
          </a>
        </li>
      </ul>
    </nav>

    <!-- Footer small -->
    <div class="mt-4 border-t border-slate-800/70 pt-3 text-[11px] text-slate-500 flex items-center justify-between">
      <span>© <span id="year"></span> Genesis</span>
      <span class="text-slate-400/80">Admin</span>
    </div>
  </aside>

  <!-- Main content -->
  <div class="flex-1 flex flex-col min-h-screen lg:ml-0">
    <!-- Top navbar -->
    <header class="sticky top-0 z-20 border-b border-slate-800/60 bg-slate-950/70 backdrop-blur-xl">
      <div class="flex items-center justify-between px-4 py-3 lg:px-6">
        <!-- Left: mobile toggle + title -->
        <div class="flex items-center gap-3">
          <button id="sidebarToggle"
                  class="inline-flex items-center justify-center h-9 w-9 rounded-xl border border-slate-700/80 bg-slate-900/80 text-slate-200 lg:hidden hover:border-neon-blue/70 hover:text-neon-blue transition-colors duration-200">
            ☰
          </button>
          <div>
            <p class="text-sm font-semibold tracking-wide text-slate-100">Dashboard</p>
            <p class="text-xs text-slate-400">Ringkasan singkat aktivitas konten</p>
          </div>
        </div>

        <!-- Right: admin info -->
        <div class="flex items-center gap-3">
          <div class="hidden sm:flex flex-col items-end">
            <span class="text-sm font-medium text-slate-100">
              <?php
                $u = $_SESSION['user']['username'] ?? 'Administrator';
                echo htmlspecialchars($u, ENT_QUOTES, 'UTF-8');
              ?>
            </span>
            <span class="text-xs text-slate-400">
              <?php
                $role = $_SESSION['user']['role'] ?? 'admin';
                echo $role === 'admin' ? 'Admin' : 'Editor';
              ?>
            </span>
          </div>
          <div class="h-9 w-9 rounded-full bg-gradient-to-tr from-neon-blue to-neon-purple flex items-center justify-center text-xs font-semibold text-slate-950 shadow-neon">
            GM
          </div>
        </div>
      </div>
    </header>

    <!-- Scrollable content -->
    <main class="flex-1 px-4 py-5 lg:px-7 lg:py-7 fade-in">
      <!-- Stats cards -->
      <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4 mb-6">
        <article class="glass-card rounded-2xl p-4 md:p-5 shadow-lg shadow-slate-900/60 border-slate-800/80 hover:shadow-neon transition-shadow duration-300">
          <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-medium tracking-wide text-slate-400 uppercase">Total Artikel</p>
            <span class="inline-flex items-center rounded-full bg-emerald-500/15 px-2 py-0.5 text-[11px] text-emerald-300 border border-emerald-400/40">
              Live
            </span>
          </div>
          <p class="text-2xl font-semibold text-slate-50">24</p>
          <p class="mt-1 text-xs text-emerald-300/90">+3 artikel minggu ini</p>
        </article>

        <article class="glass-card rounded-2xl p-4 md:p-5 shadow-lg shadow-slate-900/60 border-slate-800/80 hover:shadow-neon transition-shadow duration-300">
          <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-medium tracking-wide text-slate-400 uppercase">Total Program</p>
            <span class="inline-flex items-center rounded-full bg-sky-500/15 px-2 py-0.5 text-[11px] text-sky-300 border border-sky-400/40">
              Aktif
            </span>
          </div>
          <p class="text-2xl font-semibold text-slate-50">6</p>
          <p class="mt-1 text-xs text-sky-300/90">2 program berjalan</p>
        </article>

        <article class="glass-card rounded-2xl p-4 md:p-5 shadow-lg shadow-slate-900/60 border-slate-800/80 hover:shadow-neon transition-shadow duration-300">
          <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-medium tracking-wide text-slate-400 uppercase">Kegiatan Bulan Ini</p>
            <span class="inline-flex items-center rounded-full bg-violet-500/15 px-2 py-0.5 text-[11px] text-violet-300 border border-violet-400/40">
              Event
            </span>
          </div>
          <p class="text-2xl font-semibold text-slate-50">4</p>
          <p class="mt-1 text-xs text-violet-300/90">Termasuk 1 besar</p>
        </article>

        <article class="glass-card rounded-2xl p-4 md:p-5 shadow-lg shadow-slate-900/60 border-slate-800/80 hover:shadow-neon transition-shadow duration-300">
          <div class="flex items-center justify-between mb-3">
            <p class="text-xs font-medium tracking-wide text-slate-400 uppercase">Anggota Tim</p>
            <span class="inline-flex items-center rounded-full bg-amber-500/15 px-2 py-0.5 text-[11px] text-amber-300 border border-amber-400/40">
              Aktif
            </span>
          </div>
          <p class="text-2xl font-semibold text-slate-50">12</p>
          <p class="mt-1 text-xs text-amber-300/90">3 pengurus utama</p>
        </article>
      </section>

      <!-- Actions row -->
      <section class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h2 class="text-base font-semibold text-slate-100">Manajemen Konten</h2>
          <p class="text-xs text-slate-400 mt-0.5">Kelola artikel, berita, dan program dalam satu tempat.</p>
        </div>
        <div class="flex flex-wrap gap-2">
          <a href="../upload.html"
             class="neon-button inline-flex items-center gap-2 rounded-xl border border-neon-blue/60 bg-slate-900/70 px-4 py-2 text-sm font-medium text-sky-100 shadow-md hover:shadow-neon transition duration-300">
            <span class="h-6 w-6 inline-flex items-center justify-center rounded-lg bg-sky-500/20 text-neon-blue text-xs">＋</span>
            <span>Tambah Artikel</span>
          </a>
          <a href="pengaturan.php"
             class="neon-button inline-flex items-center gap-2 rounded-xl border border-neon-purple/60 bg-slate-900/70 px-4 py-2 text-sm font-medium text-violet-100 hover:shadow-neon transition duration-300">
            <span class="h-6 w-6 inline-flex items-center justify-center rounded-lg bg-violet-500/20 text-neon-purple text-xs">⚙</span>
            <span>Pengaturan</span>
          </a>
        </div>
      </section>

      <!-- Main grid: recent table + side panel -->
      <section class="grid gap-5 lg:grid-cols-3">
        <!-- Table -->
        <div class="glass-card rounded-2xl p-4 md:p-5 shadow-lg shadow-slate-900/60 border-slate-800/80 lg:col-span-2 overflow-hidden">
          <div class="flex items-center justify-between mb-3">
            <div>
              <h3 class="text-sm font-semibold text-slate-100">Artikel Terbaru</h3>
              <p class="text-xs text-slate-400">5 artikel terakhir yang dipublikasikan.</p>
            </div>
            <a href="artikel_list.php"
               class="text-[11px] px-2.5 py-1 rounded-lg border border-slate-700/80 text-slate-300 hover:border-neon-blue/70 hover:text-neon-blue transition-colors duration-200">
              Lihat semua
            </a>
          </div>

          <div class="overflow-x-auto mt-3">
            <table class="w-full text-left text-xs text-slate-300 border-collapse">
              <thead>
              <tr class="bg-slate-900/70 text-[11px] uppercase tracking-wide text-slate-400">
                <th class="px-3 py-2.5 font-medium">Judul</th>
                <th class="px-3 py-2.5 font-medium whitespace-nowrap">Tanggal</th>
                <th class="px-3 py-2.5 font-medium whitespace-nowrap">Penulis</th>
                <th class="px-3 py-2.5 font-medium whitespace-nowrap">Tag</th>
                <th class="px-3 py-2.5 font-medium text-right">Aksi</th>
              </tr>
              </thead>
              <tbody class="divide-y divide-slate-800/80">
              <tr class="hover:bg-slate-900/80 transition-colors duration-150">
                <td class="px-3 py-2.5">
                  <p class="truncate max-w-xs text-[13px] text-slate-100">Peluncuran Pusat Belajar Komunitas</p>
                </td>
                <td class="px-3 py-2.5 whitespace-nowrap">07 Okt 2025</td>
                <td class="px-3 py-2.5 whitespace-nowrap">Redaksi</td>
                <td class="px-3 py-2.5 whitespace-nowrap">
                  <span class="inline-flex items-center rounded-full bg-sky-500/15 px-2 py-0.5 text-[11px] text-sky-300 border border-sky-500/40">Pendidikan</span>
                </td>
                <td class="px-3 py-2.5 whitespace-nowrap text-right">
                  <a href="artikel_edit.php?id=1" class="text-[11px] text-sky-300 hover:text-sky-100 mr-2">Edit</a>
                  <a href="artikel_delete.php?id=1" class="text-[11px] text-rose-300 hover:text-rose-100">Hapus</a>
                </td>
              </tr>
              <tr class="hover:bg-slate-900/80 transition-colors duration-150">
                <td class="px-3 py-2.5">
                  <p class="truncate max-w-xs text-[13px] text-slate-100">Kolaborasi dengan 10 UMKM Lokal</p>
                </td>
                <td class="px-3 py-2.5 whitespace-nowrap">28 Sep 2025</td>
                <td class="px-3 py-2.5 whitespace-nowrap">Redaksi</td>
                <td class="px-3 py-2.5 whitespace-nowrap">
                  <span class="inline-flex items-center rounded-full bg-emerald-500/15 px-2 py-0.5 text-[11px] text-emerald-300 border border-emerald-500/40">Inkubasi</span>
                </td>
                <td class="px-3 py-2.5 whitespace-nowrap text-right">
                  <a href="artikel_edit.php?id=2" class="text-[11px] text-sky-300 hover:text-sky-100 mr-2">Edit</a>
                  <a href="artikel_delete.php?id=2" class="text-[11px] text-rose-300 hover:text-rose-100">Hapus</a>
                </td>
              </tr>
              <tr class="hover:bg-slate-900/80 transition-colors duration-150">
                <td class="px-3 py-2.5">
                  <p class="truncate max-w-xs text-[13px] text-slate-100">Rilis Laporan Riset Kebijakan Pendidikan</p>
                </td>
                <td class="px-3 py-2.5 whitespace-nowrap">15 Sep 2025</td>
                <td class="px-3 py-2.5 whitespace-nowrap">Tim Riset</td>
                <td class="px-3 py-2.5 whitespace-nowrap">
                  <span class="inline-flex items-center rounded-full bg-violet-500/15 px-2 py-0.5 text-[11px] text-violet-300 border border-violet-500/40">Riset</span>
                </td>
                <td class="px-3 py-2.5 whitespace-nowrap text-right">
                  <a href="artikel_edit.php?id=3" class="text-[11px] text-sky-300 hover:text-sky-100 mr-2">Edit</a>
                  <a href="artikel_delete.php?id=3" class="text-[11px] text-rose-300 hover:text-rose-100">Hapus</a>
                </td>
              </tr>
              <!-- Tambahkan baris lain sesuai kebutuhan -->
              </tbody>
            </table>
          </div>
        </div>

        <!-- Side panel -->
        <div class="space-y-4">
          <article class="glass-card rounded-2xl p-4 md:p-5 shadow-lg shadow-slate-900/60 border-slate-800/80">
            <h3 class="text-sm font-semibold text-slate-100 mb-1.5">Aktivitas Sistem</h3>
            <p class="text-xs text-slate-400 mb-3">Ringkasan singkat aktivitas terbaru admin.</p>
            <ul class="space-y-2.5 text-[11px] text-slate-300">
              <li class="flex items-start gap-2">
                <span class="mt-0.5 h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                <div>
                  <p>Artikel baru <span class="text-slate-100">"Peluncuran Pusat Belajar"</span> dipublikasikan.</p>
                  <p class="text-[10px] text-slate-500 mt-0.5">2 menit lalu</p>
                </div>
              </li>
              <li class="flex items-start gap-2">
                <span class="mt-0.5 h-1.5 w-1.5 rounded-full bg-sky-400"></span>
                <div>
                  <p>Program <span class="text-slate-100">"Genesis Studio"</span> diperbarui.</p>
                  <p class="text-[10px] text-slate-500 mt-0.5">1 jam lalu</p>
                </div>
              </li>
              <li class="flex items-start gap-2">
                <span class="mt-0.5 h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                <div>
                  <p>3 kegiatan baru dijadwalkan untuk bulan depan.</p>
                  <p class="text-[10px] text-slate-500 mt-0.5">Kemarin</p>
                </div>
              </li>
            </ul>
          </article>

          <article class="glass-card rounded-2xl p-4 md:p-5 shadow-lg shadow-slate-900/60 border-slate-800/80">
            <h3 class="text-sm font-semibold text-slate-100 mb-2">Quick Actions</h3>
            <div class="flex flex-wrap gap-2">
              <a href="kelola_program.php" class="neon-button px-3 py-1.5 rounded-xl border border-sky-500/70 bg-slate-900/80 text-[11px] text-sky-100 hover:shadow-neon transition duration-300">
                + Program
              </a>
              <a href="kelola_kegiatan.php" class="neon-button px-3 py-1.5 rounded-xl border border-violet-500/70 bg-slate-900/80 text-[11px] text-violet-100 hover:shadow-neon transition duration-300">
                + Kegiatan
              </a>
              <a href="kelola_tim.php" class="px-3 py-1.5 rounded-xl border border-slate-700/80 bg-slate-900/80 text-[11px] text-slate-200 hover:border-neon-blue/70 hover:text-neon-blue transition duration-300">
                Kelola Tim
              </a>
              <a href="kelola_berita.php" class="px-3 py-1.5 rounded-xl border border-amber-500/70 bg-slate-900/80 text-[11px] text-amber-100 hover:shadow-neon transition duration-300">
                Kelola Berita
              </a>
              <a href="kelola_sejarah.php" class="px-3 py-1.5 rounded-xl border border-slate-600/70 bg-slate-900/80 text-[11px] text-slate-100 hover:border-neon-blue/70 hover:text-neon-blue transition duration-300">
                Kelola Sejarah
              </a>
            </div>
          </article>
        </div>
      </section>
    </main>
  </div>
</div>

<script>
  // Tahun footer
  (function () {
    var yearEl = document.getElementById('year');
    if (yearEl) yearEl.textContent = new Date().getFullYear();
  })();

  // Sidebar mobile toggle
  (function () {
    var sidebar = document.getElementById('sidebar');
    var toggle  = document.getElementById('sidebarToggle');
    if (!sidebar || !toggle) return;

    function setOpen(open) {
      sidebar.dataset.open = open ? 'true' : 'false';
    }

    // Default: open di desktop, hidden di mobile via CSS transform
    setOpen(true);

    toggle.addEventListener('click', function () {
      var isOpen = sidebar.dataset.open === 'true';
      setOpen(!isOpen);
    });
  })();

  // Active menu highlight (bisa dikembangkan pakai URL / hash)
  (function () {
    var menuList = document.getElementById('menuList');
    if (!menuList) return;
    var items = menuList.querySelectorAll('.menu-item');
    items.forEach(function (item) {
      item.addEventListener('click', function () {
        items.forEach(function (i) { i.classList.remove('menu-item-active'); });
        this.classList.add('menu-item-active');
      });
    });
  })();
</script>
</body>
</html>

