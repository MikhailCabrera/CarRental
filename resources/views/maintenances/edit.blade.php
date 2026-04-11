<!DOCTYPE html>
<html>
<head>
    <title>Edit Maintenance</title>
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
            <a href="/customers">Customers</a>
            <a href="/bookings">Bookings</a>
            <a href="/transactions">Transactions</a>
            <a href="/maintenances" class="active">Maintenance</a>
            <a href="/employee">Employees</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="page-header">
            <a href="/maintenances" class="btn-back">← Back</a>
            <h1>Edit Maintenance</h1>
        </div>

        <div class="card form-card">
            <form action="/maintenances/{{ $maintenance->id }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Vehicle</label>
                    <select name="vehicle_id" required>
                        @foreach($vehicles as $v)
                        <option value="{{ $v->id }}" {{ $maintenance->vehicle_id == $v->id ? 'selected' : '' }}>{{ $v->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Maintenance Type</label>
                    <select name="maintenance_type" required>
                        <option value="inspection" {{ $maintenance->maintenance_type == 'inspection' ? 'selected' : '' }}>Inspection</option>
                        <option value="cleaning" {{ $maintenance->maintenance_type == 'cleaning' ? 'selected' : '' }}>Cleaning</option>
                        <option value="repair" {{ $maintenance->maintenance_type == 'repair' ? 'selected' : '' }}>Repair</option>
                        <option value="service" {{ $maintenance->maintenance_type == 'service' ? 'selected' : '' }}>Service</option>
                        <option value="other" {{ $maintenance->maintenance_type == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="maintenance_date" value="{{ $maintenance->maintenance_date->format('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label>Cost</label>
                    <input type="number" name="cost" step="0.01" min="0" value="{{ $maintenance->cost }}" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description">{{ $maintenance->description }}</textarea>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="pending" {{ $maintenance->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $maintenance->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Update Maintenance</button>
                    <a href="/maintenances" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
