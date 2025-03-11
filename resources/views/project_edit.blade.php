<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Project Proposal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
        }

    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Project Proposal</h2>
        @if(session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('error') }}
        </div>
    @endif
        <form action="/projects/{{$project->project_code}}/update" method="POST">
            @csrf
            @method('PUT')

            <label>Project Name:</label>
            <input type="text" name="project_code" class="form-control" value="{{ $project->project_code }}" hidden required>
            <input type="text" name="project_name" class="form-control" value="{{ $project->project_name }}" required>

            <label>Project Problem:</label>
            <textarea name="project_problem" class="form-control" required>{{ $project->project_problem }}</textarea>

            <label>Project Solution:</label>
            <textarea name="project_solution" class="form-control" required>{{ $project->project_solution }}</textarea>

        
            <label>Project Abstract:</label>
            <textarea name="project_abstract" class="form-control" required>{{ $project->project_abstract }}</textarea>

            <label>Project Dissertation:</label>
            <textarea name="project_dissertation" class="form-control" required>{{ $project->project_dissertation }}</textarea>

            <label>Project Source Code:</label>
            <textarea name="project_source_code" class="form-control" required>{{ $project->project_source_code }}</textarea>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</body>
</html>
