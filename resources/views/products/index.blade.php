<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Management</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="sidebar">
        <h2>Car Rental System</h2>
        <nav>
            <a href="/dashboard">Dashboard</a>
            <a href="/rental-costs" class="active">Car Management</a>
            <a href="/categories">Brands</a>
            <a href="/bookings">Bookings</a>
            <a href="/transactions">Transactions</a>
            <a href="/maintenances">Maintenance</a>
            <a href="/employee">Employees</a>
        </nav>
    </div>

    <div class="main-content">
        <h1>Car Management</h1>

        <form action="/rental-costs" method="POST" class="product-form">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="e.g. Toyota Vios" required>
            </div>

            <div class="form-group">
                <label for="retailcost">Rental Cost:</label>
                <input type="text" id="retailcost" name="retailcost" placeholder="0.00" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id" required>
                    <option value="" disabled selected>Select a category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-primary">Save Rental Cost</button>
        </form>

        <hr>

        <div class="card">
            <table class="product-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Rental Cost</th>
                        <th>Category</th>
                        <th style="text-align:right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td>PHP {{ number_format($item->retailcost, 2) }}</td>
                            <td><span class="badge">{{ ucfirst($item->category->category_name ?? 'N/A') }}</span></td>
                            <td style="text-align:right">
                                <a href="/rental-costs/{{ $item->id }}/edit" style="text-decoration: none;">Edit</a>
                                <form action="/rental-costs/{{ $item->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Delete this item?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
