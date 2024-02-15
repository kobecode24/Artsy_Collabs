@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-semibold text-gray-800">Projects</h1>
        <a href="{{ route('admin.projects.create') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New Project</a>
        <div class="mt-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="shadow overflow-hidden rounded border-b border-gray-200 mt-4">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">#</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Image</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Title</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Description</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    @foreach($projects as $project)
                        <tr>
                            <td class="text-left py-3 px-4">{{ $loop->iteration }}</td>
                            <td class="text-left py-3 px-4">
                                @if($project->getFirstMediaUrl('projects'))
                                    <img src="{{ $project->getFirstMediaUrl('projects') }}" alt="Project Image" class="h-10 w-10 rounded-full">
                                @else
                                    No Image Available
                                @endif
                            </td>
                            <td class="text-left py-3 px-4">{{ $project->title }}</td>
                            <td class="text-left py-3 px-4">{{ Str::limit($project->description, 50) }}</td>
                            <td class="text-left py-3 px-4">
                                <a href="{{ route('admin.projects.show', $project) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">View</a>
                                <a href="{{ route('admin.projects.edit', $project) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-xs">Edit</a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection




