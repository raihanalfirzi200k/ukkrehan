<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Kasir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    :root {
      --bg-light: #fdfdfd;
      --text-light: #333;
      --bg-dark: #1e1e2f;
      --text-dark: #f1f1f1;
      --primary-color: #00c6ff;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.5s, color 0.5s;
    }

    body.light-mode {
      background: linear-gradient(135deg, #00c6ff, #0072ff);
      color: var(--text-light);
    }

    body.dark-mode {
      background: linear-gradient(135deg, #121212, #1a1a2e);
      color: var(--text-dark);
    }

    .theme-toggle {
      position: absolute;
      top: 20px;
      right: 30px;
      cursor: pointer;
      font-size: 24px;
    }

    .login-container {
      width: 100%;
      max-width: 900px;
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      display: flex;
      animation: fadeIn 0.8s ease-in-out;
    }

    body.dark-mode .login-container {
      background: var(--bg-dark);
      color: var(--text-dark);
    }

    .login-left {
      flex: 1;
      padding: 50px;
    }

    .login-right {
      flex: 1;
      background: url('assets/kasir4.png') no-repeat center center;
      background-size: cover;
    }

    .login-title {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 10px;
      color: var(--primary-color);
    }

    .form-control {
      border-radius: 12px;
      transition: all 0.3s;
    }

    body.dark-mode .form-control {
      background-color: #2c2c3e;
      color: #f1f1f1;
      border-color: #444;
    }

    .btn-primary {
      border-radius: 12px;
      background: linear-gradient(to right, #00c6ff, #0072ff);
      border: none;
      transition: all 0.3s;
    }

    .btn-primary:hover {
      transform: scale(1.02);
    }

    .alert {
      margin-top: 15px;
    }

    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
      }

      .login-right {
        display: none;
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(40px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
  <div class="theme-toggle" id="themeToggle" title="Ganti Mode">🌙</div>

  <div class="login-container">
    <div class="login-left">
      <h2 class="login-title text-center">Login Kasir</h2>
      <p class="text-center text-muted mb-4">Silakan masukkan username dan password Anda</p>

      <?php if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal"): ?>
        <div class="alert alert-danger text-center" role="alert">
          ❌ Username atau password salah!
        </div>
      <?php endif; ?>

      <form method="post" action="cek_login.php">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" name="username" required />
        </div>
        <div class="mb-4">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password" required />
        </div>

        <!-- Tombol Login dengan Spinner -->
        <button id="loginBtn" type="submit" class="btn btn-primary w-100 d-flex justify-content-center align-items-center">
          <span class="spinner-border spinner-border-sm me-2 d-none" role="status" id="spinner"></span>
          <span id="btnText">🔐 Login</span>
        </button>
      </form>
    </div>
    <div class="login-right"></div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Loading spinner saat klik login
    const form = document.querySelector("form");
    const btn = document.getElementById("loginBtn");
    const spinner = document.getElementById("spinner");
    const btnText = document.getElementById("btnText");

    form.addEventListener("submit", function () {
      btn.disabled = true;
      spinner.classList.remove("d-none");
      btnText.textContent = "Loading...";
    });

    // Toggle dark/light mode manual
    const themeToggle = document.getElementById("themeToggle");

    function setTheme(mode) {
      document.body.classList.remove("light-mode", "dark-mode");
      document.body.classList.add(mode + "-mode");
      themeToggle.textContent = mode === "dark" ? "☀️" : "🌙";
      localStorage.setItem("theme", mode);
    }

    themeToggle.addEventListener("click", () => {
      const current = document.body.classList.contains("dark-mode") ? "dark" : "light";
      const next = current === "dark" ? "light" : "dark";
      setTheme(next);
    });

    // Set theme saat load halaman
    const savedTheme = localStorage.getItem("theme") || "light";
    setTheme(savedTheme);
  </script>
</body>
</html>
