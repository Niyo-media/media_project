

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Supervisor</title>
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

        // Reset previous options
        departmentSelect.innerHTML = '<option value="">Select Department</option>';

        if (campusId) {
            fetch(`/departments/by-campus/${campusId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not OK');
                }
                return response.json();
            })
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
                    departmentDiv.classList.remove("hidden"); // Show department dropdown
                }
            })
            .catch(error => {
                console.error("Error fetching departments:", error);
                alert("Failed to load departments.");
            });
        } else {
            departmentDiv.classList.add("hidden"); // Hide if no campus selected
        }
    }

    function setHiddenFields() {
        document.getElementById('campus_id').value = document.getElementById('campus').value;
        document.getElementById('department_code').value = document.getElementById('department').value;
    }
    </script>
</head>
<body>

<div class="container">
    <div class="top-nav">
    </div>
    <h2>Register Supervisor</h2>
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

    <div id="department-selection" class="form-group hidden">
        <label for="department">Select Department</label>
        <select id="department" name="department_code" required>
            <option value="">Select Department</option>
            @foreach($departments as $department)
            <option value="{{ $department->department_code}}">{{$department->department_name}}</option>
            @endforeach

        </select>
        <!-- <button type="button" class="btn search-btn" onclick="showFacultyForm()">Search</button> -->
    </div>

    <!-- Faculty Form (Appears after Department Selection) -->

    <form action="{{ route('supervisors.store') }}" method="POST" onsubmit="setHiddenFields()">
        @csrf
        <input type="hidden" id="campus_id" name="campus_id">
        <input type="hidden" id="department_code" name="department_code">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>
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

        <button type="submit" class="btn">Register Supervisor</button>
    </form>
    <br>
    Already have an account : <a href="/supervisor/login">Login Here</a>
</div>

</body>
</html>
