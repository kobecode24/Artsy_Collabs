<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Project</title>
</head>
<body>
<h1>Add New Project</h1>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Project Name:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="description">Project Description:</label>
        <textarea name="description" id="description" required></textarea>
    </div>
    <div>
        <label for="image">Project Image:</label>
        <input type="file" name="image" id="image">
    </div>
    <button type="submit">Add Project</button>
</form>
</body>
</html>
