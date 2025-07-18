<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | Cancer Institute</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <style>
    body {
      background: linear-gradient(135deg, #4caf50, #2196f3);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
    }
    .login-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      padding: 30px;
      width: 420px;
      animation: slideIn 0.7s ease-out;
    }
    .login-card h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    .form-control:focus {
      box-shadow: 0 0 5px rgba(33, 150, 243, 0.7);
      border-color: #2196f3;
    }
    .btn-primary {
      background: linear-gradient(135deg, #4caf50, #2196f3);
      border: none;
      transition: background 0.3s ease;
    }
    .btn-primary:hover {
      background: linear-gradient(135deg, #2196f3, #4caf50);
    }
    .error-msg {
      color: red;
      font-size: 0.9rem;
      margin-top: 0.25rem;
    }
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h2>Login</h2>
    <form id="loginForm" method="POST" action="{{ route('login') }}" novalidate>
      @csrf

      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input
          id="email"
          type="email"
          name="email"
          value="{{ old('email') }}"
          required
          autofocus
          class="form-control @error('email') is-invalid @enderror"
        />
        @error('email')
          <div class="error-msg">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input
          id="password"
          type="password"
          name="password"
          required
          class="form-control @error('password') is-invalid @enderror"
        />
        @error('password')
          <div class="error-msg">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>

      <p class="mt-3 text-center">
        Don't have an account?
        <a href="{{ route('register') }}">Register here</a>
      </p>
    </form>
  </div>

  <script>
    // Client-side validation to prevent submission with empty fields
    document.getElementById('loginForm').addEventListener('submit', function (e) {
      const email = document.getElementById('email');
      const password = document.getElementById('password');
      let valid = true;

      // Clear previous error messages
      email.classList.remove('is-invalid');
      password.classList.remove('is-invalid');

      if (!email.value.trim()) {
        email.classList.add('is-invalid');
        valid = false;
      }
      if (!password.value.trim()) {
        password.classList.add('is-invalid');
        valid = false;
      }

      if (!valid) {
        e.preventDefault();
        alert('Please fill in both email and password fields.');
      }
    });
  </script>
</body>
</html>
