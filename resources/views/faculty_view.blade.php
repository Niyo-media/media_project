

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculties</title>
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
        <a href="/admin/dashboard" class="dashboard-btn">Back to Dashboard</a>
    </div>
    <h2>Manage Faculties</h2>
    @if(session('success'))
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('faculties.index') }}">
        <div class="form-group">
            <label for="campus">Select Campus</label>
            <select id="campus" name="campus_id" required onchange="this.form.submit()">
                <option value="">Select Campus</option>
                @foreach($campuses as $campus)
                    <option value="{{ $campus->campus_id }}" {{ request('campus_id') == $campus->campus_id ? 'selected' : '' }}>
                        {{ $campus->campus_name }}
                    </option>
                @endforeach
            </select>
        </div>

        @if(request('campus_id'))
        <div class="form-group">
            <label for="department">Select Department</label>
            <select id="department" name="department_code" required onchange="this.form.submit()">
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->department_code }}" {{ request('department_code') == $department->department_code ? 'selected' : '' }}>
                        {{ $department->department_name }}
                    </option>
                @endforeach
            </select>
        </div>
        @endif
    </form>

    @if(request('department_code') && count($faculties) > 0)
    <table>
        <thead>
            <tr>
                <th>Faculty Code</th>
                <th>Faculty Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faculties as $faculty)
            <tr>
                <td>{{ $faculty->faculty_code }}</td>
                <td>{{ $faculty->faculty_name }}</td>
                <td>
                <a href="{{ route('faculties.edit', ['faculty' => $faculty->faculty_code]) }}" class="btn edit-btn btn-warning">Edit</a>

                    <form action="{{ route('faculties.destroy', $faculty->faculty_code) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn delete-btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    @if(request('department_code') && count($faculties) == 0)
        <div class="alert alert-success" style="background-color: #d4edda; color:rgb(207, 85, 9); padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            No faculties available
        </div>
    @endif
</div>

</body>
</html>
