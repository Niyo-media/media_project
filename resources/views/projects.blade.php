<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Project List</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Project Code</th>
            <th>Project Name</th>
            <th>Student Reg Number</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr>
            <td>{{ $project->project_code }}</td>
            <td>{{ $project->project_name }}</td>
            <td>{{ $project->student_reg_number }}</td>
            
            <td>
                <a href="{{ route('projects.show', $project->project_code) }}" class="btn btn-primary">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
</body>
</html>