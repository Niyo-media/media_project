@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold">Manage Users</h1>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                    <td class="border px-4 py-2">
                        <a href="#" class="text-blue-500">Edit</a> |
                        <a href="#" class="text-red-500">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
