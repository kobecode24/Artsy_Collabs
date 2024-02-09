<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partners List</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Partners</h1>
    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary mb-3">Add New Partner</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($partners as $partner)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                    @if($partner->getFirstMediaUrl('partners'))
                        <img src="{{ $partner->getFirstMediaUrl('partners') }}" alt="Project Image" style="width: 100px; height: auto;">
                    @else
                        No Image Available
                    @endif
                </td>
                <td>{{ $partner->title }}</td>
                <td>{{ $partner->description }}</td>
                <td>
                    <a href="{{--{{ route('partners.show', $partner->id) }}--}}" class="btn btn-info btn-sm">View</a>
                    <a href="{{--{{ route('partners.edit', $partner->id) }}--}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{--{{ route('partners.destroy', $partner->id) }}--}}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No partners found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
