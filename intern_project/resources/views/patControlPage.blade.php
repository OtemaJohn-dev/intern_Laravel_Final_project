@extends('layout.dashboard')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Control Page | Cancer Institute Uganda</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #16a085, #3498db);
            min-height: 100vh;
        }
        .container {
            background: #fff;
            margin: 20px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 95%;
            max-width: 1000px;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            color: #16a085;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        form, table {
            margin-bottom: 30px;
        }
        input, textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            width: 100%;
            margin-bottom: 10px;
        }
        button {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #16a085;
            color: #fff;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Patient Control Page</h1>

    @if(session('success'))
        <p class="success" id="success-message">{{ session('success') }}</p>
    @elseif(session('error'))
        <p class="error" id="error-message">{{ session('error') }}</p>
    @endif

    <h2>Medical History</h2>
    <table>
        <thead>
        <tr>
            <th>Date</th>
            <th>Signs & Symptoms</th>
            <th>Medicine Prescribed</th>
        </tr>
        </thead>
        <tbody>
        @foreach($Prescriptions as $prescription)
            <tr>
                <td>{{ $prescription->created_at->format('Y-m-d') }}</td>
                <td>{{ $prescription->signs_and_symptoms }}</td>
                <td>{{ $prescription->medicine }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>Request Appointment</h2>
    <form id="appointmentForm" action="{{ route('patient.request.appointment') }}" method="POST">
        @csrf
        <input type="text" name="patient_name" placeholder="Your Name" required>
        <input type="text" name="user_number" placeholder="Your User Number" required>
        <input type="date" name="appointment_date" required>
        <button type="submit">Request Appointment</button>
    </form>

    <h2>Send Feedback</h2>
    <form id="feedbackForm" action="{{ route('patient.send.feedback') }}" method="POST">
        @csrf
        <input type="text" name="patient_name" placeholder="Your Name" required>
        <input type="text" name="user_number" placeholder="Your User Number" required>
        <textarea name="message" placeholder="Write your feedback here..." rows="4" required></textarea>
        <button type="submit">Send Feedback</button>
    </form>
</div>

<script>
    
    setTimeout(() => {
        const successMsg = document.getElementById('success-message');
        const errorMsg = document.getElementById('error-message');
        if (successMsg) successMsg.style.display = 'none';
        if (errorMsg) errorMsg.style.display = 'none';
    }, 5000);

    document.getElementById('appointmentForm').addEventListener('submit', function(e) {
        const confirmSubmit = confirm('Do you want to request this appointment?');
        if (!confirmSubmit) e.preventDefault();
    });

    document.getElementById('feedbackForm').addEventListener('submit', function(e) {
        const confirmSubmit = confirm('Do you want to send this feedback?');
        if (!confirmSubmit) e.preventDefault();
    });
</script>

</body>
</html>

@endsection
