<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category - Minimal Cafe</title>
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
            padding: 20px;
        }
        .card {
            background-color: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .list-group-item {
            display: flex;
            align-items: center;
            font-size: 1.1em;
            padding: 15px;
            border: none;
            border-bottom: 1px solid #ddd;
        }
        .list-group-item:last-child {
            border-bottom: none;
        }
        .list-group-item a {
            color: #3e3e3e;
            text-decoration: none;
            flex-grow: 1;
        }
        .list-group-item a:hover {
            color: #a67c52;
        }
        .category-icon {
            background-color: #a67c52;
            color: white;
            border-radius: 50%;
            padding: 10px;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            font-size: 1.2em;
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
            <h1 class="mb-4">Category</h1>     
            <div class="card">
                <ul class="list-group">
                    @foreach($categories as $category)
                        <li class="list-group-item">
                            <div class="category-icon">
                                <i class="fas fa-coffee"></i>
                            </div>
                            <a href="{{ route('categories.show', $category->name) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Font Awesome สำหรับไอคอน -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
