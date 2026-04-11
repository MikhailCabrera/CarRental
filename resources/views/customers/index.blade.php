<!DOCTYPE html>
<html>
<head>
    <title>Customers Management</title>
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
            <h1>Customers Management</h1>
            <a href="/customers/create" class="btn btn-primary">+ Add Customer</a>
        </div>

        <div class="card">
            @if($customers->count())
                <div class="table-wrapper">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>ID Type</th>
                                <th class="action-col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr>
                                <td class="id-cell">#{{ $customer->id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->identification_type }}</td>
                                <td class="action-col">
                                    <div class="action-buttons">
                                        <a href="/customers/{{ $customer->id }}/edit" class="btn-edit">Edit</a>
                                        <button type="button" class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-customer-id="{{ $customer->id }}" data-customer-name="{{ $customer->name }}">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <p>No customers yet. Create one using the button above!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Delete customer <strong id="customerNameDisplay"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('deleteModal').addEventListener('show.bs.modal', function(e) {
            const btn = e.relatedTarget;
            document.getElementById('customerNameDisplay').textContent = btn.dataset.customerName;
            document.getElementById('deleteForm').action = '/customers/' + btn.dataset.customerId;
        });
    </script>
</body>
</html>
