<!-- resources/views/homepage.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Blue background for the entire page */
        body {
            background-color: #007BFF;
            color: white;
            font-family: Arial, sans-serif;
        }

        /* Container to center the content */
        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            flex-direction: column;
        }

        /* Main heading styles */
        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        /* Description styling */
        p {
            font-size: 1.2rem;
            margin-bottom: 40px;
        }

        /* Styling for the role buttons */
        .role-button {
            background-color: white;
            color:rgb(7, 7, 7);
            padding: 15px 30px;
            margin: 10px;
            font-size: 1.2rem;
            text-decoration: none;
            border-radius: 5px;
            width: 250px;
            transition: background-color 0.3s;
        }

        /* Hover effect for the buttons */
        .role-button:hover {
            background-color:rgb(19, 127, 243);
            color: white;
        }

        /* Optional: Add box shadow to the buttons */
        .role-button:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(0, 255, 42, 0.5);
        }
    </style>
</head>
<body>

    <div class="main-container">
        <h1>Welcome to RP Management System</h1>
        <p>Select your role to continue</p>
        
        <!-- Role-based links -->
        <a href="{{ route('admin.dashboard') }}" class="role-button">Admin</a>
        <a href="{{ route('hod.dashboard') }}" class="role-button">Head of Department</a>
        <a href="{{ route('supervisor.dashboard') }}" class="role-button">Supervisor</a>
        <a href="{{ route('student.dashboard') }}" class="role-button">Student</a>
       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
