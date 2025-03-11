<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - RP FYP Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Header */
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

        /* About Section */
        .about-container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-container h3 {
            color: #003366;
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .about-container p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 15px;
            text-align: justify;
        }

        .about-container ul {
            list-style-type: none;
            padding: 0;
        }

        .about-container ul li {
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .about-container h4 {
            color: #003366;
            font-size: 1.5rem;
            margin-top: 30px;
        }

        /* Footer */
        footer {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
            width: 100%;
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
    </style>
</head>
<body>

    <div class="header">
        <h2>About RP FYP Portal</h2>
    </div>

    <div class="about-container">
        <h3>About Rwanda Polytechnic (RP) and FYP Portal</h3>
        <p>Rwanda Polytechnic (RP) is a public higher learning institution located in Kigali city, Kicukiro District, with multiple IPRC campuses spread across the country. RP provides opportunities for students to develop innovative solutions through their final year projects (FYP), which have a meaningful impact on society.</p>
        
        <p>Every year, more than 1,000 RP students engage in FYPs, producing both dissertation books and implemented project source codes. The institution ensures that a project is already developed before being assigned to a student in order to avoid redundancy and encourage independent thinking. The goal is to promote innovation and problem-solving among students rather than merely cloning existing ideas.</p>

        <h4>RP/FYP Portal Overview</h4>
        <p>The RP/FYP Portal aims to support students in managing their final year projects by providing a platform where they can create accounts, log in, search for existing projects, and submit project proposals. The department assigns projects to students, and supervisors are tasked with guiding students through the project process.</p>

        <h4>Database Model for FYP Portal</h4>
        <p>The RP/FYP Portal uses a database model to manage student, project, department, supervisor, and campus data. The model includes several tables:</p>
        <
