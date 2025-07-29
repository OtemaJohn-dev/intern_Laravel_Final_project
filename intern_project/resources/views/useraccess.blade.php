

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Access | Cancer Institute Uganda</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #16a085, #3498db);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 450px;
            animation: fadeIn 1s ease-in-out;
            text-align: center;
        }

        h1 {
            color: #2c3e50;
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        h2 {
            color: #16a085;
            margin-bottom: 25px;
            font-size: 1.4rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, select {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #3498db;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.5);
        }

        .btn {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .error {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: -10px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cancer Institute Uganda</h1>
        <h2>User Access</h2>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('user.access.login') }}" method="POST" onsubmit="return validateForm()">
            @csrf

            <input type="text" name="user_number" placeholder="User Number" required>

            <input type="password" name="password" placeholder="Password" required>

            <select name="role" required>
                <option value="">-- Select Role --</option>
                <option value="doctor">Doctor</option>
                <option value="patient">Patient</option>
            </select>

            <button type="submit" class="btn">Login</button>
        </form>
    </div>

    <script>
        function validateForm() {
            const role = document.querySelector('select[name="role"]').value;
            if (!role) {
                alert('Please select your role.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>


