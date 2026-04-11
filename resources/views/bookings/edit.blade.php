<!DOCTYPE html>
<html>
<head>
    <title>Edit Booking</title>
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
            <a href="/bookings" class="active">Bookings</a>
            <a href="/transactions">Transactions</a>
            <a href="/maintenances">Maintenance</a>
            <a href="/employee">Employees</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="page-header">
            <a href="/bookings" class="btn-back">← Back</a>
            <h1>Edit Booking</h1>
        </div>

        <div class="card form-card">
            <form action="/bookings/{{ $booking->id }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Customer</label>
                    <select name="customer_id" required>
                        @foreach($customers as $c)
                        <option value="{{ $c->id }}" {{ $booking->customer_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Vehicle</label>
                    <select name="vehicle_id" required>
                        @foreach($vehicles as $v)
                        <option value="{{ $v->id }}" {{ $booking->vehicle_id == $v->id ? 'selected' : '' }}>{{ $v->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Start Date</label>
                    <input type="datetime-local" name="start_date" value="{{ $booking->start_date->format('Y-m-d H:i') }}" required>
                </div>

                <div class="form-group">
                    <label>End Date</label>
                    <input type="datetime-local" name="end_date" value="{{ $booking->end_date->format('Y-m-d H:i') }}" required>
                </div>

                <div class="form-group">
                    <label>Rental Rate</label>
                    <input type="number" name="rental_rate" step="0.01" value="{{ $booking->rental_rate }}" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="ongoing" {{ $booking->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Update Booking</button>
                    <a href="/bookings" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
