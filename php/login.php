<?php
session_start();

// File penyimpanan multi admin + role
$adminsFile = __DIR__ . '/data/admins.json';

// Inisialisasi file admins.json jika belum ada (buat satu super admin default)
if (!file_exists($adminsFile)) {
    $defaultAdmin = [
        [
            'username' => 'admin',
            'password' => password_hash('genesis123', PASSWORD_DEFAULT),
            'role'     => 'admin', // admin | editor
        ],
    ];
    $dir = dirname($adminsFile);
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    file_put_contents(
        $adminsFile,
        json_encode($defaultAdmin, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        LOCK_EX
    );
}

// Helper baca data admin
function loadAdmins($file)
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

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['user']) && isset($_SESSION['user']['username'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $admins   = loadAdmins($adminsFile);
    $found    = null;

    foreach ($admins as $admin) {
        if (isset($admin['username']) && $admin['username'] === $username) {
            $found = $admin;
            break;
        }
    }

    if ($found && isset($found['password']) && password_verify($password, $found['password'])) {
        // Simpan info user + role di session
        $_SESSION['user'] = [
            'username' => $found['username'],
            'role'     => $found['role'] ?? 'editor',
        ];
        // Untuk kompatibilitas lama (cek $_SESSION['admin'])
        $_SESSION['admin'] = ($found['role'] ?? 'editor') === 'admin';

        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Genesis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
            colors: {
              'neon-blue': '#38bdf8',
              'neon-purple': '#a855f7',
            }
          }
        }
      }
    </script>
    <style>
      body {
        min-height: 100vh;
        background:
          radial-gradient(circle at top left, rgba(56,189,248,0.25), transparent 55%),
          radial-gradient(circle at bottom right, rgba(168,85,247,0.24), transparent 55%),
          linear-gradient(135deg, #020617 0%, #020617 40%, #020617 100%);
      }
    </style>
</head>
<body class="flex items-center justify-center px-4 py-8 text-slate-100 font-sans">
<div class="w-full max-w-sm">
    <div class="mb-6 text-center">
        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900/90 border border-slate-700/80 shadow-lg shadow-sky-500/40">
            <span class="text-neon-blue font-semibold text-xl">G</span>
        </div>
        <h1 class="text-lg font-semibold">Genesis Admin</h1>
        <p class="text-xs text-slate-400 mt-1">Masuk untuk mengelola konten mini CMS.</p>
    </div>

    <form method="post" class="rounded-2xl border border-slate-800/80 bg-slate-900/80 px-4 py-5 shadow-xl shadow-black/50 backdrop-blur">
        <?php if ($error): ?>
            <p class="mb-3 rounded-lg border border-rose-500/50 bg-rose-500/10 px-3 py-2 text-xs text-rose-200">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <div class="mb-3">
            <label for="username" class="block text-xs font-medium text-slate-300 mb-1.5">Username</label>
            <input id="username" name="username" type="text" required
                   class="w-full rounded-xl border border-slate-700/70 bg-slate-950/60 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-neon-blue focus:border-neon-blue transition">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-xs font-medium text-slate-300 mb-1.5">Password</label>
            <input id="password" name="password" type="password" required
                   class="w-full rounded-xl border border-slate-700/70 bg-slate-950/60 px-3 py-2 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-neon-purple focus:border-neon-purple transition">
        </div>

        <button type="submit"
                class="mt-1 inline-flex w-full items-center justify-center rounded-xl border border-neon-blue/70 bg-slate-900/80 px-3 py-2 text-sm font-medium text-sky-100 shadow-md shadow-sky-500/40 hover:bg-slate-900 hover:shadow-lg hover:shadow-sky-500/60 transition">
            Masuk
        </button>
    </form>

    <p class="mt-3 text-[11px] text-slate-500 text-center">
        <span class="text-slate-300 font-mono"></span> <span class="text-slate-300 font-mono"></span>
    </p>
</div>
</body>
</html>

