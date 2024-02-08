<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name')
        <div>{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
        <div>{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        @error('password')
        <div>{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <div>
        <label for="image">Profile Image:</label>
        <input type="file" name="image">
        @error('image')
        <div>{{ $message }}</div>
        @enderror
    </div>
    <button type="submit">Register</button>
</form>
</body>
</html>
