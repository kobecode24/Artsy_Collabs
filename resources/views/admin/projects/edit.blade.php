<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Project</h2>

    <!-- Display General Errors If Any -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title Field -->
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $project->title) }}" required>
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description Field -->
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $project->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="requirements">Project requirements:</label>
            <textarea name="requirements" id="requirements" required>{{old("requirements", $project->requirements)}}</textarea>
        </div>

        <!-- Artist Selection -->
        <div class="mb-3">
            <label for="artist_ids" class="form-label">Artists:</label>
            <select class="form-control @error('artist_ids') is-invalid @enderror" id="artist_ids" name="artist_ids[]" multiple>
                @foreach($artists as $artist)
                    <option value="{{ $artist->id }}" @if(in_array($artist->id, old('artist_ids', $project->artists->pluck('id')->toArray()))) selected @endif>{{ $artist->name }}</option>
                @endforeach
            </select>
            @error('artist_ids')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Partner Selection -->
        <div class="mb-3">
            <label for="partner_ids" class="form-label">Partners:</label>
            <select class="form-control @error('partner_ids') is-invalid @enderror" id="partner_ids" name="partner_ids[]" multiple>
                @foreach($partners as $partner)
                    <option value="{{ $partner->id }}" @if(in_array($partner->id, old('partner_ids', $project->partners->pluck('id')->toArray()))) selected @endif>{{ $partner->title }}</option>
                @endforeach
            </select>
            @error('partner_ids')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Image Field -->
        <div class="mb-3">
            <label for="image" class="form-label">Project Image:</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @if($project->getFirstMedia('projects'))
                <img src="{{ $project->getFirstMediaUrl('projects') }}" alt="Project Image" style="max-width: 200px; display: block;">
            @endif
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
