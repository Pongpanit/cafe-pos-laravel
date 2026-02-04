<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} - Products</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f7f3e9;
            font-family: 'Kanit', sans-serif;
        }
        .sidebar {
            background-color: #3e3e3e;
            color: #ffffff;
            height: 100vh;
            width: 200px;
            padding-top: 20px;
            position: fixed;
        }
        .sidebar h3 {
            color: #ffffff;
            font-size: 1.5em;
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
            border-radius: 8px;
        }
        .content {
            margin-left: 220px;
            padding: 40px;
        }
        .card {
            background-color: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .table th {
            background-color: #3e3e3e;
            color: #ffffff;
            font-weight: bold;
        }
        .table td {
            background-color: #f7f3e9;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="p-3 sidebar d-flex flex-column">
            <h3>Coffee POS</h3>
            <a href="{{ route('sales.index') }}">Order and Payment</a>
            <a href="{{ route('sales.history') }}">Sales History</a>
            <a href="{{ route('categories.index') }}">Category</a>
            <a href="{{ route('products.index') }}">Products</a>
        </div>
        
        <!-- Main Content -->
        <div class="content flex-fill">
            <h1>{{ $category->name }} Products</h1>
            <a href="{{ route('categories.index') }}" class="mb-3 btn btn-secondary">Back to Categories</a>
            <div class="card">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Hot Price</th>
                            <th>Cold Price</th>
                            <th>Blended Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>${{ $product->price_hot }}</td>
                            <td>${{ $product->price_cold }}</td>
                            <td>${{ $product->price_blended }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No products available in this category.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
