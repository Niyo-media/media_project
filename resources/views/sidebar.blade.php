



<style>/* Sidebar Styling */
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
</style>
    
        <div class="sidebar">
        
            <img src="../logo.jpg" alt="Logo">
        
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="project_view">View Projects</a></li>
            <li><a href="/project_form">My Proposal</a></li>
           <li>
            <form action="{{ route('student.logout') }}" method="POST">
            @csrf
            <div class="logout-container">
            <a href=""><button type="submit" class="btn">Logout</button></a></div>
            </form></li>
        </ul>
    </div>
        