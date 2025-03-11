<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create HOD Account</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { width: 50%; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        select, input { width: 100%; padding: 8px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; }
        .btn { background: #4CAF50; color: white; padding: 10px; width: 100%; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #45a049; }
        .hidden { display: none; }
    </style>
    <script>
        function fetchDepartments() {
            let campusId = document.getElementById("campus").value;
            let departmentSelect = document.getElementById("department");

            departmentSelect.innerHTML = '<option value="">Select Department</option>';
            
            if (campusId) {
                fetch(`/departments/by-campus/${campusId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(dept => {
                        let option = document.createElement("option");
                        option.value = dept.department_code;
                        option.text = dept.department_name;
                        departmentSelect.appendChild(option);
                    });
                    departmentSelect.parentElement.classList.remove("hidden");
                });
            } else {
                departmentSelect.parentElement.classList.add("hidden");
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Create HOD Account</h2>
    
    @if(session('success'))
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('hods.store') }}" method="POST">
        @csrf

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
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="campus">Select Campus</label>
            <select id="campus" name="campus_id" required>
                <option value="">Select Campus</option>
                @foreach($campuses as $campus)
                    <option value="{{ $campus->campus_id }}">{{ $campus->campus_name }}</option>
                @endforeach
            </select>
            <br><br>
            <button type="button" class="btn search-btn" onclick="fetchDepartments()">Search</button>
            <br><br>
        </div>

        <!-- Select Department (Appears after Campus Search) -->
        <div id="department-selection" class="form-group hidden">
            <label for="department">Select Department</label>
            <select id="department" name="department_code" required>
                <option value="">Select Department</option>
                @foreach($departments as $department)
                <option value="{{ $department->department_code}}">{{$department->department_name}}</option>
                @endforeach

            </select>
        </div>

        <button type="submit" class="btn">Create Account</button>
    </form>

    
    <br>
    Already have an account : <a href="/hod/login">Login Here</a>
</div>

</body>
</html>
