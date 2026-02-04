<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Minimal Cafe</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f3e9;
            font-family: 'Kanit', sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            margin-top: 3rem;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #a67c52;
            border: none;
        }
        .btn-primary:hover {
            background-color: #8b6442;
        }
        .btn-secondary {
            background-color: #ccc;
            border: none;
            color: #333;
        }
        .btn-secondary:hover {
            background-color: #aaa;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="mb-4 text-center">Edit Product</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
                <label>Current Image</label><br>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100">
            </div>

            <div class="form-group">
                <label for="image">Change Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <div class="form-group">
                <label for="price_hot">Price</label>
                <div class="d-flex">
                    <input type="number" class="mr-2 form-control" id="price_hot" name="price_hot" value="{{ $product->price_hot }}" placeholder="Hot" step="0.01" required>
                    <input type="number" class="mr-2 form-control" id="price_cold" name="price_cold" value="{{ $product->price_cold }}" placeholder="Cold" step="0.01" required>
                    <input type="number" class="form-control" id="price_blended" name="price_blended" value="{{ $product->price_blended }}" placeholder="Blended" step="0.01" required>
                </div>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
