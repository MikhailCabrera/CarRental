<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($maintenance) ? 'Edit' : 'New' }} Maintenance</title>
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
            <h1>{{ isset($maintenance) ? 'Edit' : 'New' }} Maintenance</h1>
        </div>

        <div class="card form-card">
            <form action="{{ isset($maintenance) ? '/maintenances/'.$maintenance->id : '/maintenances' }}" method="POST">
                @csrf @if(isset($maintenance)) @method('PUT') @endif

                <div class="form-group">
                    <label>Vehicle</label>
                    <select name="vehicle_id" required>
                        @foreach($vehicles as $v)
                        <option value="{{ $v->id }}" {{ (isset($maintenance) && $maintenance->vehicle_id == $v->id) ? 'selected' : '' }}>{{ $v->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Maintenance Type</label>
                    <select name="maintenance_type" required>
                        <option value="inspection" {{ isset($maintenance) && $maintenance->maintenance_type == 'inspection' ? 'selected' : '' }}>Inspection</option>
                        <option value="cleaning" {{ isset($maintenance) && $maintenance->maintenance_type == 'cleaning' ? 'selected' : '' }}>Cleaning</option>
                        <option value="repair" {{ isset($maintenance) && $maintenance->maintenance_type == 'repair' ? 'selected' : '' }}>Repair</option>
                        <option value="service" {{ isset($maintenance) && $maintenance->maintenance_type == 'service' ? 'selected' : '' }}>Service</option>
                        <option value="other" {{ isset($maintenance) && $maintenance->maintenance_type == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="maintenance_date" value="{{ isset($maintenance) ? $maintenance->maintenance_date->format('Y-m-d') : '' }}" required>
                </div>

                <div class="form-group">
                    <label>Cost (₱)</label>
                    <input type="number" name="cost" step="0.01" min="0" value="{{ old('cost', $maintenance->cost ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description">{{ isset($maintenance) ? $maintenance->description : '' }}</textarea>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="pending" {{ isset($maintenance) && $maintenance->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ !isset($maintenance) || $maintenance->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">{{ isset($maintenance) ? 'Update' : 'Create' }} Maintenance</button>
                    <a href="/maintenances" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
