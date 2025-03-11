<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            color: #333;
        }

        .btn {
            padding: 6px 10px;
            border: none;
            background-color: red;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        /* Header Styling */
        .header {
            background-color: #003366;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 2rem;
        }

        /* Logo and Navigation Bar */
        .top-right-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
        }

        .logo-container img {
            height: 80px;
            width: auto;
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

        /* Dashboard Title */
        h1 {
            text-align: center;
            color: #003366;
            margin: 30px 0;
            font-size: 2rem;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 0 20px;
            padding-top: 60px;
        }

        /* Dashboard Card Styling */
        .dashboard-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s ease-in-out;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .dashboard-card h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: #003366;
        }

        .dashboard-card a {
            text-decoration: none;
            background-color: #003366;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .dashboard-card a:hover {
            background-color: #002244;
        }

        .dashboard-card i {
            font-size: 40px;
            margin-bottom: 15px;
            color: #cc2936;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .top-right-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .logout-container a {
                margin-left: 0;
                margin-top: 10px;
            }
        }

    </style>
</head>
<body>
<div style="height: 73vh;">
    <div class="header">
        <h2>Welcome to FYP System </h2>
    </div>

    <div class="top-right-container">
        <div class="logo-container">
            <img src="../logo.jpg" alt="Logo">
        </div>
        <div class="logout-container">
        <h2>Welcome, {{ session('hod_name') }}</h2>
        </div>
        <form action="{{ route('hod.logout') }}" method="POST">
        @csrf
        <div class="logout-container">
        <a href=""><button type="submit" class="btn">Logout</button></a></div>
    </form>
    </div>

   
    
    <div class="dashboard-grid">
        <!-- Supervisor Management Card -->
        <div class="dashboard-card">
            <i class="fas fa-sitemap"></i>
            <h3>Supervisor Management</h3>
            <a href="/supervisors/{{session('department_code')}}/list">View Supervisor</a>
        </div>

        <!-- Student Management Card -->
        <div class="dashboard-card">
            <i class="fas fa-box"></i>
            <h3>Student Management</h3>
            <a href="/students/{{session('department_code')}}/list">View Students</a>
            <a href="/projects/{{ session('department_code') }}/assign">View Projects</a>
        </div>
    </div>
    </div>
   <!-- Footer -->
<footer>
    <p>&copy; 2024 RP FYP | All rights reserved</p>
    <p>
        <strong>Contact Us:</strong><br>
        Email: <a href="mailto:rp.gmail.com">rp@gmail.com</a><br>
        Website: <a href="https://www.rp.ac.rw" target="_blank">www.rp.ac.rw</a><br>
        Address: Kicukiro, Rwanda
    </p>
</footer>

<style>
    /* Footer Styling */
    footer {
        background-color: #003366;
        color: white;
        text-align: center;
        padding: 20px 0;
        margin-top: 40px;  /* Space above the footer */
        width: 100%; /* Ensure the footer spans the entire width */
        position: relative;
        bottom: 0;
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

    footer strong {
        display: block;
        margin-bottom: 10px;
        font-size: 1rem;
    }

    /* Ensure footer stays at the bottom */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
    }
</style>


</body>
</html>
