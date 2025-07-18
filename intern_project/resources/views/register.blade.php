<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Cancer Institute</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #4CAF50, #2196F3);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            padding: 30px;
            width: 420px;
            animation: slideIn 0.7s ease-out;
        }
        .register-card h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(33, 150, 243, 0.7);
            border-color: #2196F3;
        }
        .btn-primary {
            background: linear-gradient(135deg, #4CAF50, #2196F3);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2196F3, #4CAF50);
        }
        .error {
            color: red;
            font-size: 0.9rem;
        }
        @keyframes slideIn {
            from {opacity: 0; transform: translateY(-50px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <div class="register-card">
        <h2>Create Account</h2>
        <form id="registerForm" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" id="email" name="email" class="form-control" required>
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p class="mt-3 text-center">Already have an account? <a href="/login">Login</a></p>
        </form>
    </div>

    <script>
        // Instant validation
        const form = document.getElementById('registerForm');
        form.addEventListener('submit', function (e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
