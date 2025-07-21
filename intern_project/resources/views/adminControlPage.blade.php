@extends('layout.dashboard')

@section('content')
<div class="admin-container">
    <h1>Cancer Institute Uganda - Administrator Control Page</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    
    <section>
        <h2>Doctors Management</h2>
        <form method="POST" action="{{ route('admin.add.doctor') }}" class="form">
            @csrf
            <input type="text" name="name" placeholder="Doctor Name" required>
            <input type="text" name="user_role" placeholder="User Role" required>
            <input type="text" name="user_number" placeholder="User Number" required>
            <input type="password" name="user_password" placeholder="Password" required>
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
                        <form action="{{ route('admin.delete.doctor', $doctor->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete">Delete</button>
                        </form>
                        <a href="#" onclick="editDoctor({{ $doctor->id }})" class="btn edit">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section>
        <h2>Drugs Stock Management</h2>
        <form method="POST" action="{{ route('admin.add.drug') }}" class="form">
            @csrf
            <input type="text" name="drug_name" placeholder="Drug Name" required>
            <input type="number" name="quantity" placeholder="Quantity" required>
            <input type="date" name="manufacture_date" placeholder="Manufacture Date" required>
            <input type="date" name="expiry_date" placeholder="Expiry Date" required>
            <input type="number" name="price" placeholder="Price" required>
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
                    <td>{{ $drug->price }}</td>
                    <td>
                        <form action="{{ route('admin.delete.drug', $drug->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete">Delete</button>
                        </form>
                        <a href="#" onclick="editDrug({{ $drug->id }})" class="btn edit">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>

<style>
    .admin-container {
        background: linear-gradient(135deg, #16a085, #3498db);
        padding: 20px;
        color: white;
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
        margin-bottom: 30px;
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
    }
    .btn.edit {
        background: #f1c40f;
    }
    .btn.delete {
        background: #e74c3c;
    }
</style>

<script>
    function editDoctor(id) {
        alert('Edit doctor ID: ' + id + ' (functionality coming soon)');
    }

    function editDrug(id) {
        alert('Edit drug ID: ' + id + ' (functionality coming soon)');
    }
</script>
@endsection
