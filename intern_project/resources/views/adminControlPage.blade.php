<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Control Page - Cancer Institute Uganda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #16a085, #3498db);
            color: white;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        .form input, .form button {
            padding: 10px;
            border-radius: 5px;
            border: none;
        }
        .form button {
            background: #2ecc71;
            color: white;
            cursor: pointer;
        }
        table {
            width: 100%;
            background: white;
            color: #2c3e50;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .btn {
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            border: none;
        }
        .btn.edit {
            background: #f1c40f;
        }
        .btn.delete {
            background: #e74c3c;
        }
        .modal-bg {
            display: none;
            position: fixed;
            top:0; left:0; right:0; bottom:0;
            background: rgba(0,0,0,0.6);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .modal-content {
            background: white;
            color: #2c3e50;
            padding: 20px;
            border-radius: 10px;
            max-width: 450px;
            width: 100%;
        }
        .modal-content h3 {
            margin-top: 0;
            text-align: center;
        }
        .modal-content form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .modal-content input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .modal-content button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .modal-content button.update {
            background: #2ecc71;
            color: white;
        }
        .modal-content button.cancel {
            background: #e74c3c;
            color: white;
        }
        .success-message {
            background: #27ae60;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }
        .error-message {
            background: #c0392b;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Cancer Institute Uganda - Administrator Control Page</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Doctors Management Section -->
    <section>
        <h2>Doctors Management</h2>

        <form method="POST" action="{{ route('admin.add.doctor') }}" class="form">
            @csrf
            <input type="text" name="name" placeholder="Doctor Name" required />
            <input type="text" name="user_role" placeholder="User Role" required />
            <input type="text" name="user_number" placeholder="User Number" required />
            <input type="password" name="user_password" placeholder="Password" required />
            <button type="submit" class="btn">Add Doctor</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>User Role</th>
                    <th>User Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->user_role }}</td>
                    <td>{{ $doctor->user_number }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.delete.doctor', $doctor->id) }}" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete">Delete</button>
                        </form>
                        <button class="btn edit" onclick="openDoctorModal({{ $doctor->id }})">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Drugs Stock Management Section -->
    <section>
        <h2>Drugs Stock Management</h2>

        <form method="POST" action="{{ route('admin.add.drug') }}" class="form">
            @csrf
            <input type="text" name="drug_name" placeholder="Drug Name" required />
            <input type="number" name="quantity" placeholder="Quantity" required min="1" />
            <input type="date" name="manufacture_date" placeholder="Manufacture Date" required />
            <input type="date" name="expiry_date" placeholder="Expiry Date" required />
            <input type="number" step="0.01" name="price" placeholder="Price" required min="0" />
            <button type="submit" class="btn">Add Drug</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Drug Name</th>
                    <th>Quantity</th>
                    <th>Manufacture Date</th>
                    <th>Expiry Date</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($drugs as $drug)
                <tr>
                    <td>{{ $drug->drug_name }}</td>
                    <td>{{ $drug->quantity }}</td>
                    <td>{{ $drug->manufacture_date }}</td>
                    <td>{{ $drug->expiry_date }}</td>
                    <td>{{ number_format($drug->price, 2) }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.delete.drug', $drug->id) }}" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete">Delete</button>
                        </form>
                        <button class="btn edit" onclick="openDrugModal({{ $drug->id }})">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Doctor Edit Modal -->
    <div id="doctorModal" class="modal-bg">
        <div class="modal-content">
            <h3>Edit Doctor</h3>
            <form id="doctorEditForm" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="name" id="doctorName" placeholder="Doctor Name" required />
                <input type="text" name="user_role" id="doctorUserRole" placeholder="User Role" required />
                <input type="text" name="user_number" id="doctorUserNumber" placeholder="User Number" required />
                <input type="password" name="user_password" id="doctorUserPassword" placeholder="New Password (leave blank to keep current)" />
                <br />
                <button type="submit" class="update">Update Doctor</button>
                <button type="button" class="cancel" onclick="closeDoctorModal()">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Drug Edit Modal -->
    <div id="drugModal" class="modal-bg">
        <div class="modal-content">
            <h3>Edit Drug</h3>
            <form id="drugEditForm" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="drug_name" id="drugName" placeholder="Drug Name" required />
                <input type="number" name="quantity" id="drugQuantity" placeholder="Quantity" required min="1" />
                <input type="date" name="manufacture_date" id="drugManufactureDate" placeholder="Manufacture Date" required />
                <input type="date" name="expiry_date" id="drugExpiryDate" placeholder="Expiry Date" required />
                <input type="number" step="0.01" name="price" id="drugPrice" placeholder="Price" required min="0" />
                <br />
                <button type="submit" class="update">Update Drug</button>
                <button type="button" class="cancel" onclick="closeDrugModal()">Cancel</button>
            </form>
        </div>
    </div>

<script>
    // Doctor Modal Functions
    function openDoctorModal(id) {
        fetch(`/admin/edit-doctor/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('doctorName').value = data.name;
                document.getElementById('doctorUserRole').value = data.user_role;
                document.getElementById('doctorUserNumber').value = data.user_number;
                document.getElementById('doctorUserPassword').value = '';
                document.getElementById('doctorEditForm').action = `/admin/update-doctor/${id}`;
                document.getElementById('doctorModal').style.display = 'flex';
            })
            .catch(() => alert('Failed to load doctor data.'));
    }

    function closeDoctorModal() {
        document.getElementById('doctorModal').style.display = 'none';
    }

    // Drug Modal Functions
    function openDrugModal(id) {
        fetch(`/admin/edit-drug/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('drugName').value = data.drug_name;
                document.getElementById('drugQuantity').value = data.quantity;
                document.getElementById('drugManufactureDate').value = data.manufacture_date;
                document.getElementById('drugExpiryDate').value = data.expiry_date;
                document.getElementById('drugPrice').value = data.price;
                document.getElementById('drugEditForm').action = `/admin/update-drug/${id}`;
                document.getElementById('drugModal').style.display = 'flex';
            })
            .catch(() => alert('Failed to load drug data.'));
    }

    function closeDrugModal() {
        document.getElementById('drugModal').style.display = 'none';
    }
</script>

</body>
</html>
