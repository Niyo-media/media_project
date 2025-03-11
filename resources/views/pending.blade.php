<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Project List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Pending Project List</h2>
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
            <td>{{ $project->comment }}</td>
            <td>{{ $project->status }}</td>
            <td>
                <a href="{{ route('projects.show', $project->project_code) }}" class="btn btn-primary">view</a>
                <form action="{{ route('projects.destroy', $project->project_code) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('put')
                    <input type="text" class="form-control" name="project_code" value="{{ $project->project_code }}" hidden disabled>
                    <input type="text" class="form-control" name="status" value="Approved" hidden disabled>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Approve this project?');">Approve</button>
                </form>
                <form action="{{ route('projects.destroy', $project->project_code) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('put')
                    <input type="text" class="form-control" name="status" value="Rejected" hidden disabled>
                    <input type="text" class="form-control" name="project_code" value="{{ $project->project_code }}" hidden disabled>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Reject this project?');">Reject</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
</body>
</html>