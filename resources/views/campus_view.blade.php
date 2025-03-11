<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus List</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { width: 80%; margin: 0 auto; background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; margin-bottom: 20px; }
        .top-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .dashboard-btn { background-color: #333; color: white; padding: 10px 15px; border: none; cursor: pointer; border-radius: 4px; text-decoration: none; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #4CAF50; color: white; }
        tr:hover { background-color: #f5f5f5; }
        .action-btns { display: flex; gap: 10px; }
        .edit-btn { background-color: #2196F3; color: white; padding: 5px 10px; border: none; cursor: pointer; border-radius: 4px; text-decoration: none; }
        .delete-btn { background-color: #f44336; color: white; padding: 5px 10px; border: none; cursor: pointer; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-nav">
            <h2>Registered Campuses</h2>
            <a href="/admin/dashboard" class="dashboard-btn">Back to Dashboard</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Campus ID</th>
                    <th>Campus Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($campuses as $campus)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $campus->campus_id }}</td>
                    <td>{{ $campus->campus_name }}</td>
                    <td class="action-btns">
                        <a href="{{ route('campus.edit', ['campus' => $campus->campus_id]) }}" class="edit-btn">Edit</a>
                        <form action="{{ route('campus.destroy', $campus->campus_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
