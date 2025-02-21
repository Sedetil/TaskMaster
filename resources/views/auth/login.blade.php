<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/planner.png') }}" type="image/x-icon">
</head>
<body class="bg-[#f05454] min-h-screen" style="background-image: url('assets/images/background-image.png'); background-size: cover; background-position: center;">
    <div class="flex justify-center items-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-4xl flex flex-wrap">
            <!-- Form Section -->
            <div class="w-full lg:w-1/2 px-4">
                <h2 class="text-2xl font-bold text-center mb-6">Sign In</h2>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4 relative">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="username" class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#ff6f61] text-sm" placeholder="Enter Username" required>
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4 relative">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password" class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#ff6f61] text-sm" placeholder="Enter Password" required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox text-[#ff6f61]" name="remember">
                            <span class="ml-2 text-gray-700 text-sm">Remember Me</span>
                        </label>
                    </div>
                    
                    <button type="submit" class="w-full bg-[#ff6f61] hover:bg-[#ff4c3b] text-white py-2 px-4 rounded-md transition duration-300 text-sm">
                        Login
                    </button>
                    
                    <div class="mt-4 text-center text-sm text-gray-600">
                        <p>Or, Login with</p>
                        <div class="flex justify-center gap-4 mt-2">
                            <a href="{{ route('auth.redirect', 'google') }}" class="flex items-center justify-center w-8 h-8">
                                <img src="assets/images/google.png" alt="Google" class="w-full h-full object-contain">
                            </a>
                            <a href="{{ route('auth.redirect', 'facebook') }}" class="flex items-center justify-center w-8 h-8">
                                <img src="assets/images/facebook.png" alt="Facebook" class="w-full h-full object-contain">
                            </a>
                            <a href="{{ route('auth.redirect', 'github') }}" class="flex items-center justify-center w-8 h-8">
                                <img src="assets/images/github.png" alt="Twitter" class="w-full h-full object-contain">
                            </a>
                        </div>
                    </div>                    
                    
                    <p class="text-center mt-4 text-sm">
                        Don't have an account? 
                        <a href="/register" class="text-[#ff6f61] hover:underline">Create One</a>
                    </p>

                    <!-- Flash Message for Errors -->
                    @if (session('error'))
                        <p class="text-center text-red-500 text-sm mt-3">{{ session('error') }}</p>
                    @endif
                </form>
            </div>

            <!-- Image Section - Hidden on mobile -->
            <div class="w-full lg:w-1/2 hidden lg:flex justify-center items-center">
                <img src="assets/images/ach31.png" alt="Illustration" class="max-w-[80%] h-auto">
            </div>
        </div>
    </div>
</body>
</html>