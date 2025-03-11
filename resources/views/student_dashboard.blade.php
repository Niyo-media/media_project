<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - FYP Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

.sidebar {
    width: 250px;
    height: 100vh;
    background-color:rgb(192, 184, 94);
    position: fixed;
    top: 0;
    left: 0;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    padding: 15px;
    text-align: center;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    display: block;
    font-size: 1.2rem;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.sidebar ul li a:hover {
    background-color: #0055a5;
}

/* Add spacing for the main content */
body {
    margin-left: 250px; /* Make room for the sidebar */
    font-family: 'Arial', sans-serif;
}

/* Responsive Design for Mobile */
@media (max-width: 768px) {
    .sidebar {
        width: 200px;
    }

    body {
        margin-left: 200px;
    }
}

@media (max-width: 480px) {
    .sidebar {
        width: 150px;
    }

    body {
        margin-left: 150px;
    }
}

 img {
            height: 107px;
            width: auto;
        }

        .logo-container{
            margin: 0;
            padding: 0;
        }

.logout-container a {
    text-decoration: none;
    color: #003366;
    margin-left: 20px;
    font-weight: 600;
    transition: color 0.3s ease;
}

        .logout-container a:hover {
            color: #cc2936;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            color: #333;
        }

        .header {
            background-color:rgb(8, 156, 104);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 2rem;
        }

        /* Navigation Bar */
        .top-right-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
        }

        

        /* Dashboard Title */
        h1 {
            text-align: center;
            color: #003366;
            margin: 30px 0;
            font-size: 2rem;
        }

        /* Student Profile */
        .student-profile {
            text-align: center;
            margin-top: 200px;
        }

        .student-profile p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        /* Project List Section */
        .project-list {
            margin: 0 20px;
        }

        .project-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s ease-in-out;
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .project-card h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: #003366;
        }

        .project-card a {
            text-decoration: none;
            background-color: #003366;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .project-card a:hover {
            background-color: #002244;
        }

        /* Footer Styling */
        footer {
            background-color:rgb(8, 156, 104);
            color: white;
            text-align: center;
            padding: 40px 0;
            margin-top: 125px;
        }

        footer p {
            margin: 5px 0;
            font-size: 0.9rem;
        }

        footer a {
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
            margin: 0 5px;
        }

        footer a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
<div style="80vh">

    <!-- Header Section -->
    <div class="header">
        <h2>Welcome to FYP Portal</h2>
    </div>

    <div class="sidebar">
        
            <img src="../logo.jpg" alt="Logo">
        
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="/projects/{{ session('department_code') }}/list">View Projects</a></li>
            <li><a href="/projects/create/{{ session('student_reg_number') }}/{{ session('department_code') }}/{{ session('faculty_code') }}">Submit Proposal</a></li>
            <li><a href="/projects/{{ session('student_reg_number') }}/proposal">My Proposal</a></li>
           <li>
            <form action="{{ route('student.logout') }}" method="POST">
            @csrf
            <div class="logout-container">
            <a href=""><button type="submit" class="btn">Logout</button></a></div>
            </form></li>
        </ul>
    </div>

    <!-- Student Profile Section -->
    <div class="student-profile">
        <h1>Student Dashboard</h1>
        <p><b>Student Name: </b> {{ session('student_name') }}</p>
        <p><b>Registration Number: </b> {{ session('student_reg_number') }}</p>
        
    </div>

    </div>
    </div>
    

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 RP FYP | All rights reserved</p>
        <p>
            <strong>Contact Us:</strong><br>
            Email: <a href="mailto:rp@gmail.com">rp@gmail.com</a><br>
            Website: <a href="https://www.rp.ac.rw" target="_blank">www.rp.ac.rw</a><br>
            Address: Kicukiro, Rwanda
        </p>
    </footer>

</body>
</html>
