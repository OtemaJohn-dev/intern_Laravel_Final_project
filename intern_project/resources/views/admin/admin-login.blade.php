<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Login - Cancer Institute</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 10px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3 class="text-center mb-4">Administrator Login</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form id="adminLoginForm" method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    name="email" 
                    placeholder="Enter your email" 
                    required
                >
                <div class="invalid-feedback">Please enter a valid email.</div>
            </div>

            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password" 
                    name="password" 
                    placeholder="Enter your password" 
                    required
                >
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
                <div class="invalid-feedback">Password is required.</div>
            </div>

            <button type="submit" class="btn btn-primary w-100" id="loginBtn">
                Login
            </button>
        </form>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }

        // Form validation and button feedback
        const form = document.getElementById('adminLoginForm');
        const loginBtn = document.getElementById('loginBtn');

        form.addEventListener('submit', function(event) {
            let valid = true;

            // Validate email
            const emailInput = document.getElementById('email');
            if (!emailInput.value) {
                emailInput.classList.add('is-invalid');
                valid = false;
            } else {
                emailInput.classList.remove('is-invalid');
            }

            // Validate password
            const passwordInput = document.getElementById('password');
            if (!passwordInput.value) {
                passwordInput.classList.add('is-invalid');
                valid = false;
            } else {
                passwordInput.classList.remove('is-invalid');
            }

            if (!valid) {
                event.preventDefault(); // Stop form submission
                return;
            }

            // Disable button and show loader
            loginBtn.disabled = true;
            loginBtn.textContent = 'Logging in...';
        });
    </script>
</body>
</html>
