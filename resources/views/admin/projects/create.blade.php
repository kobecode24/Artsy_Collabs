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
        <label for="title">Project Title:</label>
        <input type="text" name="title" id="title" required>
    </div>
    <div>
        <label for="description">Project Description:</label>
        <textarea name="description" id="description" required></textarea>
    </div>
    <div>
        <label for="requirements">Project requirements:</label>
        <textarea name="requirements" id="requirements" required></textarea>
    </div>
    <div>
        <label for="image">Project Image:</label>
        <input type="file" name="image" id="image">
    </div>
    <!-- Artist Selection -->
    <div class="mb-3">
        <label for="artist_ids" class="form-label">Artists:</label>
        <select class="form-control" id="artist_ids" name="artist_ids[]" multiple>
            @foreach($artists as $artist)
                <option value="{{ $artist->id }}">{{ $artist->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Partner Selection -->
    <div class="mb-3">
        <label for="partner_ids" class="form-label">Partners:</label>
        <select class="form-control" id="partner_ids" name="partner_ids[]" multiple>
            @foreach($partners as $partner)
                <option value="{{ $partner->id }}">{{ $partner->title }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Add Project</button>
</form>
</body>
</html>
