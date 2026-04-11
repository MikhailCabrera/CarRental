<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="sidebar">
        <h2>Car Rental System</h2>
        <nav>
            <a href="/dashboard" class="active">Dashboard</a>
            <a href="/rental-costs">Car Management</a>
            <a href="/categories">Brands</a>
            <a href="/bookings">Bookings</a>
            <a href="/transactions">Transactions</a>
            <a href="/maintenances">Maintenance</a>
            <a href="/employee">Employees</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="page-header">
            <div>
                <h1>Admin Dashboard</h1>
                <p class="page-subtitle">Manage bookings, vehicles, payments, maintenance, logs, status, and policy controls from one working dashboard.</p>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <span class="dashboard-label">Car Management</span>
                <strong>{{ $stats['vehicles'] }}</strong>
            </div>
            <div class="dashboard-card">
                <span class="dashboard-label">Brands</span>
                <strong>{{ $stats['brands'] }}</strong>
            </div>
            <div class="dashboard-card">
                <span class="dashboard-label">Bookings</span>
                <strong>{{ $stats['bookings'] }}</strong>
            </div>
            <div class="dashboard-card">
                <span class="dashboard-label">Transactions</span>
                <strong>{{ $stats['transactions'] }}</strong>
            </div>
            <div class="dashboard-card">
                <span class="dashboard-label">Maintenance</span>
                <strong>{{ $stats['maintenance'] }}</strong>
            </div>
            <div class="dashboard-card">
                <span class="dashboard-label">Employees</span>
                <strong>{{ $stats['employees'] }}</strong>
            </div>
            <div class="dashboard-card dashboard-card--accent">
                <span class="dashboard-label">Total Revenue</span>
                <strong>PHP {{ number_format($stats['revenue'], 2) }}</strong>
            </div>
        </div>

        <div class="card">
            <div class="panel-header">
                <h2>Admin Control Center</h2>
                <span class="panel-link">Web Administration</span>
            </div>

            <div class="dashboard-grid">
                <a href="/employee" class="dashboard-card text-decoration-none text-reset">
                    <span class="dashboard-label">User Management</span>
                    <strong>{{ $stats['employees'] }}</strong>
                </a>
                <a href="/bookings" class="dashboard-card text-decoration-none text-reset">
                    <span class="dashboard-label">Booking Management</span>
                    <strong>{{ $stats['bookings'] }}</strong>
                </a>
                <a href="/rental-costs" class="dashboard-card text-decoration-none text-reset">
                    <span class="dashboard-label">Vehicle Management</span>
                    <strong>{{ $stats['vehicles'] }}</strong>
                </a>
                <a href="/transactions" class="dashboard-card text-decoration-none text-reset">
                    <span class="dashboard-label">Payment Verification</span>
                    <strong>{{ $stats['pending_transactions'] }}</strong>
                </a>
                <a href="/maintenances" class="dashboard-card text-decoration-none text-reset">
                    <span class="dashboard-label">Return Processing</span>
                    <strong>{{ $stats['open_maintenance'] }}</strong>
                </a>
                <a href="#activityLogging" class="dashboard-card text-decoration-none text-reset">
                    <span class="dashboard-label">Activity Logging</span>
                    <strong>{{ $recentBookings->count() + $recentTransactions->count() + $recentMaintenances->count() }}</strong>
                </a>
                <a href="#systemStatus" class="dashboard-card text-decoration-none text-reset">
                    <span class="dashboard-label">System Status</span>
                    <strong>{{ $stats['active_bookings'] }}</strong>
                </a>
                <a href="/transactions" class="dashboard-card text-decoration-none text-reset">
                    <span class="dashboard-label">Payments</span>
                    <strong>{{ $stats['transactions'] }}</strong>
                </a>
                <a href="#termsConditions" class="dashboard-card text-decoration-none text-reset">
                    <span class="dashboard-label">Terms and Conditions</span>
                    <strong>4</strong>
                </a>
            </div>
        </div>

        <div class="card">
            <div class="panel-header">
                <h2>Car Management</h2>
                <a href="/rental-costs" class="panel-link">Open module</a>
            </div>

            <div class="accordion" id="carManagementAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="carInventoryHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#carInventoryCollapse" aria-expanded="true" aria-controls="carInventoryCollapse">
                            Fleet Inventory Overview
                        </button>
                    </h2>
                    <div id="carInventoryCollapse" class="accordion-collapse collapse show" aria-labelledby="carInventoryHeading" data-bs-parent="#carManagementAccordion">
                        <div class="accordion-body">
                            @if($vehicles->count())
                                <div class="table-wrapper">
                                    <table class="product-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Vehicle</th>
                                                <th>Brand</th>
                                                <th>Rate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($vehicles as $vehicle)
                                            <tr>
                                                <td>#{{ $vehicle->id }}</td>
                                                <td>{{ $vehicle->name }}</td>
                                                <td>{{ $vehicle->category->category_name ?? 'N/A' }}</td>
                                                <td>PHP {{ number_format($vehicle->retailcost, 2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="panel-empty">No vehicles found yet.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="carStatsHeading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#carStatsCollapse" aria-expanded="false" aria-controls="carStatsCollapse">
                            Car Management Summary
                        </button>
                    </h2>
                    <div id="carStatsCollapse" class="accordion-collapse collapse" aria-labelledby="carStatsHeading" data-bs-parent="#carManagementAccordion">
                        <div class="accordion-body">
                            <p class="panel-empty">Total cars in the system: <strong>{{ $stats['vehicles'] }}</strong></p>
                            <p class="panel-empty">Total brands available: <strong>{{ $stats['brands'] }}</strong></p>
                            <a href="/rental-costs" class="btn btn-primary">Manage Cars</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-panels">
            <div class="card" id="systemStatus">
                <div class="panel-header">
                    <h2>System Status</h2>
                </div>
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <span class="dashboard-label">Pending Bookings</span>
                        <strong>{{ $stats['pending_bookings'] }}</strong>
                    </div>
                    <div class="dashboard-card">
                        <span class="dashboard-label">Active Rentals</span>
                        <strong>{{ $stats['active_bookings'] }}</strong>
                    </div>
                    <div class="dashboard-card">
                        <span class="dashboard-label">Pending Payments</span>
                        <strong>{{ $stats['pending_transactions'] }}</strong>
                    </div>
                    <div class="dashboard-card">
                        <span class="dashboard-label">Open Maintenance</span>
                        <strong>{{ $stats['open_maintenance'] }}</strong>
                    </div>
                </div>
            </div>

            <div class="card" id="termsConditions">
                <div class="panel-header">
                    <h2>Terms and Conditions</h2>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($terms as $term)
                        <li class="list-group-item px-0">{{ $term }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="dashboard-panels">
            <div class="card">
                <div class="panel-header">
                    <h2>Recent Bookings</h2>
                    <a href="/bookings" class="panel-link">View all</a>
                </div>

                @if($recentBookings->count())
                    <div class="table-wrapper">
                        <table class="product-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Vehicle</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings as $booking)
                                <tr>
                                    <td>#{{ $booking->id }}</td>
                                    <td>{{ $booking->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $booking->vehicle->name ?? 'N/A' }}</td>
                                    <td>{{ ucfirst($booking->status) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="panel-empty">No bookings yet.</p>
                @endif
            </div>

            <div class="card">
                <div class="panel-header">
                    <h2>Recent Transactions</h2>
                    <a href="/transactions" class="panel-link">View all</a>
                </div>

                @if($recentTransactions->count())
                    <div class="table-wrapper">
                        <table class="product-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTransactions as $transaction)
                                <tr>
                                    <td>#{{ $transaction->id }}</td>
                                    <td>{{ $transaction->customer->name ?? 'N/A' }}</td>
                                    <td>PHP {{ number_format($transaction->total_amount, 2) }}</td>
                                    <td>{{ ucfirst($transaction->payment_status) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="panel-empty">No transactions yet.</p>
                @endif
            </div>
        </div>

        <div class="card" id="activityLogging">
            <div class="panel-header">
                <h2>Activity Logging</h2>
            </div>

            <div class="table-wrapper">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>Module</th>
                            <th>Reference</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBookings as $booking)
                            <tr>
                                <td>Booking Management</td>
                                <td>#{{ $booking->id }}</td>
                                <td>{{ $booking->customer->name ?? 'N/A' }} booked {{ $booking->vehicle->name ?? 'N/A' }}</td>
                            </tr>
                        @empty
                        @endforelse

                        @foreach($recentTransactions as $transaction)
                            <tr>
                                <td>Payment Verification</td>
                                <td>#{{ $transaction->id }}</td>
                                <td>{{ $transaction->customer->name ?? 'N/A' }} payment marked {{ ucfirst($transaction->payment_status) }}</td>
                            </tr>
                        @endforeach

                        @foreach($recentMaintenances as $maintenance)
                            <tr>
                                <td>Return Processing</td>
                                <td>#{{ $maintenance->id }}</td>
                                <td>{{ $maintenance->vehicle->name ?? 'N/A' }} maintenance status: {{ ucfirst($maintenance->status) }}</td>
                            </tr>
                        @endforeach

                        @if(!$recentBookings->count() && !$recentTransactions->count() && !$recentMaintenances->count())
                            <tr>
                                <td colspan="3" class="panel-empty">No activity logs yet.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
