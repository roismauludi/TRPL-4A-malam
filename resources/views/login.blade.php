<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
    <div class="bg-white p-10 rounded-lg shadow-md w-80">
        <h2 class="text-3xl font-bold mb-6 text-center">Login</h2>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-600">Email</label>
                <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-indigo-500" placeholder="Enter your email" required>
                @if($errors->has('email'))
                <p class="text-red-500 text-xs mt-1">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-600">Password</label>
                <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-indigo-500" placeholder="Enter your password" required>
                @if($errors->has('password'))
                <p class="text-red-500 text-xs mt-1">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <button type="submit" class="w-full bg-indigo-500 text-white py-2 rounded-lg hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600 transition duration-300">Login</button>
        </form>
    </div>
</body>

</html>