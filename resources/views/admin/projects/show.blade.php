@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8 px-4">
        <h2 class="text-3xl font-semibold mb-6 text-center">Project Details</h2>
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="mb-4"><strong class="text-gray-700">Title:</strong> {{ $project->title }}</div>
            <div class="mb-4"><strong class="text-gray-700">Description:</strong> {{ $project->description }}</div>
            <div class="mb-4"><strong class="text-gray-700">Requirements:</strong> {{ $project->requirements }}</div>

            @if($project->getFirstMedia('projects'))
                <div class="mb-4"><strong class="text-gray-700">Image:</strong><br>
                    <img src="{{ $project->getFirstMediaUrl('projects') }}" alt="Project Image" class="max-w-xs rounded-lg">
                </div>
            @else
                <div class="mb-4"><strong class="text-gray-700">Image:</strong> No Image Available</div>
            @endif
        </div>

        <h3 class="text-2xl font-semibold mb-4">Artists</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @if($project->artists->isNotEmpty())
                @foreach($project->artists as $artist)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="flex items-center mb-2">
                            <div class="mr-2">{{ $artist->name }}</div>
                            @if($artist->getFirstMedia('images'))
                                <img src="{{ $artist->getFirstMediaUrl('images') }}" alt="Artist Image" class="w-10 h-10 rounded-full">
                            @else
                                <div>No Image Available</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white rounded-lg shadow-md p-4 text-gray-700">No artists associated with this project.</div>
            @endif
        </div>

        <h3 class="text-2xl font-semibold mt-8 mb-4">Partners</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @if($project->partners->isNotEmpty())
                @foreach($project->partners as $partner)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <div class="flex items-center mb-2">
                            <div class="mr-2">{{ $partner->title }}</div>
                            @if($partner->getFirstMedia('partners'))
                                <img src="{{ $partner->getFirstMediaUrl('partners') }}" alt="Partner Image" class="w-10 h-10 rounded-full">
                            @else
                                <div>No Image Available</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white rounded-lg shadow-md p-4 text-gray-700">No partners associated with this project.</div>
            @endif
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('admin.projects.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Projects</a>
        </div>
    </div>
@endsection



