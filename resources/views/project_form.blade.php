<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Project Proposal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Project Proposal Submission</h2>
        
        @if(session('success'))
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif
        <form action="/projects" method="POST">
            @csrf
            <input type="text" hidden name="student_reg_number" id="student_reg_number" class="form-control" value="{{$student_reg_number}}" required>
            <input type="hidden" name="department_code" value="{{ $department_code }}">
            <input type="hidden" name="faculty_code" value="{{ $faculty_code }}">

            <div class="form-group mb-3">
                <label for="project_name">Project Name </label>
                <input type="text" name="project_name" id="project_name" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="project_problem">Project Problem</label>
                <textarea name="project_problem" id="project_problem" class="form-control" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="project_solution">Project Solution</label>
                <textarea name="project_solution" id="project_solution" class="form-control" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="project_abstract">Project Abstract</label>
                <textarea name="project_abstract" id="project_abstract" class="form-control" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="project_dissertation">Project Dissertation</label>
                <textarea name="project_dissertation" id="project_dissertation" class="form-control" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="project_source_code">Project Source Code</label>
                <textarea name="project_source_code" id="project_source_code" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Project Proposal</button>
        </form>
    </div>
</body>
</html>
