<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales History - Minimal Cafe</title>
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
            <h1 class="mb-4">Sales History</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sale ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Sale Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->product_name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>${{ number_format($sale->total, 2) }}</td>
                        <td>{{ $sale->sale_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>
    </div>
</body>
</html>
