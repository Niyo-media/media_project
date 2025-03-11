<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { width: 40%; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; }
        .btn { background: #4CAF50; color: white; padding: 10px; width: 100%; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #45a049; }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Login</h2>

    @if(session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('student.login.submit') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="student_reg_number">Registration Number</label>
            <input type="text" id="student_reg_number" name="student_reg_number" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn">Login</button>
    </form>
    <br>
    You Don't have an account? Kindly <a href="/students/create">Register Here</a>
</div>

</body>
</html>
