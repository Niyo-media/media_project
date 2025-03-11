<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline';">
    <title>Register Student</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { width: 50%; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        select, input { width: 100%; padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; }
        .hidden { display: none; }
        .btn { background: #4CAF50; color: white; padding: 10px; width: 100%; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #45a049; }
        .search-btn { margin-top: 5px; }
    </style>
    <script>
        function fetchDepartments() {
            let campusId = document.getElementById("campus").value;
            let departmentDiv = document.getElementById("department-selection");
            let departmentSelect = document.getElementById("department");

            departmentSelect.innerHTML = '<option value="">Select Department</option>';

            if (campusId) {
                fetch(`/departments/by-campus/${campusId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        alert("No departments found for this campus.");
                    } else {
                        data.forEach(dept => {
                            let option = document.createElement("option");
                            option.value = dept.department_code;
                            option.text = dept.department_name;
                            departmentSelect.appendChild(option);
                        });
                        departmentDiv.classList.remove("hidden"); 
                    }
                })
                .catch(error => {
                    console.error("Error fetching departments:", error);
                    alert("Failed to load departments.");
                });
            } else {
                departmentDiv.classList.add("hidden");
            }
        }

        function fetchFaculties() {
            let departmentCode = document.getElementById("department").value;
            let facultyDiv = document.getElementById("faculty-selection");
            let facultySelect = document.getElementById("faculty");

            facultySelect.innerHTML = '<option value="">Select Faculty</option>';

            if (departmentCode) {
                fetch(`/faculties/by-department/${departmentCode}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        alert("No faculties found for this department.");
                    } else {
                        data.forEach(fac => {
                            let option = document.createElement("option");
                            option.value = fac.faculty_code;
                            option.text = fac.faculty_name;
                            facultySelect.appendChild(option);
                        });
                        facultyDiv.classList.remove("hidden"); 
                    }
                })
                .catch(error => {
                    console.error("Error fetching faculties:", error);
                    alert("Failed to load faculties.");
                });
            } else {
                facultyDiv.classList.add("hidden");
            }
        }

        function setHiddenFields() {
        document.getElementById('campus_id').value = document.getElementById('campus').value;
        document.getElementById('department_code').value = document.getElementById('department').value;
        document.getElementById('faculty_code').value = document.getElementById('faculty').value;
    }
    </script>
</head>
<body>

<div class="container">
    <h2>Student Registration Form</h2>
    @if(session('success'))
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Select Campus -->
    <div class="form-group">
        <label for="campus">Select Campus</label>
        <select id="campus" name="campus_id" required>
            <option value="">Select Campus</option>
            @foreach($campuses as $campus)
                <option value="{{ $campus->campus_id }}">{{ $campus->campus_name }}</option>
            @endforeach
        </select>
        <button type="button" class="btn search-btn" onclick="fetchDepartments()">Search</button>
    </div>

    <!-- Select Department -->
    <div id="department-selection" class="form-group hidden">
        <label for="department">Select Department</label>
        <select id="department" name="department_code" required>
            <option value="">Select Department</option>
        </select>
        <button type="button" class="btn search-btn" onclick="fetchFaculties()">Search</button>
    </div>

    <!-- Select Faculty -->
    <div id="faculty-selection" class="form-group hidden">
        <label for="faculty">Select Faculty</label>
        <select id="faculty" name="faculty_code" required>
            <option value="">Select Faculty</option>
        </select>
    </div>

    <form action="{{ route('students.store') }}" method="POST" onsubmit="setHiddenFields()">
        @csrf
        <input type="hidden" id="campus_id" name="campus_id">
        <input type="hidden" id="department_code" name="department_code">
        <input type="hidden" id="faculty_code" name="faculty_code">

        <div class="form-group">
            <label for="Reg_number">Registration Number</label>
            <input type="text" id="student_reg_number" name="student_reg_number" required>
        </div>
        
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn">Register Student</button>
    </form>
    <br>
    Already have an account? <a href="/student/login">Login Here</a>
</div>

</body>
</html>
