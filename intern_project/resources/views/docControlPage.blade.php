<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
        h1, h2 {
            color: #2c3e50;
            margin-bottom: 15px;
        }
        h2 {
            color: #16a085;
            margin-top: 40px;
        }
        form {
            margin-bottom: 30px;
        }
        input, select, textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            width: 100%;
            margin-bottom: 10px;
            box-sizing: border-box;
            resize: vertical;
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
            margin-bottom: 40px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #16a085;
            color: #fff;
        }
        .action-btns form {
            display: inline-block;
            margin: 0 5px 0 0;
        }
        .success {
            color: green;
            margin-bottom: 20px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        textarea {
            min-height: 80px;
        }
        .error-text {
            color: red;
            font-size: 0.9rem;
            margin-top: -8px;
            margin-bottom: 10px;
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

    {{-- Manage Patients --}}
    <h2>Manage Patients</h2>
    <form action="{{ route('doctor.patient.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Patient Name" required value="{{ old('name') }}">
        @error('name')<div class="error-text">{{ $message }}</div>@enderror

        <input type="number" name="age" placeholder="Age" required value="{{ old('age') }}">
        @error('age')<div class="error-text">{{ $message }}</div>@enderror

        <input type="text" name="user_number" placeholder="User Number" required value="{{ old('user_number') }}">
        @error('user_number')<div class="error-text">{{ $message }}</div>@enderror

        <input type="password" name="user_password" placeholder="Password" required>
        @error('user_password')<div class="error-text">{{ $message }}</div>@enderror

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
        @forelse($patients as $patient)
            <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->age }}</td>
                <td>{{ $patient->user_number }}</td>
                <td class="action-btns">
                    <a href="#" onclick="editPatient({{ $patient->id }}, '{{ $patient->name }}', {{ $patient->age }}, '{{ $patient->user_number }}')">Edit</a>

                    <form action="{{ route('doctor.patient.delete', $patient->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this patient?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:#e74c3c;">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No patients found.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Available Drugs --}}
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
            @forelse($drugs as $drug)
                <tr>
                    <td>{{ $drug->drug_name }}</td>
                    <td>{{ $drug->quantity }}</td>
                    <td>{{ $drug->manufacture_date }}</td>
                    <td>{{ $drug->expiry_date }}</td>
                    <td>{{ number_format($drug->price, 2) }}</td>
                </tr>
            @empty
                <tr><td colspan="5">No drugs available.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Prescriptions --}}
    <h2>Prescriptions</h2>
    <form action="{{ route('doctor.prescription.store') }}" method="POST">
        @csrf
        <input type="text" name="pat_name" placeholder="Enter patient's name" required value="{{ old('pat_name') }}">
        @error('pat_name')<div class="error-text">{{ $message }}</div>@enderror

        <input type="text" name="user_number" placeholder="Patient User Number" required value="{{ old('user_number') }}">
        @error('user_number')<div class="error-text">{{ $message }}</div>@enderror

        <textarea name="signs_and_symptoms" placeholder="Signs and Symptoms" required>{{ old('signs_and_symptoms') }}</textarea>
        @error('signs_and_symptoms')<div class="error-text">{{ $message }}</div>@enderror

        <textarea name="medicine" placeholder="Medicine" required>{{ old('medicine') }}</textarea>
        @error('medicine')<div class="error-text">{{ $message }}</div>@enderror

        <button type="submit">Add Prescription</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>Patient Name</th>
            <th>User Number</th>
            <th>Signs & Symptoms</th>
            <th>Medicine</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($prescriptions as $prescription)
            <tr>
                <td>{{ $prescription->pat_name }}</td>
                <td>{{ $prescription->user_number }}</td>
                <td>{{ $prescription->signs_and_symptoms }}</td>
                <td>{{ $prescription->medicine }}</td>
                <td class="action-btns">
                    <a href="#" onclick="editPrescription({{ $prescription->id }}, '{{ $prescription->pat_name }}', '{{ $prescription->user_number }}', '{{ $prescription->signs_and_symptoms }}', '{{ $prescription->medicine }}')">Edit</a>

                    <form action="{{ route('doctor.prescription.delete', $prescription->id) }}" method="POST" onsubmit="return confirm('Delete this prescription?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:#e74c3c;">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">No prescriptions found.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Manage Appointments --}}
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
        @forelse($appointments as $appointment)
            <tr>
                <td>{{ $appointment->pat_name }}</td>
                <td>{{ $appointment->user_number ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}</td>
                <td>{{ ucfirst($appointment->status) }}</td>
                <td class="action-btns">
                    @if($appointment->status === 'pending')
                        <form action="{{ route('doctor.appointment.approve', $appointment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Approve</button>
                        </form>
                        <form action="{{ route('doctor.appointment.postpone', $appointment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Postpone</button>
                        </form>
                    @else
                        <em>No actions</em>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="5">No appointments found.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Patient Feedback --}}
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
        @forelse($feedbacks as $feedback)
            <tr>
                <td>{{ $feedback->pat_name }}</td>
                <td>{{ $feedback->user_number ?? '-' }}</td>
                <td>{{ $feedback->message }}</td>
                <td>{{ $feedback->doctor_advice ?? 'Pending' }}</td>
                <td>
                    <form action="{{ route('doctor.feedback.advice', $feedback->id) }}" method="POST">
                        @csrf
                        <textarea name="doctor_advice" placeholder="Enter advice here..." required>{{ old('doctor_advice') }}</textarea>
                        @error('doctor_advice')<div class="error-text">{{ $message }}</div>@enderror
                        <button type="submit">Send Advice</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">No feedback found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<script>

    function editPatient(id, name, age, user_number) {
        alert('Edit patient: ' + name + ' (Functionality to be implemented)');
    }
    function editPrescription(id, pat_name, user_number, symptoms, medicine) {
        alert('Edit prescription for: ' + pat_name + ' (Functionality to be implemented)');
    }
</script>
</body>
</html>
