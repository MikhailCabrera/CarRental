<!DOCTYPE html>
<html>
<head>
    <title>Record Transaction</title>
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
            <a href="/transactions" class="active">Transactions</a>
            <a href="/maintenances">Maintenance</a>
            <a href="/employee">Employees</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="page-header">
            <a href="/transactions" class="btn-back">← Back</a>
            <h1>Record Transaction</h1>
        </div>

        <div class="card form-card">
            <form action="/transactions" method="POST">
                @csrf

                <div class="form-group">
                    <label>Customer</label>
                    <select name="customer_id" required>
                        @foreach($customers as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Booking</label>
                    <select name="booking_id" required>
                        @foreach($bookings as $b)
                        <option value="{{ $b->id }}">Booking #{{ $b->id }} - {{ $b->customer->name }} ({{ $b->vehicle->name ?? 'N/A' }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Payment Method</label>
                    <select name="payment_method" required>
                        <option value="cash">Cash</option>
                        <option value="gcash">GCash</option>
                        <option value="card">Card</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" name="total_amount" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="payment_status">
                        <option value="pending">Pending</option>
                        <option value="completed" selected>Completed</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Record Transaction</button>
                    <a href="/transactions" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
