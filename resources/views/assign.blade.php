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
            <th>Supervisor</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr>
            <td>{{ $project->project_code }}</td>
            <td>{{ $project->project_name }}</td>
            <td>{{ $project->student_reg_number }}</td>
            <td>{{ $project->supervisor_email ? $project->supervisor_email : 'Not Assigned' }}</td>
            <td>{{ $project->comment }}</td>
            <td>{{ $project->status }}</td>
            <td>
                <a href="{{ route('projects.show', $project->project_code) }}" class="btn btn-primary">View</a>
                <a href="{{ route('projects.assignSupervisorForm', $project->project_code) }}" class="btn btn-info">Assign Supervisor</a>
                <form action="{{ route('projects.destroy', $project->project_code) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this project?');">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
</body>
</html>