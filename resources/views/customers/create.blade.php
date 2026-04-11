<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($customer) ? 'Edit' : 'Add' }} Customer</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <h2>Car Rental</h2>
        <nav>
            <a href="/dashboard">Dashboard</a>
            <a href="/rental-costs">Vehicles</a>
            <a href="/categories">Brands</a>
            <a href="/customers" class="active">Customers</a>
            <a href="/bookings">Bookings</a>
            <a href="/transactions">Transactions</a>
            <a href="/maintenances">Maintenance</a>
            <a href="/employee">Employees</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="page-header">
            <a href="/customers" class="btn-back">← Back</a>
            <h1>{{ isset($customer) ? 'Edit' : 'Add' }} Customer</h1>
        </div>

        <div class="card form-card">
            <form action="{{ isset($customer) ? '/customers/' . $customer->id : '/customers' }}" method="POST">
                @csrf @if(isset($customer)) @method('PUT') @endif
                
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name', $customer->name ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $customer->email ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $customer->phone ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" required>{{ old('address', $customer->address ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label>ID Type</label>
                    <input type="text" name="identification_type" value="{{ old('identification_type', $customer->identification_type ?? 'ID') }}" required>
                </div>

                <div class="form-group">
                    <label>ID Number</label>
                    <input type="text" name="identification_number" value="{{ old('identification_number', $customer->identification_number ?? '') }}" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">{{ isset($customer) ? 'Update' : 'Create' }} Customer</button>
                    <a href="/customers" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
