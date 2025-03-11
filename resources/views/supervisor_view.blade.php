


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisors</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { width: 60%; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        select, input { width: 100%; padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; }
        .hidden { display: none; }
        .btn { background: #4CAF50; color: white; padding: 10px; width: 50%; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #45a049; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #4CAF50; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .btn { padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer; }
        .edit-btn { background: #2196F3; color: white; }
        .delete-btn { background: #f44336; color: white; }
    </style>
</head>
<body>

<div class="container">
<div class="top-nav">
        <a href="/hod/dashboard" class="dashboard-btn">Back to Dashboard</a>
    </div>
    <h2>Manage Supervisors</h2>
    @if(session('success'))
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Campus</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($supervisors as $supervisor)
            <tr>
                <td>{{ $supervisor->first_name }}</td>
                <td>{{ $supervisor->last_name }}</td>
                <td>{{ $supervisor->email }}</td>
                <td>{{ $supervisor->phone_number }}</td>
                <td>{{ $supervisor->campus->campus_name }}</td>
                <td>{{ $supervisor->department->department_name }}</td>
                <td>
                    <!-- <a href="{{ route('supervisors.edit', $supervisor->email) }}" class="edit-btn">Edit</a> -->
                    <form action="{{ route('supervisors.destroy', $supervisor->email) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if(request('department_code') && count($supervisors) == 0)
        <div class="alert alert-success" style="background-color: #d4edda; color:rgb(207, 85, 9); padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            No Supervisors available
        </div>
    @endif
</div>

</body>
</html>
