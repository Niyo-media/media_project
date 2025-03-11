<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Students</title>
    <style>
        /* Basic styles for table */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: rgb(187, 178, 184); }
        .container { width: 80%; margin: 50px auto; padding: 20px; background-color: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #4CAF50; color: white; }
        tr:hover { background-color: #f5f5f5; }
        .btn { background-color: #4CAF50; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registered Students</h2>
        <table>
            <thead>
                <tr>
                    <th>Registration No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->stud_regno }}</td>
                    <td>{{ $student->stud_fname }}</td>
                    <td>{{ $student->stud_lname }}</td>
                    <td>{{ $student->stud_gender }}</td>
                    <td>{{ $student->stud_email }}</td>
                    <td>{{ $student->depart_code }}</td>
                    <td>{{ $student->stud_phone }}</td>
                    <td>
                        <a href="{{ route('edit', $student->id) }}" class="btn">Edit</a>
                        <form action="{{ route('delete', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background-color: red;">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
