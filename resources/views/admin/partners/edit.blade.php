<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Partner</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Partner</h2>
    <form action="{{ route('admin.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $partner->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description">{{ $partner->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image (leave blank to keep current image):</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($partner->getFirstMediaUrl('partner'))
                <div class="mt-2">
                    <img src="{{ $partner->getFirstMediaUrl('partner') }}" alt="Current Image" style="max-width: 200px;">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>

