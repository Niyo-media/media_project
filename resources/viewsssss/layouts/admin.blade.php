<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-900 text-white min-h-screen p-4">
            <h2 class="text-lg font-bold">Admin Panel</h2>
            <ul class="mt-4">
                <li><a href="{{ route('admin.dashboard') }}" class="block py-2">Dashboard</a></li>
                <li><a href="{{ route('admin.users') }}" class="block py-2">Manage Users</a></li>
                <li><a href="{{ route('admin.projects') }}" class="block py-2">Manage Projects</a></li>
                <li><a href="{{ route('admin.supervisors') }}" class="block py-2">Manage Supervisors</a></li>
                <li><a href="{{ route('logout') }}" class="block py-2 text-red-500">Logout</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>
</body>
</html>
