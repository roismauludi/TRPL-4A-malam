<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(to right, #4f46e5, #f87171);
        }
    </style>
</head>

<body class="h-screen flex justify-center items-center gradient-bg">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="id_staff" class="block text-gray-600 text-sm">Staff ID</label>
                <input type="text" id="id_staff" name="id_staff" class="w-full border border-gray-300 rounded-lg px-2 py-1 focus:outline-none focus:border-indigo-500" placeholder="Enter your staff ID" value="{{ old('id_staff') }}" required>
                @error('id_staff')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama" class="block text-gray-600 text-sm">Name</label>
                <input type="text" id="nama" name="nama" class="w-full border border-gray-300 rounded-lg px-2 py-1 focus:outline-none focus:border-indigo-500" placeholder="Enter your name" value="{{ old('nama') }}" required>
                @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="block text-gray-600 text-sm">Email</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg px-2 py-1 focus:outline-none focus:border-indigo-500" placeholder="Enter your email" value="{{ old('email') }}" required>
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="block text-gray-600 text-sm">Password</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg px-2 py-1 focus:outline-none focus:border-indigo-500" placeholder="Enter your password" required>
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="block text-gray-600 text-sm">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-2 py-1 focus:outline-none focus:border-indigo-500" placeholder="Confirm your password" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="block text-gray-600 text-sm">Upload Foto</label>
                <input type="file" class="w-full border border-gray-300 rounded-lg px-2 py-1 focus:outline-none focus:border-indigo-500" id="foto" name="foto" accept="image/png, image/jpg, image/jpeg">
                @error('foto')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full bg-indigo-500 text-white py-2 rounded-lg hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600 transition duration-300">Register</button>
        </form>
    </div>
</body>

</html>