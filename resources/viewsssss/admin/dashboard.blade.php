@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold">Admin Dashboard</h1>
    <div class="grid grid-cols-3 gap-6 mt-6">
        <div class="bg-white p-6 shadow rounded-lg">
            <h2 class="text-lg font-bold">Total Students</h2>
            <p>{{ \App\Models\User::where('role', 'student')->count() }}</p>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
            <h2 class="text-lg font-bold">Total Supervisors</h2>
            <p>{{ \App\Models\User::where('role', 'supervisor')->count() }}</p>
        </div>
        <div class="bg-white p-6 shadow rounded-lg">
            <h2 class="text-lg font-bold">Total Projects</h2>
            <p>{{ \App\Models\Project::count() }}</p>
        </div>
    </div>
@endsection
