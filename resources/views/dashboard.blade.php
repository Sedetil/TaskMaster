<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/planner.png') }}" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
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
                   class="flex items-center px-4 py-2 text-[#ff5252] rounded-lg transition duration-300 ease-in-out hover:bg-white hover:text-[#ff5252] 
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
                   class="flex items-center px-6 py-3 text-[#ff5252] rounded-2xl transition duration-300 ease-in-out hover:bg-white hover:text-[#ff5252] hover:shadow-md 
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
                <h1 class="text-xl md:text-2xl font-bold text-[#ff6b6b]">Dashboard</h1>
                
                <div class="flex items-center w-full md:w-auto gap-3">
                    <!-- Existing Search Bar -->
                    <div class="relative w-full md:w-auto">
                        <form action="{{ route('dashboard') }}" method="GET" id="searchForm" class="w-full md:w-auto">
                            <input type="text" name="search" placeholder="Search your task..." 
                                value="{{ $search ?? '' }}"
                                class="w-full md:w-64 px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-[#ff6b6b]"
                                id="searchInput">
                            <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-[#ff6b6b]">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                        <div id="searchResults" class="absolute z-10 bg-white rounded-lg shadow-lg w-full md:w-64 mt-1 hidden">
                            @if(isset($search) && $search)
                                <!-- Improved alignment for the times icon -->
                                <div class="flex justify-between items-center p-2 border-b">
                                    <span class="text-sm text-gray-500">
                                        Results for: <span class="font-bold text-[#ff6b6b]">{{ $search }}</span>
                                    </span>
                                    <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-[#ff6b6b] p-1">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Calendar Icon -->
                    <button id="calendarToggle" class="bg-[#ff6b6b] text-white p-2 w-10 h-10 flex items-center justify-center rounded-lg hover:bg-[#ff5252] transition-colors">
                        <i class="fas fa-calendar-alt"></i>
                    </button>
                </div>
            </div>
            
            <!-- Calendar Modal -->
            <div id="calendarModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-center hidden p-4">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden">
                    <div class="p-4 border-b flex justify-between items-center">
                        <h3 class="text-lg font-bold">Calendar</h3>
                        <div>
                            <button id="closeCalendar" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <!-- Date Display and Input -->
                        <div class="relative mb-4">
                            <input type="text" id="selectedDate" readonly 
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ff6b6b]" 
                                placeholder="Select a date">
                            <button id="clearDate" class="absolute right-3 top-2.5 text-gray-400 hover:text-[#ff6b6b] hidden">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        
                        <!-- Calendar Navigation -->
                        <div class="flex justify-between items-center mb-4">
                            <button id="prevMonth" class="p-2 rounded-lg hover:bg-gray-100">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <h4 id="currentMonthYear" class="text-lg font-medium">June 2023</h4>
                            <button id="nextMonth" class="p-2 rounded-lg hover:bg-gray-100">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                        
                        <!-- Calendar Grid -->
                        <div class="grid grid-cols-7 gap-1 text-center">
                            <!-- Weekday Headers -->
                            <div class="text-gray-500 font-medium text-sm py-2">MON</div>
                            <div class="text-gray-500 font-medium text-sm py-2">TUE</div>
                            <div class="text-gray-500 font-medium text-sm py-2">WED</div>
                            <div class="text-gray-500 font-medium text-sm py-2">THU</div>
                            <div class="text-gray-500 font-medium text-sm py-2">FRI</div>
                            <div class="text-gray-500 font-medium text-sm py-2">SAT</div>
                            <div class="text-gray-500 font-medium text-sm py-2">SUN</div>
                            
                            <!-- Calendar Days (will be populated by JavaScript) -->
                            <div id="calendarDays" class="col-span-7 grid grid-cols-7 gap-1"></div>
                        </div>
                    </div>
                    
                    <div class="p-4 border-t flex justify-end">
                        <button id="applyDate" class="px-4 py-2 bg-[#ff6b6b] text-white rounded-lg hover:bg-[#ff5252]">
                            Apply
                        </button>
                    </div>
                </div>
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

            <!-- Welcome Section -->
            <h2 class="text-xl md:text-2xl mb-4 md:mb-6">Welcome back, {{ Auth::user()->username }} 👋</h2>

            <!-- Task Sections -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
                <!-- To-Do Section -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-lg p-4 md:p-6 shadow">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold">
                                <i class="fas fa-clipboard-list text-[#ff6b6b] mr-2"></i>
                                To-Do List
                            </h3>
                            <button onclick="document.getElementById('addTaskModal').classList.remove('hidden')" class="text-[#ff6b6b] text-sm md:text-base">
                                <i class="fas fa-plus"></i> <span class="hidden sm:inline">Add Task</span>
                            </button>
                        </div>
        
                        <div class="space-y-4">
                            @foreach ($tasks as $task)
                            <div class="border rounded-lg p-3 md:p-4">
                                <div class="flex flex-col sm:flex-row justify-between items-start">
                                    <div class="flex-1 w-full sm:w-auto mb-3 sm:mb-0">
                                        <h4 class="font-semibold">{{ $task->title }}</h4>
                                        <p class="text-sm text-gray-600 mt-1">
                                            {{ $task->description }}
                                        </p>
                                        <div class="flex flex-wrap items-center mt-2 gap-2">
                                            <span class="text-xs md:text-sm text-gray-500">
                                                Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                            </span>
                                            <span class="text-xs md:text-sm text-gray-500">
                                                Priority: 
                                                <span class="
                                                    @if($task->priority == 'Extreme') text-red-500 font-semibold 
                                                    @elseif($task->priority == 'Moderate') text-blue-500 font-semibold
                                                    @elseif($task->priority == 'Low') text-green-500 font-semibold
                                                    @endif">
                                                    {{ $task->priority }}
                                                </span>
                                            </span>
                                            <form action="{{ route('todolist.update', $task->id) }}" method="POST" class="inline mt-2 sm:mt-0">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" class="text-xs md:text-sm border rounded p-1">
                                                    <option value="Not Started" {{ $task->status == 'Not Started' ? 'selected' : '' }}>Not Started</option>
                                                    <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="flex items-center w-full sm:w-auto justify-between sm:justify-end">
                                        <div class="flex items-center">
                                            <!-- Tombol Edit -->
                                            <button 
                                            onclick="document.getElementById('editTaskModal-{{ $task->id }}').classList.remove('hidden')" 
                                            class="bg-[#ff6b6b] text-white w-8 h-8 flex items-center justify-center rounded-md hover:bg-[#ff5252] transition-colors mr-2">
                                            <i class="fas fa-pencil-alt text-sm"></i>
                                            </button>

                                            <!-- Form Hapus -->
                                            <form id="deleteTaskForm-{{ $task->id }}" action="{{ route('todolist.destroy', $task->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="button" 
                                                onclick="confirmDelete({{ $task->id }})" 
                                                class="bg-[#ff6b6b] text-white w-8 h-8 flex items-center justify-center rounded-md hover:bg-[#ff5252] transition-colors">
                                                <i class="fas fa-trash-alt text-sm"></i>
                                            </button>
                                            </form>
                                        </div>
                                        @if ($task->image)
                                            <img src="{{ asset('storage/' . $task->image) }}" alt="Task" class="w-16 h-16 md:w-20 md:h-20 rounded-lg object-cover ml-4">
                                        @endif
                                    </div>
                                </div>
                            </div>
        
                            <!-- Edit Task Modal for each task -->
                            <div id="editTaskModal-{{ $task->id }}" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-center p-4">
                                <div class="bg-white p-4 md:p-6 rounded-lg w-full max-w-sm md:max-w-md">
                                    <h3 class="text-lg font-bold mb-4">Edit Task</h3>
                                    <form action="{{ route('todolist.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <input type="text" name="title" value="{{ $task->title }}" required class="w-full border rounded p-2 mb-3">
                                        <textarea name="description" class="w-full border rounded p-2 mb-3">{{ $task->description }}</textarea>
                                        <input type="date" name="due_date" id="editTaskDate-{{ $task->id }}" value="{{ $task->due_date }}" required class="w-full border rounded p-2 mb-3">
                                        <select name="priority" required class="w-full border rounded p-2 mb-3">
                                            <option value="Low" {{ $task->priority == 'Low' ? 'selected' : '' }} class="text-green-500 font-medium">Low</option>
                                            <option value="Moderate" {{ $task->priority == 'Moderate' ? 'selected' : '' }} class="text-blue-500 font-medium">Moderate</option>
                                            <option value="Extreme" {{ $task->priority == 'Extreme' ? 'selected' : '' }} class="text-red-500 font-medium">Extreme</option>
                                        </select>
                                        <div class="mb-3">
                                            <label class="block text-sm mb-1">Current Image:</label>
                                            @if ($task->image)
                                                <img src="{{ asset('storage/' . $task->image) }}" alt="Current Image" class="w-20 h-20 object-cover rounded mb-2">
                                            @else
                                                <p class="text-sm text-gray-500">No image uploaded</p>
                                            @endif
                                            <input type="file" name="image" class="w-full border rounded p-2">
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <button type="button" onclick="document.getElementById('editTaskModal-{{ $task->id }}').classList.add('hidden')" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                                            <button type="submit" class="px-4 py-2 bg-[#ff6b6b] text-white rounded">Update Task</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        
                <!-- Task Status Section with Chart -->
                <div>
                    <div class="bg-white rounded-lg p-4 md:p-6 shadow">
                        <h3 class="font-semibold mb-4">
                            <i class="fas fa-chart-pie text-[#ff6b6b] mr-2"></i>
                            Task Status
                        </h3>
                        <div class="mb-4 h-48 md:h-64">
                            <canvas id="taskStatusChart"></canvas>
                        </div>
                        <ul class="space-y-2 text-sm md:text-base">
                            <li>Completed: <span class="font-bold">{{ $stats['completed'] }}%</span></li>
                            <li>In Progress: <span class="font-bold">{{ $stats['inProgress'] }}%</span></li>
                            <li>Not Started: <span class="font-bold">{{ $stats['notStarted'] }}%</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Task Modal -->
    <div id="addTaskModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-center hidden p-4">
        <div class="bg-white p-4 md:p-6 rounded-lg w-full max-w-sm md:max-w-md">
            <h3 class="text-lg font-bold mb-4">Add New Task</h3>
            <form action="{{ route('todolist.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" placeholder="Task Title" required class="w-full border rounded p-2 mb-3">
                <textarea name="description" placeholder="Task Description" class="w-full border rounded p-2 mb-3"></textarea>
                <input type="date" name="due_date" id="addTaskDate" required class="w-full border rounded p-2 mb-3">
                <select name="priority" required class="w-full border rounded p-2 mb-3">
                    <option value="">Select Priority</option>
                    <option value="Low" class="text-green-500 font-medium">Low</option>
                    <option value="Moderate" class="text-blue-500 font-medium">Moderate</option>
                    <option value="Extreme" class="text-red-500 font-medium">Extreme</option>
                </select>
                <input type="file" name="image" class="w-full border rounded p-2 mb-3">
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-[#ff6b6b] text-white rounded">Add Task</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Chart.js and other Scripts -->
    <script>
        // Toggle Mobile Menu
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });

        const ctx = document.getElementById('taskStatusChart').getContext('2d');
        const taskChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'In Progress', 'Not Started'],
                datasets: [{
                    data: [
                        {{ $stats['completed'] }},
                        {{ $stats['inProgress'] }},
                        {{ $stats['notStarted'] }}
                    ],
                    backgroundColor: [
                        '#10B981', // Green for Completed
                        '#3B82F6', // Blue for In Progress
                        '#EF4444'  // Red for Not Started
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: {
                                size: window.innerWidth < 768 ? 10 : 12
                            }
                        }
                    }
                },
                animation: {
                    duration: 750,
                    easing: 'easeInOutQuart'
                },
                cutout: '75%'
            }
        });
    
        // Add event listener to status dropdowns
        document.querySelectorAll('select[name="status"]').forEach(select => {
            select.addEventListener('change', function() {
                // Submit the form
                this.form.submit();
                
                // Update the chart colors based on new status
                const formData = new FormData(this.form);
                const newStatus = formData.get('status');
                
                // Get the task's current index
                const taskIndex = parseInt(this.dataset.taskIndex);
                
                // Update the chart data
                let completed = {{ $stats['completed'] }};
                let inProgress = {{ $stats['inProgress'] }};
                let notStarted = {{ $stats['notStarted'] }};
                
                switch(newStatus) {
                    case 'Completed':
                        completed++;
                        if (this.dataset.previousStatus === 'In Progress') inProgress--;
                        else if (this.dataset.previousStatus === 'Not Started') notStarted--;
                        break;
                    case 'In Progress':
                        inProgress++;
                        if (this.dataset.previousStatus === 'Completed') completed--;
                        else if (this.dataset.previousStatus === 'Not Started') notStarted--;
                        break;
                    case 'Not Started':
                        notStarted++;
                        if (this.dataset.previousStatus === 'Completed') completed--;
                        else if (this.dataset.previousStatus === 'In Progress') inProgress--;
                        break;
                }
                
                // Update the chart
                taskChart.data.datasets[0].data = [completed, inProgress, notStarted];
                taskChart.update();
                
                // Store the new status as previous status for next change
                this.dataset.previousStatus = newStatus;
            });
        });

        function confirmDelete(taskId) {
            Swal.fire({
                title: "Are you sure?",
                text: "This task will be permanently deleted!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff6b6b",
                cancelButtonColor: "#718096",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("deleteTaskForm-" + taskId).submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');
            
            // Show search results as user types
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                if (query.length < 2) {
                    searchResults.classList.add('hidden');
                    return;
                }
                
                // Filter tasks client-side for immediate feedback
                const tasks = @json($tasks);
                const filteredTasks = tasks.filter(task => 
                    task.title.toLowerCase().includes(query.toLowerCase()) || 
                    (task.description && task.description.toLowerCase().includes(query.toLowerCase())) ||
                    task.priority.toLowerCase().includes(query.toLowerCase())
                );
                
                // Display results
                if (filteredTasks.length > 0) {
                    searchResults.innerHTML = '';
                    filteredTasks.slice(0, 5).forEach(task => {
                        const div = document.createElement('div');
                        div.className = 'p-2 hover:bg-gray-100 cursor-pointer border-b last:border-b-0';
                        div.innerHTML = `
                            <div class="font-medium">${task.title}</div>
                            <div class="text-xs text-gray-500">Priority: ${task.priority}</div>
                        `;
                        div.addEventListener('click', function() {
                            // Set search input to this task's title
                            searchInput.value = task.title;
                            searchResults.classList.add('hidden');
                            document.getElementById('searchForm').submit();
                        });
                        searchResults.appendChild(div);
                    });
                    searchResults.classList.remove('hidden');
                } else {
                    searchResults.innerHTML = '<div class="p-2 text-gray-500">No tasks found</div>';
                    searchResults.classList.remove('hidden');
                }
            });
            
            // Hide search results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });
            
            // Show results dropdown when focusing on search
            searchInput.addEventListener('focus', function() {
                if (this.value.trim().length >= 2) {
                    searchResults.classList.remove('hidden');
                }
            });

            // Responsive chart resize
            window.addEventListener('resize', function() {
                if (taskChart) {
                    taskChart.options.plugins.legend.labels.font.size = window.innerWidth < 768 ? 10 : 12;
                    taskChart.update();
                }
            });
        });

        function highlightSearchTerm(text, term) {
            if (!term || term === '') return text;
            const regex = new RegExp(`(${term})`, 'gi');
            return text.replace(regex, '<span class="bg-yellow-200">$1</span>');
        }

        document.addEventListener("DOMContentLoaded", function () {
            let today = new Date().toISOString().split("T")[0];

            // Set min date untuk Add Task
            let addTaskDateInput = document.getElementById("addTaskDate");
            if (addTaskDateInput) {
                addTaskDateInput.setAttribute("min", today);
            }

            // Set min date untuk Edit Task
            document.querySelectorAll("[id^='editTaskDate-']").forEach(input => {
                input.setAttribute("min", today);
            });
        });

        // Close Add Task Modal
        function closeAddModal() {
            document.getElementById("addTaskModal").classList.add("hidden");
        }

        document.addEventListener('DOMContentLoaded', function() {
    // Calendar functionality
    const calendarToggle = document.getElementById('calendarToggle');
    const calendarModal = document.getElementById('calendarModal');
    const closeCalendar = document.getElementById('closeCalendar');
    const calendarDays = document.getElementById('calendarDays');
    const currentMonthYear = document.getElementById('currentMonthYear');
    const prevMonth = document.getElementById('prevMonth');
    const nextMonth = document.getElementById('nextMonth');
    const selectedDate = document.getElementById('selectedDate');
    const clearDate = document.getElementById('clearDate');
    const applyDate = document.getElementById('applyDate');
    
    let currentDate = new Date();
    let selectedDateValue = null;
    
    // Get URL parameters to check if a date is already selected
    const urlParams = new URLSearchParams(window.location.search);
    const urlDate = urlParams.get('date');
    
    // Set selected date from URL if available
    if (urlDate) {
        selectedDateValue = new Date(urlDate);
        currentDate = new Date(urlDate);
        selectedDate.value = formatDate(selectedDateValue);
        clearDate.classList.remove('hidden');
    }
    
    // Get all task dates for marking the calendar
    const taskDates = @json($tasks->pluck('due_date'));
    const taskDatesMap = {}; // Will store dates with tasks as keys
    
    // Convert dates to a map for easy lookup
    taskDates.forEach(dateStr => {
        const date = new Date(dateStr);
        const dateKey = `${date.getFullYear()}-${date.getMonth()}-${date.getDate()}`;
        taskDatesMap[dateKey] = true;
    });
    
    // Initialize calendar
    function initCalendar() {
        updateCalendarHeader();
        renderCalendar();
    }
    
    // Update the month/year display
    function updateCalendarHeader() {
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 
                           'July', 'August', 'September', 'October', 'November', 'December'];
        currentMonthYear.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
    }
    
    // Render the calendar grid
    function renderCalendar() {
        calendarDays.innerHTML = '';
        
        const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
        const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
        
        // Adjust for Monday as first day of week (0 = Monday, 6 = Sunday)
        let startDay = firstDay.getDay() - 1;
        if (startDay < 0) startDay = 6; // Sunday becomes 6
        
        // Add empty cells for days before the first day of month
        for (let i = 0; i < startDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.className = 'h-10 flex items-center justify-center text-gray-300';
            calendarDays.appendChild(emptyCell);
        }
        
        // Add cells for each day of the month
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        for (let day = 1; day <= lastDay.getDate(); day++) {
            const tempDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
            
            // Check if this day is today
            const isToday = tempDate.getTime() === today.getTime();
            
            // Check if this day is the selected date
            const isSelected = selectedDateValue && 
                tempDate.getDate() === selectedDateValue.getDate() &&
                tempDate.getMonth() === selectedDateValue.getMonth() &&
                tempDate.getFullYear() === selectedDateValue.getFullYear();
            
            // Check if this day has tasks
            const dateKey = `${tempDate.getFullYear()}-${tempDate.getMonth()}-${tempDate.getDate()}`;
            const hasTask = taskDatesMap[dateKey];
            
            // Create the day cell container
            const cellContainer = document.createElement('div');
            cellContainer.className = 'flex flex-col items-center';
            
            // Day cell
            const dayCell = document.createElement('div');
            // Set class based on state
            let cellClass = 'h-10 flex items-center justify-center rounded-lg mx-auto w-10 cursor-pointer ';
            
            if (isSelected) {
                cellClass += 'bg-[#4361ee] text-white';
            } else if (isToday) {
                cellClass += 'bg-[#ff6b6b] text-white';
            } else {
                cellClass += 'hover:bg-gray-100';
            }
            
            dayCell.className = cellClass;
            dayCell.textContent = day;
            
            // Set click handler - allow selection of any date including past dates
            dayCell.addEventListener('click', () => {
                selectDate(new Date(currentDate.getFullYear(), currentDate.getMonth(), day));
                renderCalendar(); // Re-render to update selection
            });
            
            cellContainer.appendChild(dayCell);
            
            // Add task marker dot if this day has tasks
            if (hasTask) {
                const taskMarker = document.createElement('div');
                taskMarker.className = 'w-1.5 h-1.5 bg-[#ff6b6b] rounded-full mt-1';
                cellContainer.appendChild(taskMarker);
            }
            
            calendarDays.appendChild(cellContainer);
        }
    }
    
    // Handle date selection
    function selectDate(date) {
        selectedDateValue = date;
        selectedDate.value = formatDate(date);
        clearDate.classList.remove('hidden');
    }
    
    // Format date as "Month Day, Year"
    function formatDate(date) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }
    
    // Format date as YYYY-MM-DD for form input
    function formatDateForInput(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
    
    // Event Listeners
    calendarToggle.addEventListener('click', () => {
        calendarModal.classList.remove('hidden');
        initCalendar();
    });
    
    closeCalendar.addEventListener('click', () => {
        calendarModal.classList.add('hidden');
    });
    
    // Close when clicking outside modal
    calendarModal.addEventListener('click', (e) => {
        if (e.target === calendarModal) {
            calendarModal.classList.add('hidden');
        }
    });
    
    prevMonth.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateCalendarHeader();
        renderCalendar();
    });
    
    nextMonth.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateCalendarHeader();
        renderCalendar();
    });
    
    clearDate.addEventListener('click', () => {
        selectedDateValue = null;
        selectedDate.value = '';
        clearDate.classList.add('hidden');
        renderCalendar();
    });
    
    applyDate.addEventListener('click', () => {
        if (selectedDateValue) {
            // Filter tasks by selected date
            window.location.href = `{{ route('dashboard') }}?date=${formatDateForInput(selectedDateValue)}`;
        }
        calendarModal.classList.add('hidden');
    });
    
    // Initialize
    initCalendar();
});

    </script>
</body>
</html>