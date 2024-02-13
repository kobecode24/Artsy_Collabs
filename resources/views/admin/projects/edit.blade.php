<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<div class="max-w-4xl mx-auto py-12">
    <h2 class="text-2xl font-semibold mb-6 text-center">Edit Project</h2>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p class="font-bold">Please correct the errors below:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-8">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" required>
            @error('title')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
            <textarea id="description" name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror" required>{{ old('description', $project->description) }}</textarea>
            @error('description')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="requirements" class="block text-gray-700 text-sm font-bold mb-2">Requirements:</label>
            <textarea id="requirements" name="requirements" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required>{{ old("requirements", $project->requirements) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="artist_ids" class="block text-gray-700 text-sm font-bold mb-2">Artists:</label>
            <select id="artist_ids" name="artist_ids[]" multiple class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($artists as $artist)
                    <option value="{{ $artist->id }}" @if(in_array($artist->id, old('artist_ids', $project->artists->pluck('id')->toArray()))) selected @endif>{{ $artist->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="partner_ids" class="block text-gray-700 text-sm font-bold mb-2">Partners:</label>
            <select id="partner_ids" name="partner_ids[]" multiple class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($partners as $partner)
                    <option value="{{ $partner->id }}" @if(in_array($partner->id, old('partner_ids', $project->partners->pluck('id')->toArray()))) selected @endif>{{ $partner->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Project Image:</label>
            <input type="file" id="image" name="image" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror">
            @if($project->getFirstMedia('projects'))
                <img src="{{ $project->getFirstMediaUrl('projects') }}" alt="Project Image" class="mt-2 max-w-xs">
            @endif
            @error('image')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
    </form>
</div>
</body>
</html>
