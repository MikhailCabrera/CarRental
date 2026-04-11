<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<div class="main-content">
    <h1>Categories</h1>

    <form action="/categories" method="POST" class="product-form">
        @csrf
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="category_name" placeholder="e.g. Electronics" required>
        </div>
        <button class="btn-primary">Add Category</button>
    </form>

    <div class="card">
        <table class="product-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th style="text-align:right">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>#{{ $cat->id }}</td>
                    <td>{{ $cat->category_name }}</td>
                    <td style="text-align:right">
                        <form action="/categories/{{ $cat->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete">Delete</button>
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