<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Registration</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { width: 40%; margin: 50px auto; padding: 20px; background-color: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input, select { width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; width: 100%; }
        button:hover { background-color: #45a049; }
        .form-group input:focus, .form-group select:focus { border-color: #4CAF50; outline: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Department Registration</h2>
        @if(session('success'))
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('department.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="campus">Campus Name</label>
                <select id="campus" name="campus_id" required>
                    <option value="">Select Campus</option>
                    @foreach($campuses as $campus)
                        <option value="{{ $campus->campus_id }}">{{ $campus->campus_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="department_code">Department Code</label>
                <input type="text" id="department_code" name="department_code" required placeholder="Enter Department Code">
            </div>
            <div class="form-group">
                <label for="department">Department Name</label>
                <input type="text" id="department" name="department_name" required placeholder="Enter Department Name">
            </div>
            <button type="submit">Register Department</button>
        </form>
        <br>
        <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
    </div>
</body>
</html>
