@extends('layout.dashboard')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Page | Cancer Institute Uganda</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
            padding: 50px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: fadeIn 1s ease-in-out;
            width: 90%;
            max-width: 500px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 2.5rem;
        }

        h2 {
            color: #16a085;
            margin-bottom: 30px;
            font-size: 1.5rem;
        }

        .section {
            margin: 30px 0;
        }

        .section p {
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.1rem;
            color: #34495e;
        }

        .btn {
            display: inline-block;
            background: #3498db;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            background: #2980b9;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }
            h1 {
                font-size: 2rem;
            }
            h2 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cancer Institute Uganda</h1>
        <h2>Access Page</h2>

        <div class="section">
            <p>Access as the Administrator</p>
            <a href="{{ route('adminaccess') }}" class="btn" onclick="showAlert('Administrator')">Administrator</a>
        </div>

        <div class="section">
            <p>Access as a Doctor, Patient, Partnering_Pharmacy</p>
            <a href="{{ route('userlogin') }}" class="btn" onclick="showAlert('User')">Users</a>
        </div>
    </div>

    <script>
        function showAlert(role) {
            alert('Redirecting to ' + role + ' Login Page...');
        }
    </script>
</body>
</html>

@endsection
