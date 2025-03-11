<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Faculty</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { width: 50%; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; }
        .btn { background: #4CAF50; color: white; padding: 10px; width: 100%; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #45a049; }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Faculty</h2>

    <form action="{{ route('faculties.update', $faculty->faculty_code) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="faculty_code">Faculty Code</label>
            <input type="text" id="faculty_code" name="faculty_code" value="{{ $faculty->faculty_code }}" required>
        </div>

        <div class="form-group">
            <label for="faculty_name">Faculty Name</label>
            <input type="text" id="faculty_name" name="faculty_name" value="{{ $faculty->faculty_name }}" required>
        </div>

        <button type="submit" class="btn">Update Faculty</button>
    </form>
</div>

</body>
</html>

