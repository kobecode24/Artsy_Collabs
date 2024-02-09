<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project List</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Projects</h1>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Add New Project</a>
    <div class="mt-3">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        @if($project->getFirstMediaUrl('projects'))
                            <img src="{{ $project->getFirstMediaUrl('projects') }}" alt="Project Image" style="width: 100px; height: auto;">
                        @else
                            No Image Available
                        @endif
                    </td>
                    <td>{{ $project->title }}</td>
                    <td>{{ Str::limit($project->description, 50) }}</td>
                    <td>
                        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
