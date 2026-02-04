<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List - Minimal Cafe</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f3e9;
            font-family: 'Kanit', sans-serif;
        }
        .sidebar {
            background-color: #3e3e3e;
            color: #ffffff;
            width: 200px;
            height: 100vh;
            padding-top: 20px;
            position: fixed;
        }
        .sidebar h3 {
            color: #ffffff;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            padding: 10px 0;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
            border-radius: 8px;
            padding-left: 10px;
        }
        .content {
            margin-left: 220px;
            padding: 40px;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="p-3 sidebar d-flex flex-column">
            <h3>Coffee POS</h3>
            <a href="{{ route('sales.index') }}">Order and Payment</a>
            <a href="{{ route('sales.history') }}">Sales History</a>
            <a href="{{ route('categories.index') }}">Category</a>
            <a href="{{ route('products.index') }}">Products</a>
        </div>

        <div class="content flex-fill">
            <h1 class="mb-4">Product List</h1>
            <a href="{{ route('products.create') }}" class="mb-3 btn btn-primary">Add New Product</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Hot Price</th>
                        <th>Cold Price</th>
                        <th>Blended Price</th>
                        <th>Category</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50"></td>
                        <td>{{ $product->name }}</td>
                        <td>${{ number_format($product->price_hot, 2) }}</td>
                        <td>${{ number_format($product->price_cold, 2) }}</td>
                        <td>${{ number_format($product->price_blended, 2) }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <input type="checkbox" data-id="{{ $product->id }}" class="toggle-active" {{ $product->active ? 'checked' : '' }}>
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.toggle-active').change(function () {
                let productId = $(this).data('id');
                let isActive = $(this).is(':checked');

                $.ajax({
                    url: "{{ route('products.toggleActive') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: productId
                    },
                    success: function (response) {
                        if (response.success) {
                            alert('Product status updated successfully.');
                        } else {
                            alert('Failed to update product status.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
