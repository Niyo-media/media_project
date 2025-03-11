<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Details</title>
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

        p {
            font-size: 16px;
            margin-bottom: 12px;
            color: #555;
        }

        strong {
            color: #333;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
            text-decoration: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        form {
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Project Details</h2>
        <p><strong>Project Code:</strong> {{ $project->project_code }}</p>
        <p><strong>Project Name:</strong> {{ $project->project_name }}</p>
        <p><strong>Problem:</strong> {{ $project->project_problem }}</p>
        <p><strong>Solution:</strong> {{ $project->project_solution }}</p>
        <p><strong>Abstract:</strong> {{ $project->project_abstract }}</p>
        <p><strong>Dissertation:</strong> {{ $project->project_dissertation }}</p>
        <p><strong>Source Code:</strong> {{ $project->project_source_code }}</p>
        <p><strong>Supervisor Comment:</strong> {{ $project->comment }}</p>
        <p><strong>Project Status:</strong> {{ $project->status }}</p>
    </div>
</body>
</html>
