@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-3xl font-semibold text-center text-gray-800">Add New Project</h1>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-5">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="mt-5 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Project Title:</label>
                <input type="text" name="title" id="title" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Project Description:</label>
                <textarea name="description" id="description" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>
            <div class="mb-4">
                <label for="requirements" class="block text-gray-700 text-sm font-bold mb-2">Project Requirements:</label>
                <textarea name="requirements" id="requirements" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Project Image:</label>
                <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="artist_ids" class="block text-gray-700 text-sm font-bold mb-2">Artists:</label>
                <select id="artist_ids" name="artist_ids[]" multiple class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($artists as $artist)
                        <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="partner_ids" class="block text-gray-700 text-sm font-bold mb-2">Partners:</label>
                <select id="partner_ids" name="partner_ids[]" multiple class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($partners as $partner)
                        <option value="{{ $partner->id }}">{{ $partner->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Project</button>
        </form>
    </div>
@endsection
