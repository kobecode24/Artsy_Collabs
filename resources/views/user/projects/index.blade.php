@extends('layouts.app')

@section('content')
    <body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-6">Available Projects</h1>
        <div class="flex flex-wrap -mx-4">
            @foreach($projects as $project)
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 mb-6">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img src="{{ $project->getFirstMediaUrl('projects', 'thumb') ?: 'default-image-path.jpg' }}" alt="{{ $project->title }}" class="w-full h-48 object-cover">
                        <div class="p-5">
                            <h5 class="text-xl font-semibold mb-2">{{ $project->title }}</h5>
                            <p class="text-gray-700 text-base mb-4">{{ Str::limit($project->description, 100) }}</p>
                            @php
                                $status = $project->userJoinRequestStatus();
                            @endphp
                            <a href="{{ route('user.projects.show', $project->id) }}" class="w-full inline-flex justify-center items-center bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded mb-3 hover:bg-gray-300">Show Details</a>
                            @if(is_null($status))
                                <form action="{{ route('user.projects.requestJoin', $project->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full inline-flex justify-center items-center bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Request to Join</button>
                                </form>
                            @elseif($status === 0)
                                <button class="w-full inline-flex justify-center items-center bg-gray-400 text-white font-bold py-2 px-4 rounded" disabled>Pending Approval</button>
                            @elseif($status === 1)
                                <button class="w-full inline-flex justify-center items-center bg-green-500 text-white font-bold py-2 px-4 rounded" disabled>Accepted</button>
                            @elseif($status === 2)
                                <form action="{{ route('user.projects.requestJoin', $project->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full inline-flex justify-center items-center bg-yellow-500 text-white font-bold py-2 px-4 rounded hover:bg-yellow-600">Request Again</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

