<!DOCTYPE html>
<html>
<head>
    <title>Edit Rental Cost</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="sidebar">
        <h2>Car Rental System</h2>
        <nav>
            <a href="/dashboard">Dashboard</a>
            <a href="/rental-costs" class="active">Vehicles</a>
            <a href="/categories">Brands</a>
            <a href="/customers">Customers</a>
            <a href="/bookings">Bookings</a>
            <a href="/transactions">Transactions</a>
            <a href="/maintenances">Maintenance</a>
            <a href="/employee">Employees</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="page-header">
            <a href="/rental-costs" class="btn-back">← Back</a>
            <h1>Edit Rental Cost</h1>
        </div>

        <div class="card form-card">
            <form id="editForm" action="/rental-costs/{{ $product->id }}" method="POST" class="category-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Input a car</label>
                    <input 
                        type="text" 
                        id="name"
                        name="name" 
                        placeholder="e.g., MacBook Pro" 
                        value="{{ old('name', $product->name) }}"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for=\"retailcost\">Rental Cost</label>
                    <input 
                        type=\"number\" 
                        id=\"retailcost\"
                        name=\"retailcost\" 
                        placeholder=\"0.00\" 
                        value=\"{{ old('retailcost', $product->retailcost) }}\"
                        step="0.01"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select 
                        id="category_id" 
                        name="category_id" 
                        required
                    >
                        <option value="" disabled>Select a category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">Update Rental Cost</button>
                    <a href="/rental-costs" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to update the rental cost?</p>
                    <p>This change will be applied to the system.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmBtn">Yes, Update</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('confirmBtn').addEventListener('click', function() {
            document.getElementById('editForm').submit();
            setTimeout(function() {
                window.location.href = 'http://127.0.0.1:8000/rental-costs';
            }, 500);
        });
    </script>
</body>
</html>
