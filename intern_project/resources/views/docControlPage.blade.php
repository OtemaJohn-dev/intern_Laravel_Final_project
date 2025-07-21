@extends('layout.dashboard')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Control Page | Cancer Institute Uganda</title>
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
            max-width: 1200px;
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
        input, select, textarea {
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
        .action-btns a, .action-btns button {
            margin-right: 5px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Doctor Control Page</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @elseif(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif
    <h2>Manage Patients</h2>
    <form action="{{ route('doctor.patient.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Patient Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="text" name="user_number" placeholder="User Number" required>
        <input type="password" name="user_password" placeholder="Password" required>
        <button type="submit">Add Patient</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>User Number</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->age }}</td>
                <td>{{ $patient->user_number }}</td>
                <td class="action-btns">
                    <a href="#" onclick="editPatient({{ $patient->id }}, '{{ $patient->name }}', {{ $patient->age }}, '{{ $patient->user_number }}')">Edit</a>
                    <a href="{{ route('doctor.patient.delete', $patient->id) }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>Available Drugs</h2>
    <table>
        <thead>
        <tr>
            <th>Drug Name</th>
            <th>Quantity</th>
            <th>Manufacture Date</th>
            <th>Expiry Date</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach($drugs as $drug)
            <tr>
                <td>{{ $drug->Drug_name }}</td>
                <td>{{ $drug->Quantity }}</td>
                <td>{{ $drug->Manufacture_date }}</td>
                <td>{{ $drug->Expiry_date }}</td>
                <td>{{ $drug->Price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h2>Prescriptions</h2>
    <form action="{{ route('doctor.prescription.store') }}" method="POST">
        @csrf
        <input type="text" name="user_number" placeholder="Patient User Number" required>
        <textarea name="signs_and_symptoms" placeholder="Signs and Symptoms" required></textarea>
        <textarea name="medicine" placeholder="Medicine" required></textarea>
        <button type="submit">Add Prescription</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>User Number</th>
            <th>Signs & Symptoms</th>
            <th>Medicine</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($prescriptions as $prescription)
            <tr>
                <td>{{ $prescription->user_number }}</td>
                <td>{{ $prescription->signs_and_symptoms }}</td>
                <td>{{ $prescription->medicine }}</td>
                <td class="action-btns">
                    <a href="#" onclick="editPrescription({{ $prescription->id }}, '{{ $prescription->user_number }}', '{{ $prescription->signs_and_symptoms }}', '{{ $prescription->medicine }}')">Edit</a>
                    <a href="{{ route('doctor.prescription.delete', $prescription->id) }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>Manage Appointments</h2>
    <table>
        <thead>
        <tr>
            <th>Patient Name</th>
            <th>User Number</th>
            <th>Appointment Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->patient_name }}</td>
                <td>{{ $appointment->user_number }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ ucfirst($appointment->status) }}</td>
                <td class="action-btns">
                    <a href="{{ route('doctor.appointment.approve', $appointment->id) }}">Approve</a>
                    <a href="{{ route('doctor.appointment.postpone', $appointment->id) }}">Postpone</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h2>Patient Feedback</h2>
    <table>
        <thead>
        <tr>
            <th>Patient Name</th>
            <th>User Number</th>
            <th>Message</th>
            <th>Doctor Advice</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($feedbacks as $feedback)
            <tr>
                <td>{{ $feedback->patient_name }}</td>
                <td>{{ $feedback->user_number }}</td>
                <td>{{ $feedback->message }}</td>
                <td>{{ $feedback->doctor_advice ?? 'Pending' }}</td>
                <td>
                    <form action="{{ route('doctor.feedback.advice', $feedback->id) }}" method="POST">
                        @csrf
                        <textarea name="doctor_advice" placeholder="Enter advice here..." required></textarea>
                        <button type="submit">Send Advice</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    function editPatient(id, name, age, user_number) {
        alert('Edit Patient: ' + name);
    }

    function editPrescription(id, user_number, symptoms, medicine) {
        alert('Edit Prescription for: ' + user_number);
    }
</script>
</body>
</html>

@endsection