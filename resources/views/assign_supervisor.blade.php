<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Supervisor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Assign Supervisor to Project</h2>
        @if(session('success'))
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('projects.assignSupervisor', $project->project_code) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Project Name:</label>
            <input type="text" class="form-control" name="project_code" value="{{ $project->project_code }}" hidden disabled>
            <input type="text" class="form-control" name="department_code" value="{{ $project->department_code }}" hidden disabled>
            <input type="text" class="form-control" name="project_name" value="{{ $project->project_name }}" disabled>

            <label>Select Supervisor:</label>
            <select name="supervisor_email" class="form-control" required>
                <option value="">-- Choose Supervisor --</option>
                @foreach($supervisors as $supervisor)
                    <option value="{{ $supervisor->email }}" {{ $project->supervisor_email == $supervisor->email ? 'selected' : '' }}>
                        {{ $supervisor->first_name }} {{ $supervisor->last_name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary mt-3">Assign</button>
        </form>
    </div>
</body>
</html>
