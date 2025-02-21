<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-Do List App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/planner.png') }}" type="image/x-icon">

    <!-- GSAP Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;

            /* Gaya tambahan untuk integration-item */
            .integration-item {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Background Pattern -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <div id="particle-container" class="absolute inset-0"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center px-4 py-12">
        <!-- Header -->
        <nav class="w-full max-w-6xl mx-auto flex justify-between items-center mb-16 header">
            <div class="flex items-center">
                <div class="bg-white p-2 rounded-lg shadow-md">
                    <i class="fas fa-tasks text-[#ff6b6b] text-xl"></i>
                </div>
                <span class="ml-3 text-xl font-bold text-gray-800">TaskMaster</span>
            </div>

            <div class="flex items-center space-x-4">
                <a href="#features" class="text-gray-700 hover:text-[#ff6b6b] transition-colors hidden md:block">Features</a>
                <a href="#howItWorks" class="text-gray-700 hover:text-[#ff6b6b] transition-colors hidden md:block">How It Works</a>
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-[#ff6b6b] border border-[#ff6b6b] hover:bg-[#ff6b6b] hover:text-white transition-colors">Login</a>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="w-full max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center mb-24 hero">
            <div class="order-2 md:order-1 hero-left">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Manage Your Tasks <span class="text-[#ff6b6b]">Effortlessly</span></h1>
                <p class="text-gray-600 text-lg mb-8">Stay organized, focused, and productive with our intuitive task management application.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-[#ff6b6b] text-white rounded-lg shadow-lg hover:bg-[#ff5252] transition-colors flex items-center justify-center">
                        <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-white text-[#ff6b6b] border border-[#ff6b6b] rounded-lg shadow-lg hover:bg-gray-50 transition-colors flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                </div>
            </div>
            <div class="order-1 md:order-2 flex justify-center hero-right">
                <div class="relative">
                    <!-- Dashboard Preview -->
                    <div class="bg-white p-6 rounded-2xl shadow-xl max-w-md w-full">
                        <!-- Task header -->
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-semibold text-lg">
                                <i class="fas fa-clipboard-list text-[#ff6b6b] mr-2"></i>
                                To-Do List
                            </h3>
                            <span class="text-[#ff6b6b]">
                                <i class="fas fa-plus"></i>
                            </span>
                        </div>

                        <!-- Task items -->
                        <div class="space-y-4">
                            <div class="border rounded-lg p-3">
                                <div class="flex justify-between">
                                    <div>
                                        <h4 class="font-medium">Complete Project Proposal</h4>
                                        <p class="text-sm text-gray-600 mt-1">Finalize the document and send to client</p>
                                        <div class="flex items-center mt-2 gap-2">
                                            <span class="text-xs text-gray-500">Due: May 20, 2025</span>
                                            <span class="text-xs text-blue-500">Priority: High</span>
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <span class="bg-[#ff6b6b] text-white w-8 h-8 flex items-center justify-center rounded-md">
                                            <i class="fas fa-pencil-alt text-sm"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="border rounded-lg p-3">
                                <div class="flex justify-between">
                                    <div>
                                        <h4 class="font-medium">Team Meeting</h4>
                                        <p class="text-sm text-gray-600 mt-1">Weekly progress discussion</p>
                                        <div class="flex items-center mt-2 gap-2">
                                            <span class="text-xs text-gray-500">Due: May 22, 2025</span>
                                            <span class="text-xs text-blue-500">Priority: Moderate</span>
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <span class="bg-[#ff6b6b] text-white w-8 h-8 flex items-center justify-center rounded-md">
                                            <i class="fas fa-pencil-alt text-sm"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative elements -->
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-[#ff6b6b] rounded-full opacity-20"></div>
                    <div class="absolute -top-4 -left-4 w-16 h-16 bg-[#ff6b6b] rounded-full opacity-20"></div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="w-full max-w-6xl mx-auto mb-24 features">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Fitur Utama</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Semua yang Anda butuhkan untuk mengelola tugas harian dengan mudah</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow feature-item">
                    <div class="w-12 h-12 bg-[#ff6b6b] bg-opacity-10 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-list-check text-[#ff6b6b] text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Manajemen Tugas</h3>
                    <p class="text-gray-600">Buat, edit, dan selesaikan tugas dengan antarmuka yang intuitif dan mudah digunakan.</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow feature-item">
                    <div class="w-12 h-12 bg-[#ff6b6b] bg-opacity-10 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-chart-pie text-[#ff6b6b] text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Analisis Progres</h3>
                    <p class="text-gray-600">Pantau produktivitas dengan visual chart dan statistik lengkap untuk setiap tugas Anda.</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-shadow feature-item">
                    <div class="w-12 h-12 bg-[#ff6b6b] bg-opacity-10 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-bell text-[#ff6b6b] text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pengingat & Notifikasi</h3>
                    <p class="text-gray-600">Jangan lewatkan deadline penting dengan sistem pengingat yang dapat disesuaikan.</p>
                </div>
            </div>
        </div>

        <!-- How It Works Section -->
        <div id="howItWorks" class="w-full max-w-6xl mx-auto mb-24 how-it-works">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Cara Kerja</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Mulai produktif dalam 3 langkah sederhana</p>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-4 md:gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md text-center max-w-xs w-full relative step-item">
                    <div class="w-12 h-12 bg-[#ff6b6b] rounded-full flex items-center justify-center text-white font-bold mx-auto mb-4">1</div>
                    <h3 class="text-xl font-semibold mb-2">Daftar Akun</h3>
                    <p class="text-gray-600">Buat akun baru dalam hitungan detik, tanpa verifikasi yang rumit.</p>
                    <!-- Arrow connector (hidden on mobile) -->
                    <div class="hidden md:block absolute -right-6 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-long-arrow-alt-right text-2xl text-[#ff6b6b]"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md text-center max-w-xs w-full relative step-item">
                    <div class="w-12 h-12 bg-[#ff6b6b] rounded-full flex items-center justify-center text-white font-bold mx-auto mb-4">2</div>
                    <h3 class="text-xl font-semibold mb-2">Tambahkan Tugas</h3>
                    <p class="text-gray-600">Buat tugas dengan judul, deskripsi, tenggat waktu, dan prioritas.</p>
                    <!-- Arrow connector (hidden on mobile) -->
                    <div class="hidden md:block absolute -right-6 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-long-arrow-alt-right text-2xl text-[#ff6b6b]"></i>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md text-center max-w-xs w-full step-item">
                    <div class="w-12 h-12 bg-[#ff6b6b] rounded-full flex items-center justify-center text-white font-bold mx-auto mb-4">3</div>
                    <h3 class="text-xl font-semibold mb-2">Kelola & Pantau</h3>
                    <p class="text-gray-600">Pantau progres, perbarui status, dan lihat statistik produktivitas Anda.</p>
                </div>
            </div>
        </div>

        <!-- Testimonial Section -->
        <div class="w-full max-w-6xl mx-auto mb-24 testimonials">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Apa Kata Pengguna Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Lebih dari <span class="font-bold text-[#ff6b6b]">50,000+ tim</span> telah menggunakan TaskMaster untuk meningkatkan produktivitas mereka.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-xl shadow-md testimonial-item">
                    <div class="flex items-center mb-4">
                        <img src="https://i.pravatar.cc/100?img=1" alt="Budi Santoso" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-semibold">Budi Santoso</h4>
                            <p class="text-sm text-gray-600">Product Manager di <span class="font-semibold">StartupX</span></p>
                        </div>
                    </div>
                    <p class="text-gray-700">"TaskMaster benar-benar mengubah cara tim saya bekerja! Kami bisa menyelesaikan proyek **30% lebih cepat** dengan fitur manajemen tugas yang intuitif."</p>
                    <div class="mt-4 text-[#ff6b6b]">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-xl shadow-md testimonial-item">
                    <div class="flex items-center mb-4">
                        <img src="https://i.pravatar.cc/100?img=2" alt="Siti Rahma" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-semibold">Siti Rahma</h4>
                            <p class="text-sm text-gray-600">Freelancer & Content Creator</p>
                        </div>
                    </div>
                    <p class="text-gray-700">"Saya dulu sering lupa deadline, tetapi sejak pakai TaskMaster, **jadwal kerja saya jadi lebih teratur!** Notifikasi dan fitur kolaborasi sangat membantu."</p>
                    <div class="mt-4 text-[#ff6b6b]">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-xl shadow-md testimonial-item">
                    <div class="flex items-center mb-4">
                        <img src="https://i.pravatar.cc/100?img=3" alt="Andi Wijaya" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-semibold">Andi Wijaya</h4>
                            <p class="text-sm text-gray-600">CTO di <span class="font-semibold">TechNova</span></p>
                        </div>
                    </div>
                    <p class="text-gray-700">"TaskMaster membantu tim IT kami **mengurangi kebingungan dalam mengelola tugas**. Fitur integrasi dengan Slack dan Google Drive sangat memudahkan."</p>
                    <div class="mt-4 text-[#ff6b6b]">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 4 -->
                <div class="bg-white p-6 rounded-xl shadow-md testimonial-item">
                    <div class="flex items-center mb-4">
                        <img src="https://i.pravatar.cc/100?img=3" alt="Andi Wijaya" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-semibold">Dimas Faiz</h4>
                            <p class="text-sm text-gray-600">CTO di <span class="font-semibold">TechNova</span></p>
                        </div>
                    </div>
                    <p class="text-gray-700">"TaskMaster membantu tim IT kami **mengurangi kebingungan dalam mengelola tugas**. Fitur integrasi dengan Slack dan Google Drive sangat memudahkan."</p>
                    <div class="mt-4 text-[#ff6b6b]">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 5 -->
                <div class="bg-white p-6 rounded-xl shadow-md testimonial-item">
                    <div class="flex items-center mb-4">
                        <img src="https://i.pravatar.cc/100?img=3" alt="Andi Wijaya" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-semibold">Harun</h4>
                            <p class="text-sm text-gray-600">CTO di <span class="font-semibold">TechNova</span></p>
                        </div>
                    </div>
                    <p class="text-gray-700">"TaskMaster membantu tim IT kami **mengurangi kebingungan dalam mengelola tugas**. Fitur integrasi dengan Slack dan Google Drive sangat memudahkan."</p>
                    <div class="mt-4 text-[#ff6b6b]">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 6 -->
                <div class="bg-white p-6 rounded-xl shadow-md testimonial-item">
                    <div class="flex items-center mb-4">
                        <img src="https://i.pravatar.cc/100?img=3" alt="Andi Wijaya" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-semibold">Novrian Abi</h4>
                            <p class="text-sm text-gray-600">CTO di <span class="font-semibold">TechNova</span></p>
                        </div>
                    </div>
                    <p class="text-gray-700">"TaskMaster membantu tim IT kami **mengurangi kebingungan dalam mengelola tugas**. Fitur integrasi dengan Slack dan Google Drive sangat memudahkan."</p>
                    <div class="mt-4 text-[#ff6b6b]">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="w-full max-w-6xl mx-auto mb-24 stats">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div>
                        <div class="text-4xl font-bold text-[#ff6b6b] mb-2">10K+</div>
                        <p class="text-gray-600">Pengguna Aktif</p>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-[#ff6b6b] mb-2">500K+</div>
                        <p class="text-gray-600">Tugas Selesai</p>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-[#ff6b6b] mb-2">4.8</div>
                        <p class="text-gray-600">Rating Pengguna</p>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-[#ff6b6b] mb-2">99%</div>
                        <p class="text-gray-600">Kepuasan Pelanggan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="w-full max-w-6xl mx-auto mb-24 faq">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Pertanyaan Umum</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Jawaban untuk pertanyaan yang sering ditanyakan</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div x-data="{ open: false }" class="bg-white p-6 rounded-xl shadow-md faq-item">
                    <button @click="open = !open" class="flex justify-between items-center w-full text-left font-semibold">
                        <span>Apakah TaskMaster gratis untuk digunakan?</span>
                        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-[#ff6b6b]"></i>
                    </button>
                    <div x-show="open" x-collapse class="mt-4 text-gray-600">
                        <p>Ya, TaskMaster memiliki versi gratis dengan fitur dasar. Kami juga menawarkan paket premium dengan fitur tambahan untuk kebutuhan yang lebih kompleks.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div x-data="{ open: false }" class="bg-white p-6 rounded-xl shadow-md faq-item">
                    <button @click="open = !open" class="flex justify-between items-center w-full text-left font-semibold">
                        <span>Bagaimana cara mengundang anggota tim?</span>
                        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-[#ff6b6b]"></i>
                    </button>
                    <div x-show="open" x-collapse class="mt-4 text-gray-600">
                        <p>Anda bisa mengundang anggota tim dengan masuk ke menu "Tim" dan menambahkan email anggota yang ingin diundang.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div x-data="{ open: false }" class="bg-white p-6 rounded-xl shadow-md faq-item">
                    <button @click="open = !open" class="flex justify-between items-center w-full text-left font-semibold">
                        <span>Apakah data saya aman di TaskMaster?</span>
                        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-[#ff6b6b]"></i>
                    </button>
                    <div x-show="open" x-collapse class="mt-4 text-gray-600">
                        <p>Keamanan data adalah prioritas kami. Kami menggunakan enkripsi SSL dan penyimpanan cloud dengan standar keamanan tinggi.</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div x-data="{ open: false }" class="bg-white p-6 rounded-xl shadow-md faq-item">
                    <button @click="open = !open" class="flex justify-between items-center w-full text-left font-semibold">
                        <span>Apakah TaskMaster bisa terintegrasi dengan aplikasi lain?</span>
                        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-[#ff6b6b]"></i>
                    </button>
                    <div x-show="open" x-collapse class="mt-4 text-gray-600">
                        <p>Ya, TaskMaster dapat terintegrasi dengan Slack, Google Drive, Trello, dan berbagai aplikasi produktivitas lainnya.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Integrations Section -->
        <div class="w-full max-w-6xl mx-auto mb-24 integrations">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Terintegrasi dengan Alat Favoritmu</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Bekerja bersama aplikasi yang sudah kamu gunakan</p>
            </div>

            <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 place-items-center">
                <!-- Google -->
                <div class="w-20 h-20 bg-white rounded-xl shadow-md flex items-center justify-center hover:scale-110 transition integration-item">
                    <i class="fab fa-google text-4xl text-gray-700"></i>
                </div>

                <!-- Slack -->
                <div class="w-20 h-20 bg-white rounded-xl shadow-md flex items-center justify-center hover:scale-110 transition integration-item">
                    <i class="fab fa-slack text-4xl text-[#4A154B]"></i>
                </div>

                <!-- Trello -->
                <div class="w-20 h-20 bg-white rounded-xl shadow-md flex items-center justify-center hover:scale-110 transition integration-item">
                    <i class="fab fa-trello text-4xl text-[#0079BF]"></i>
                </div>

                <!-- Notion -->
                <div class="w-20 h-20 bg-white rounded-xl shadow-md flex items-center justify-center hover:scale-110 transition integration-item">
                    <img src="{{ asset('assets/images/notion.svg') }}" alt="Notion Icon" class="w-10 h-10">
                </div>

                <!-- GitHub -->
                <div class="w-20 h-20 bg-white rounded-xl shadow-md flex items-center justify-center hover:scale-110 transition integration-item">
                    <i class="fab fa-github text-4xl text-gray-700"></i>
                </div>

                <!-- Zoom -->
                <div class="w-20 h-20 bg-white rounded-xl shadow-md flex items-center justify-center hover:scale-110 transition integration-item">
                    <img src="{{ asset('assets/images/zoom.png') }}" alt="Zoom" class="w-10 h-10">
                </div>

                <!-- Microsoft Teams -->
                <div class="w-20 h-20 bg-white rounded-xl shadow-md flex items-center justify-center hover:scale-110 transition integration-item">
                    <i class="fab fa-microsoft text-4xl text-[#6264A7]"></i>
                </div>

                <!-- Dropbox -->
                <div class="w-20 h-20 bg-white rounded-xl shadow-md flex items-center justify-center hover:scale-110 transition integration-item">
                    <i class="fab fa-dropbox text-4xl text-[#0061FF]"></i>
                </div>

                <!-- Asana -->
                <div class="w-20 h-20 bg-white rounded-xl shadow-md flex items-center justify-center hover:scale-110 transition integration-item">
                    <img src="{{ asset('assets/images/asana.png') }}" alt="Asana" class="w-10 h-10">
                </div>

                <!-- Google Drive -->
                <div class="w-20 h-20 bg-white rounded-xl shadow-md flex items-center justify-center hover:scale-110 transition integration-item">
                    <i class="fab fa-google-drive text-4xl text-[#1A73E8]"></i>
                </div>

                <!-- Jira -->
                <div class="w-20 h-20 bg-white rounded-xl shadow-md flex items-center justify-center hover:scale-110 transition integration-item">
                    <i class="fab fa-jira text-4xl text-[#0052CC]"></i>
                </div>

                <!-- Figma -->
                <div class="w-20 h-20 bg-white rounded-xl shadow-md flex items-center justify-center hover:scale-110 transition integration-item">
                    <i class="fab fa-figma text-4xl text-[#F24E1E]"></i>
                </div>
            </div>
        </div>

        <!-- Mobile App -->
        <div class="w-full max-w-6xl mx-auto mb-24 mobile-app">
            <div class="bg-gradient-to-r from-[#ff6b6b] to-[#ff8e8e] rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 mobile-app-text">
                    <h2 class="text-3xl font-bold text-white mb-4">TaskMaster di Genggamanmu</h2>
                    <p class="text-white text-opacity-90 mb-6">Download aplikasi mobile kami untuk mengelola tugas dari mana saja, kapan saja.</p>
                    <div class="flex gap-4">
                        <a href="#" class="bg-black text-white px-4 py-2 rounded-lg flex items-center">
                            <i class="fab fa-apple text-2xl mr-2"></i>
                            <div>
                                <div class="text-xs">Download on the</div>
                                <div class="font-semibold">App Store</div>
                            </div>
                        </a>
                        <a href="#" class="bg-black text-white px-4 py-2 rounded-lg flex items-center">
                            <i class="fab fa-google-play text-2xl mr-2"></i>
                            <div>
                                <div class="text-xs">GET IT ON</div>
                                <div class="font-semibold">Google Play</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center mobile-app-image">
                    <img src="{{ asset('assets/images/mobile-app.png') }}" alt="TaskMaster Mobile App" class="w-64 h-96 object-cover rounded-3xl shadow-xl">
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="w-full max-w-3xl mx-auto mb-24 cta">
            <div class="bg-[#ff6b6b] rounded-2xl p-8 md:p-12 text-center shadow-xl">
                <h2 class="text-3xl font-bold text-white mb-4">Mulai Atur Tugas Anda Hari Ini</h2>
                <p class="text-white text-opacity-90 mb-8 max-w-xl mx-auto">Daftar sekarang dan rasakan kemudahan mengelola tugas dengan interface yang modern dan intuitif.</p>
                <a href="{{ route('register') }}" class="inline-block px-8 py-4 bg-white text-[#ff6b6b] rounded-lg font-semibold shadow-lg hover:bg-gray-100 transition-colors">
                    Daftar Gratis <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="w-full max-w-6xl mx-auto pt-8 border-t border-gray-200 footer">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center">
                    <i class="fas fa-tasks text-[#ff6b6b] text-xl mr-2"></i>
                    <span class="font-bold">TaskMaster</span>
                </div>
                <div class="text-sm text-gray-600">
                    © 2025 TaskMaster. All rights reserved.
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-600 hover:text-[#ff6b6b]"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.facebook.com/share/1BJ4nw95pc/" class="text-gray-600 hover:text-[#ff6b6b]"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/alwannabil_priyanto?igsh=MTRoZTJvOGlpdjJvag==" class="text-gray-600 hover:text-[#ff6b6b]"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Particles animation script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('particle-container');
            const colors = ["#ff6b6b", "#ff8e8e", "#ffb6b6"];
            const particlesCount = window.innerWidth < 768 ? 30 : 50;
            const particles = [];

            // Create particles
            for (let i = 0; i < particlesCount; i++) {
                const particle = document.createElement('div');
                const size = Math.random() * 6 + 2;

                particle.style.position = 'absolute';
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                particle.style.borderRadius = '50%';
                particle.style.opacity = Math.random() * 0.3 + 0.1;

                // Random position
                const posX = Math.random() * 100;
                const posY = Math.random() * 100;
                particle.style.left = posX + '%';
                particle.style.top = posY + '%';

                // Store particle properties
                const particleObj = {
                    element: particle,
                    x: posX,
                    y: posY,
                    speed: Math.random() * 0.2 + 0.1,
                    direction: Math.random() * 360
                };

                particles.push(particleObj);
                container.appendChild(particle);
            }

            // Animate particles
            function animateParticles() {
                particles.forEach(particle => {
                    // Calculate new position
                    const radians = particle.direction * (Math.PI / 180
                    );
                    particle.x += Math.cos(radians) * particle.speed;
                    particle.y += Math.sin(radians) * particle.speed;

                    // Boundary check
                    if (particle.x < 0 || particle.x > 100 || particle.y < 0 || particle.y > 100) {
                        particle.direction = (particle.direction + 180) % 360;
                    }

                    // Update DOM
                    particle.element.style.left = particle.x + '%';
                    particle.element.style.top = particle.y + '%';
                });

                requestAnimationFrame(animateParticles);
            }

            animateParticles();
        });

        // GSAP Animations
    gsap.registerPlugin(ScrollTrigger);

gsap.config({
    nullTransformBehavior: "reset"
});

// Standard sections - fall down animation
[".header", ".hero-left", ".hero-right", ".stats", ".integrations", ".mobile-app-text", ".mobile-app-image", ".cta"].forEach(selector => {
    gsap.fromTo(selector,
        { opacity: 0, y: -100 }, // Start from top (falling down)
        { 
            opacity: 1, 
            y: 0, 
            duration: 0.8, 
            ease: "power3.out",
            scrollTrigger: {
                trigger: selector,
                start: "top 85%",
                end: "top 25%",
                scrub: 1
            }
        }
    );
});

// Features section - left to right (desktop), alternating (mobile)
const featureItems = gsap.utils.toArray(".feature-item");
const isMobile = window.innerWidth < 768;

featureItems.forEach((item, index) => {
    // For desktop: all items come from left
    // For mobile: odd items from left, even items from right
    const startX = isMobile && index % 2 !== 0 ? 100 : -100;
    
    gsap.fromTo(item,
        { opacity: 0, x: startX },
        { 
            opacity: 1, 
            x: 0, 
            duration: 0.6, 
            ease: "power3.out", 
            delay: index * 0.2,
            scrollTrigger: {
                trigger: item,
                start: "top 85%",
                end: "top 25%",
                scrub: 1
            }
        }
    );
});

// How it works section - left to right (desktop), alternating (mobile)
const stepItems = gsap.utils.toArray(".step-item");

stepItems.forEach((item, index) => {
    // For desktop: all items come from left
    // For mobile: odd items from left, even items from right
    const startX = isMobile && index % 2 !== 0 ? 100 : -100;
    
    gsap.fromTo(item,
        { opacity: 0, x: startX },
        { 
            opacity: 1, 
            x: 0, 
            duration: 0.6, 
            ease: "power3.out", 
            delay: index * 0.2,
            scrollTrigger: {
                trigger: item,
                start: "top 85%",
                end: "top 25%",
                scrub: 1
            }
        }
    );
});

// Testimonials section - left to right (desktop), alternating (mobile)
const testimonialItems = gsap.utils.toArray(".testimonial-item");

testimonialItems.forEach((item, index) => {
    // For desktop: all items come from left
    // For mobile: odd items from left, even items from right
    const startX = isMobile && index % 2 !== 0 ? 100 : -100;
    
    gsap.fromTo(item,
        { opacity: 0, x: startX },
        { 
            opacity: 1, 
            x: 0, 
            duration: 0.6, 
            ease: "power3.out", 
            delay: index * 0.15,
            scrollTrigger: {
                trigger: item,
                start: "top 85%",
                end: "top 25%",
                scrub: 1
            }
        }
    );
});

// FAQ items - fall down animation
gsap.utils.toArray(".faq-item").forEach((item, index) => {
    gsap.fromTo(item,
        { opacity: 0, y: -50 },
        { 
            opacity: 1, 
            y: 0, 
            duration: 0.5, 
            ease: "power3.out", 
            delay: index * 0.1,
            scrollTrigger: {
                trigger: item,
                start: "top 85%",
                end: "top 25%",
                scrub: 1
            }
        }
    );
});

// Integration items - fall down animation
gsap.utils.toArray(".integration-item").forEach((item, index) => {
    gsap.fromTo(item,
        { opacity: 0, y: -50 },
        { 
            opacity: 1, 
            y: 0, 
            duration: 0.4, 
            ease: "power3.out", 
            delay: index * 0.05,
            scrollTrigger: {
                trigger: item,
                start: "top 90%",
                end: "top 40%",
                scrub: 1
            }
        }
    );
});

// Footer stays visible without animation
document.querySelector(".footer").style.opacity = "1";

// Add window resize event to update animations when switching between mobile and desktop
window.addEventListener('resize', function() {
    const newIsMobile = window.innerWidth < 768;
    if (newIsMobile !== isMobile) {
        // Force page refresh when changing between mobile and desktop view
        location.reload();
    }
});

    </script>
</body>
</html>