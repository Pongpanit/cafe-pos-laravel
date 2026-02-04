<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <!-- เชื่อมต่อ Bootstrap CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- ฟอนต์และสไตล์เพิ่มเติม -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f7f3e9; /* สีพื้นหลังโทนคาเฟ่ */
            font-family: 'Kanit', sans-serif;
        }
        .card {
            border: none;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            color: #6b4f4f; /* โทนสีน้ำตาลคาเฟ่ */
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #d9cfc1;
            background-color: #f9f5f0;
        }
        .btn-primary {
            background-color: #a67c52;
            border-color: #a67c52;
        }
        .btn-primary:hover {
            background-color: #8b6442;
            border-color: #8b6442;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="p-4 card" style="width: 400px;">
            <h3 class="mb-4 text-center card-title">เข้าสู่ระบบ</h3>
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            @if ($errors->any())
                <div class="mt-3 alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
    </div>
    <!-- Bootstrap JS (ออปชัน) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
