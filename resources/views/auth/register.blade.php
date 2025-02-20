<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#f05454] min-h-screen" style="background-image: url('assets/images/background-image2.png'); background-size: cover;">
    <div class="flex justify-center items-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-4xl flex flex-wrap">
            <!-- Image Section - Hidden on mobile -->
            <div class="w-full lg:w-1/2 hidden lg:flex justify-center items-center">
                <img src="assets/images/R2.png" alt="Illustration" class="max-w-[80%] h-auto">
            </div>

            <!-- Form Section -->
            <div class="w-full lg:w-1/2 px-4">
                <h2 class="text-2xl font-bold text-center mb-6">Sign Up</h2>
                
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                
                    <div class="mb-3 relative">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#ff6f61] text-sm @error('first_name') border-red-500 @enderror" placeholder="Enter First Name" required>
                        @error('first_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="mb-3 relative">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#ff6f61] text-sm @error('last_name') border-red-500 @enderror" placeholder="Enter Last Name" required>
                        @error('last_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="mb-3 relative">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-user-circle"></i>
                        </span>
                        <input type="text" name="username" value="{{ old('username') }}" class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#ff6f61] text-sm @error('username') border-red-500 @enderror" placeholder="Enter Username" required>
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="mb-3 relative">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#ff6f61] text-sm @error('email') border-red-500 @enderror" placeholder="Enter Email" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="mb-3 relative">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password" class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#ff6f61] text-sm @error('password') border-red-500 @enderror" placeholder="Enter Password" required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="mb-3 relative">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password_confirmation" class="w-full pl-10 pr-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#ff6f61] text-sm" placeholder="Confirm Password" required>
                    </div>
                
                    <div class="mb-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="terms" class="form-checkbox text-[#ff6f61] @error('terms') border-red-500 @enderror">
                            <span class="ml-2 text-gray-700 text-sm">I agree to all terms</span>
                        </label>
                        @error('terms')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                
                    <button type="submit" class="w-full bg-[#ff6f61] hover:bg-[#ff4c3b] text-white py-2 px-4 rounded-md transition duration-300 text-sm">
                        Register
                    </button>
                
                    @if (session('success'))
                        <p class="text-center text-green-500 text-sm mt-3">{{ session('success') }}</p>
                    @endif
                
                    <p class="text-center mt-3 text-sm">
                        Already have an account? 
                        <a href="/login" class="text-[#ff6f61] hover:underline">Sign In</a>
                    </p>
                </form>                
            </div>
        </div>
    </div>
</body>
</html>