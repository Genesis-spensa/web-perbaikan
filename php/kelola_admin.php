<?php
session_start();

// Hanya boleh diakses oleh user dengan role admin
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
    header('Location: login.php');
    exit;
}

$adminsFile = __DIR__ . '/data/admins.json';

function loadAdminsInternal($file)
{
    if (!file_exists($file)) {
        return [];
    }
    $json = file_get_contents($file);
    if ($json === false || trim($json) === '') {
        return [];
    }
    $data = json_decode($json, true);
    return (is_array($data)) ? $data : [];
}

$message = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUser  = trim($_POST['username'] ?? '');
    $newPass  = trim($_POST['password'] ?? '');
    $newRole  = $_POST['role'] ?? 'editor';

    if ($newUser === '' || $newPass === '') {
        $error = 'Username dan password wajib diisi.';
    } else {
        $admins = loadAdminsInternal($adminsFile);

        // Cek duplikasi username
        foreach ($admins as $a) {
            if (isset($a['username']) && $a['username'] === $newUser) {
                $error = 'Username sudah digunakan.';
                break;
            }
        }

        if ($error === '') {
            $admins[] = [
                'username' => $newUser,
                'password' => password_hash($newPass, PASSWORD_DEFAULT),
                'role'     => $newRole === 'admin' ? 'admin' : 'editor',
            ];

            $dir = dirname($adminsFile);
            if (!is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }

            $encoded = json_encode($admins, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents($adminsFile, $encoded, LOCK_EX);
            $message = 'Admin baru berhasil ditambahkan.';
        }
    }
}

$admins = loadAdminsInternal($adminsFile);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kelola Admin - Genesis Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
  <div class="max-w-5xl mx-auto px-4 py-6">
    <header class="flex items-center justify-between mb-4">
      <div>
        <h1 class="text-xl font-semibold">Kelola Admin & Editor</h1>
        <p class="text-xs text-slate-400">
          Tambah akun baru dengan role <span class="font-semibold text-emerald-300">admin</span> atau <span class="font-semibold text-sky-300">editor</span>.
        </p>
      </div>
      <a href="dashboard.php" class="text-sm text-sky-300 hover:text-sky-100">← Kembali ke Dashboard</a>
    </header>

    <?php if ($message): ?>
      <p class="mb-3 rounded-lg border border-emerald-500/60 bg-emerald-500/10 px-3 py-2 text-xs text-emerald-200">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
      </p>
    <?php endif; ?>
    <?php if ($error): ?>
      <p class="mb-3 rounded-lg border border-rose-500/60 bg-rose-500/10 px-3 py-2 text-xs text-rose-200">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
      </p>
    <?php endif; ?>

    <div class="grid gap-4 md:grid-cols-2 mb-4">
      <!-- Form tambah admin/editor -->
      <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-4">
        <h2 class="text-sm font-semibold mb-3">Tambah Admin Baru</h2>
        <form method="post" class="space-y-3 text-xs">
          <div>
            <label class="block text-slate-300 mb-1">Username</label>
            <input name="username" type="text" required
                   class="w-full rounded-lg border border-slate-700 bg-slate-950/60 px-3 py-2 text-sm">
          </div>
          <div>
            <label class="block text-slate-300 mb-1">Password</label>
            <input name="password" type="password" required
                   class="w-full rounded-lg border border-slate-700 bg-slate-950/60 px-3 py-2 text-sm">
          </div>
          <div>
            <label class="block text-slate-300 mb-1">Role</label>
            <select name="role" class="w-full rounded-lg border border-slate-700 bg-slate-950/60 px-3 py-2 text-sm">
              <option value="admin">Admin (akses penuh)</option>
              <option value="editor">Editor (hanya konten)</option>
            </select>
          </div>
          <button type="submit"
                  class="mt-1 inline-flex items-center rounded-lg bg-emerald-600 px-4 py-1.5 text-xs font-medium hover:bg-emerald-500">
            Simpan Admin
          </button>
        </form>
      </section>

      <!-- Daftar admin -->
      <section class="rounded-xl border border-slate-800 bg-slate-900/70 p-4">
        <h2 class="text-sm font-semibold mb-3">Daftar Akun</h2>
        <?php if (empty($admins)): ?>
          <p class="text-xs text-slate-400">Belum ada akun yang terdaftar.</p>
        <?php else: ?>
          <table class="w-full text-left text-xs text-slate-300 border-collapse">
            <thead>
              <tr class="text-[11px] uppercase tracking-wide text-slate-400">
                <th class="px-2 py-1.5 font-medium">Username</th>
                <th class="px-2 py-1.5 font-medium">Role</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/80">
              <?php foreach ($admins as $a): ?>
                <tr>
                  <td class="px-2 py-1.5">
                    <?= htmlspecialchars($a['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                  </td>
                  <td class="px-2 py-1.5">
                    <?php
                      $role = $a['role'] ?? 'editor';
                      echo $role === 'admin' ? 'Admin' : 'Editor';
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
        <p class="mt-3 text-[11px] text-slate-500">
          Catatan: penghapusan / pengubahan akun bisa ditambahkan nanti sesuai kebutuhan keamanan.
        </p>
      </section>
    </div>
  </div>
</body>
</html>

