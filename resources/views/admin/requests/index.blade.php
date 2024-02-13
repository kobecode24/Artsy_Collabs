<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Join Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-50">
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">Join Requests</h1>
    </div>
    <div class="space-y-8">
        @foreach ($joinRequests as $request)
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Request from {{ $request->user->name }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Project: {{ $request->project->title }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <img class="w-10 h-10 rounded-full" src="{{ $request->user->getFirstMediaUrl('images') ?: 'default-user-image.jpg' }}" alt="User Image">
                        <span class="ml-3 py-1 px-3 rounded-full text-xs font-medium {{ $request->status == 0 ? 'bg-yellow-100 text-yellow-800' : ($request->status == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                            {{ $request->status == 0 ? 'Pending' : ($request->status == 1 ? 'Accepted' : 'Declined') }}
                        </span>
                    </div>
                </div>
                <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
                    <img class="w-48 h-auto rounded-md" src="{{ $request->project->getFirstMediaUrl('projects') ?: 'default-project-image.jpg' }}" alt="Project Image">
                    <div class="mt-4 sm:flex sm:justify-between">
                        <div>
                            <form action="{{ route('admin.requests.update', $request->id) }}" method="POST" class="sm:flex sm:space-x-2">
                                @csrf
                                @method('PUT')
                                <button name="status" value="accept" type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" {{ $request->status == 1 ? 'disabled' : '' }}>Accept</button>
                                <button name="status" value="decline" type="submit" class="mt-2 sm:mt-0 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Decline</button>
                            </form>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <a href="{{ route('admin.projects.show', $request->project->id) }}" class="text-indigo-600 hover:text-indigo-900">Visit Project</a>
                            {{-- <a href="{{ route('admin.users.show', $request->user->id) }}" class="ml-4 text-indigo-600 hover:text-indigo-900">Visit Artist</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
