<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Departments</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 70%;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .search-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        select {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            background-color: #fff;
        }

        button {
            padding: 10px 15px;
            border-radius: 5px;
            border: none;
            background-color: #28a745;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .btn {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .edit {
            background-color: #ffc107;
            color: white;
        }

        .edit:hover {
            background-color: #e0a800;
        }

        .delete {
            background-color: #dc3545;
            color: white;
        }

        .delete:hover {
            background-color: #c82333;
        }

        .loading {
            text-align: center;
            font-weight: bold;
            color: #007bff;
        }

        .no-data {
            text-align: center;
            color: red;
        }

        @media (max-width: 768px) {
            .search-container {
                flex-direction: column;
                align-items: stretch;
            }

            button {
                width: 100%;
            }
        }
    </style>
    <script>
    function searchDepartments() {
        let campusId = document.getElementById("campus").value;
        let tableBody = document.getElementById("departmentTableBody");

        if (campusId) {
            tableBody.innerHTML = `<tr><td colspan="3" class="loading">Loading departments...</td></tr>`;

            fetch(`/departments/search/${campusId}`)
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = "";

                if (data.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="3" class="no-data">No departments found</td></tr>`;
                } else {
                    data.forEach(dept => {
                        tableBody.innerHTML += `
                            <tr>
                                <td>${dept.department_code}</td>
                                <td>${dept.department_name}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="/departments/edit/${dept.department_code}" class="btn edit">Edit</a>
                                        <form action="/departments/delete/${dept.department_code}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn delete" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                }
            })
            .catch(error => {
                tableBody.innerHTML = `<tr><td colspan="3" class="no-data">Error loading departments</td></tr>`;
                console.error("Error:", error);
            });
        }
    }

    function confirmDelete(departmentId) {
        if (confirm("Are you sure you want to delete this department?")) {
            fetch(`/departments/delete/${departmentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(error => console.error("Error:", error));
        }
    }
</script>
</head>
<body>
    <div class="container">
        <div class="top-nav">
            <a href="/admin/dashboard" class="dashboard-btn">Back to Dashboard</a>
        </div>
        <h2>Select Campus and Search for Departments</h2>
        @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif
        <div class="search-container">
            <select id="campus">
                <option value="">Select Campus</option>
                @foreach($campuses as $campus)
                    <option value="{{ $campus->campus_id }}">{{ $campus->campus_name }}</option>
                @endforeach
            </select>
            <button onclick="searchDepartments()">Search</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Department Code</th>
                    <th>Department Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="departmentTableBody">
                <tr><td colspan="3" class="no-data">Select a campus and click search</td></tr>
            </tbody>
        </table>
    </div>
</body>
</html>
