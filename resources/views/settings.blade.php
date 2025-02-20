<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account Information</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                   class="flex items-center px-4 py-2 text-white rounded-lg transition duration-300 ease-in-out hover:bg-white hover:text-[#ff5252] 
                   {{ request()->routeIs('todolist.history') ? 'bg-white text-[#ff5252]' : '' }}">
                    <i class="fas fa-history mr-3"></i>
                    Task History
                </a>
                <a href="{{ route('settings') }}" 
                   class="flex items-center px-4 py-2 text-[#ff5252] rounded-lg transition duration-300 ease-in-out hover:bg-white hover:text-[#ff5252] 
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
                   class="flex items-center px-6 py-3 text-white rounded-2xl transition duration-300 ease-in-out hover:bg-white hover:text-[#ff5252] hover:shadow-md 
                   {{ request()->routeIs('todolist.history') ? 'bg-white text-[#ff5252] shadow-md' : '' }}">
                    <i class="fas fa-history mr-3"></i>
                    Task History
                </a>
                <a href="{{ route('settings') }}" 
                   class="flex items-center px-6 py-3 text-[#ff5252] rounded-2xl transition duration-300 ease-in-out hover:bg-white hover:text-[#ff5252] hover:shadow-md 
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
                <h1 class="text-xl md:text-2xl font-bold text-[#ff6b6b]">Account Information</h1>
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800 hidden md:flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Go Back
                </a>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Account Settings Form -->
            <div class="bg-white rounded-lg shadow-md p-4 md:p-6 max-w-2xl mx-auto">
                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Profile Picture Section -->
                    <div class="mb-6">
                        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                            <div class="relative">
                                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/images/user-logo.png') }}" 
                                     alt="Profile Picture" 
                                     id="preview-image"
                                     class="w-24 h-24 rounded-full object-cover border-4 border-[#ff6b6b]">
                                <label for="avatar-upload" class="absolute bottom-0 right-0 w-8 h-8 bg-[#ff6b6b] text-white rounded-full flex items-center justify-center border border-white cursor-pointer hover:bg-[#ff5252]">
                                    <i class="fas fa-camera text-sm"></i>
                                </label>
                                <input id="avatar-upload" 
                                       type="file" 
                                       name="avatar" 
                                       class="hidden"
                                       accept="image/*"
                                       onchange="previewImage(this)">
                            </div>
                            <div class="text-center sm:text-left">
                                <p class="text-sm text-gray-700 font-medium">Change Profile Picture</p>
                                <p class="text-xs text-gray-500 mt-1">Supported formats: JPEG, PNG, JPG, GIF (max. 5MB)</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Login Badge (if applicable) -->
                    @if(Auth::user()->provider)
                    <div class="mb-6">
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center">
                            <div class="mr-3">
                                @if(Auth::user()->provider == 'google')
                                    <i class="fab fa-google text-2xl text-[#DB4437]"></i>
                                @elseif(Auth::user()->provider == 'facebook')
                                    <i class="fab fa-facebook text-2xl text-[#4267B2]"></i>
                                @elseif(Auth::user()->provider == 'github')
                                    <i class="fab fa-github text-2xl text-[#333]"></i>
                                @endif
                            </div>
                            <div>
                                <p class="font-medium">Signed in with {{ ucfirst(Auth::user()->provider) }}</p>
                                <p class="text-xs text-gray-500">Your account is linked to {{ ucfirst(Auth::user()->provider) }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Username field -->
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                        <input type="text" 
                               id="username"
                               name="username" 
                               value="{{ Auth::user()->username }}" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ff6b6b]"
                               required>
                    </div>

                    <!-- User Information Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input type="text" 
                                   id="first_name"
                                   name="first_name" 
                                   value="{{ Auth::user()->first_name }}" 
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ff6b6b]"
                                   required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input type="text" 
                                   id="last_name"
                                   name="last_name" 
                                   value="{{ Auth::user()->last_name }}" 
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ff6b6b]"
                                   required>
                        </div>
                    </div>

                    <!-- Email Address (Read-only) -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email"
                               id="email" 
                               value="{{ Auth::user()->email }}" 
                               class="w-full px-4 py-2 border rounded-lg bg-gray-50" 
                               readonly>
                        <p class="text-xs text-gray-500 mt-1">Email address cannot be changed</p>
                    </div>

                    <!-- Password Change Section (only for non-social login users) -->
                    @if(!Auth::user()->provider)
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <input type="password"
                               id="password" 
                               name="password" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ff6b6b]" 
                               placeholder="Leave blank to keep current password">
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                        <input type="password"
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ff6b6b]" 
                               placeholder="Leave blank to keep current password">
                    </div>
                    @else
                    <div class="mb-6">
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-600">Password management is handled by your {{ ucfirst(Auth::user()->provider) }} account.</p>
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row sm:justify-end gap-3">
                        <button type="button" 
                                onclick="confirmCancel()"
                                class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition duration-300 w-full sm:w-auto order-2 sm:order-1">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-[#ff6b6b] text-white rounded-lg hover:bg-[#ff5252] transition duration-300 w-full sm:w-auto order-1 sm:order-2">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle Mobile Menu
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        function confirmCancel() {
            Swal.fire({
                title: "Discard Changes?",
                text: "Any unsaved changes will be lost.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff6b6b",
                cancelButtonColor: "#718096",
                confirmButtonText: "Yes, discard changes",
                cancelButtonText: "No, continue editing"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('dashboard') }}";
                }
            });
        }

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