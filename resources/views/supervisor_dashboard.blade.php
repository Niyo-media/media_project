<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            color: #333;
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

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color:rgb(12, 12, 12);
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
            background-color:rgb(148, 155, 160);
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

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
         /* Footer Styling */
         footer {
            background-color:rgb(62, 13, 41);
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 180px;
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
        .header {
            background-color:rgb(62, 13, 41);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 2rem;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }

            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 150px;
            }

            .main-content {
                margin-left: 150px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
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

    </style>
</head>
<body>

    <!-- Header -->
    <!-- Header Section -->
    <div class="header">
        <h2>Welcome to FYP Portal</h2>
    </div>


    <!-- Sidebar -->
    <div class="sidebar">
    <img src="../logo.jpg" alt="Logo">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Assigned Projects</a></li>
            <li><a href="/supervisor/login">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <h1>Welcome, Supervisor {{ session('supervisor_name') }}</h1>
        <p>Manage your assigned students and projects efficiently.</p>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">

            <!-- Project Approvals Card -->
            <div class="dashboard-card">
                <i class="fas fa-check-circle"></i>
                <h3>Project Approvals</h3>
                <a href="/projects/{{ session('supervisor_email') }}/approval">Assigned Projects</a>

                

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
