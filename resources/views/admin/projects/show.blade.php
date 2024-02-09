<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Project Details</h2>
    <div><strong>Title:</strong> {{ $project->title }}</div>
    <div><strong>Description:</strong> {{ $project->description }}</div>
    <div><strong>Requirements:</strong> {{ $project->requirements }}</div>

    <!-- Project Image -->
    @if($project->getFirstMedia('projects'))
        <div><strong>Image:</strong><br>
            <img src="{{ $project->getFirstMediaUrl('projects') }}" alt="Project Image" style="max-width: 300px;">
        </div>
    @else
        <div><strong>Image:</strong> No Image Available</div>
    @endif

    <!-- Artists -->
    <h3>Artists</h3>
    @if($project->artists->isNotEmpty())
        @foreach($project->artists as $artist)
            <div>
                <div>{{ $artist->name }}</div>
                @if($artist->getFirstMedia('images'))
                <img src="{{ $artist->getFirstMediaUrl('images') }}" alt="Artist Image" style="width: 100px;">
                @else
                    <div>No Image Available</div>
                @endif
            </div>
        @endforeach
    @else
        <div>No artists associated with this project.</div>
    @endif

    <!-- Partners -->
    <h3>Partners</h3>
    @if($project->partners->isNotEmpty())
        @foreach($project->partners as $partner)
            <div>
                <div>{{ $partner->title }}</div>
                @if($partner->getFirstMedia('partners'))
                <img src="{{ $partner->getFirstMediaUrl('partners') }}" alt="Partner Image" style="width: 100px;">
                @else
                    <div>No Image Available</div>
                @endif
            </div>
        @endforeach
    @else
        <div>No partners associated with this project.</div>
    @endif

    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary mt-3">Back to Projects</a>
</div>
</body>
</html>
