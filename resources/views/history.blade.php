<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task History</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Mobile Navbar -->
        <div class="md:hidden bg-[#ff6b6b] text-white p-4 flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/images/user-logo.png') }}" 
                     alt="Profile" 
                     class="w-10 h-10 rounded-full border-2 border-white object-cover mr-3">
                <div>
                    <h3 class="font-semibold">{{ Auth::user()->username }}</h3>
                    <p class="text-xs opacity-80">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <button id="mobileMenuBtn" class="text-white">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Mobile Menu (hidden by default) -->
        <div id="mobileMenu" class="hidden md:hidden bg-[#ff6b6b] text-white w-full">
            <nav class="py-2 space-y-1 px-4">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-2 text-white rounded-lg transition duration-300 ease-in-out hover:bg-white hover:text-[#ff5252] 
                   {{ request()->routeIs('dashboard') ? 'bg-white text-[#ff5252]' : '' }}">
                    <i class="fas fa-th-large mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('todolist.history') }}" 
                   class="flex items-center px-4 py-2 text-[#ff5252] rounded-lg transition duration-300 ease-in-out hover:bg-white hover:text-[#ff5252] 
                   {{ request()->routeIs('todolist.history') ? 'bg-white text-[#ff5252]' : '' }}">
                    <i class="fas fa-history mr-3"></i>
                    Task History
                </a>
                <a href="{{ route('settings') }}" 
                   class="flex items-center px-4 py-2 text-white rounded-lg transition duration-300 ease-in-out hover:bg-white hover:text-[#ff5252] 
                   {{ request()->routeIs('settings') ? 'bg-white text-[#ff5252]' : '' }}">
                    <i class="fas fa-cog mr-3"></i>
                    Settings
                </a>
                <form action="{{ route('logout') }}" method="POST" class="mt-2 pt-2 border-t border-white/30">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-white hover:bg-white/10 rounded-lg">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Logout
                    </button>
                </form>
            </nav>
        </div>

        <!-- Sidebar (desktop) -->
        <div class="hidden md:flex md:w-64 lg:w-72 bg-[#ff6b6b] text-white flex-col">
            <div class="p-6 text-center">
                <div class="mb-4">
                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/images/user-logo.png') }}" 
                         alt="Profile" 
                         class="w-24 h-24 rounded-full mx-auto border-4 border-white object-cover">
                </div>
                <h3 class="text-xl font-semibold">{{ Auth::user()->username }}</h3>
                <p class="text-sm opacity-80">{{ Auth::user()->email }}</p>
            </div>
            
            <nav class="mt-6 space-y-2 px-4">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-6 py-3 text-white rounded-2xl transition duration-300 ease-in-out hover:bg-white hover:text-[#ff5252] hover:shadow-md 
                   {{ request()->routeIs('dashboard') ? 'bg-white text-[#ff5252] shadow-md' : '' }}">
                    <i class="fas fa-th-large mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('todolist.history') }}" 
                   class="flex items-center px-6 py-3 text-[#ff5252] rounded-2xl transition duration-300 ease-in-out hover:bg-white hover:text-[#ff5252] hover:shadow-md 
                   {{ request()->routeIs('todolist.history') ? 'bg-white text-[#ff5252] shadow-md' : '' }}">
                    <i class="fas fa-history mr-3"></i>
                    Task History
                </a>
                <a href="{{ route('settings') }}" 
                   class="flex items-center px-6 py-3 text-white rounded-2xl transition duration-300 ease-in-out hover:bg-white hover:text-[#ff5252] hover:shadow-md 
                   {{ request()->routeIs('settings') ? 'bg-white text-[#ff5252] shadow-md' : '' }}">
                    <i class="fas fa-cog mr-3"></i>
                    Settings
                </a>
            </nav>                                 

            <div class="mt-auto p-6">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center text-white hover:text-gray-200">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 md:mb-8 gap-4">
                <h1 class="text-xl md:text-2xl font-bold text-[#ff6b6b]">
                    <i class="fas fa-history mr-2"></i>Completed Tasks History
                </h1>
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800 hidden md:flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Go Back
                </a>
            </div>

            <!-- Task History Content -->
            <div class="bg-white rounded-lg shadow-md p-4 md:p-6">
                <p class="text-gray-600 mb-6">Here's a complete history of all your completed tasks.</p>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full rounded-lg overflow-hidden">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task Title</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created Date & Time</th>
                            </tr>
                        </thead>
                        <!-- Replace this section in your history.blade.php -->
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($completedTasks as $index => $task)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $task->title }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>Completed
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($task->created_at)->translatedFormat('l, d F Y H:i:s') }} WIB
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-clipboard-list text-3xl mb-3 text-gray-300"></i>
                                            <p>No completed tasks found in your history.</p>
                                            <a href="{{ route('dashboard') }}" class="mt-3 text-[#ff6b6b] hover:text-[#ff5252]">
                                                <i class="fas fa-plus-circle mr-1"></i>Return to dashboard
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Mobile "Back" Button -->
                <div class="mt-6 md:hidden">
                    <a href="{{ route('dashboard') }}" class="w-full block text-center px-4 py-2 bg-[#ff6b6b] text-white rounded-lg hover:bg-[#ff5252] transition duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Mobile Menu
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });

        // Media query listener for menu behavior
        const mediaQuery = window.matchMedia('(min-width: 768px)');
        
        function handleScreenChange(e) {
            const mobileMenu = document.getElementById('mobileMenu');
            if (e.matches) {
                // Screen is 768px or wider
                mobileMenu.classList.add('hidden');
            }
        }
        
        mediaQuery.addEventListener('change', handleScreenChange);

        // Initial call
        handleScreenChange(mediaQuery);

        document.addEventListener('click', function(event) {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            
            // Close menu when clicking outside menu and button
            if (!mobileMenuBtn.contains(event.target) && !mobileMenu.contains(event.target) && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>