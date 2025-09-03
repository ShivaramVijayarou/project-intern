<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a2d9d6df4b.js" crossorigin="anonymous"></script>
     <script src="//unpkg.com/alpinejs" defer></script>



     <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
        }

        .sidebar {
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
                height: 100%;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }
            .overlay.active {
                display: block;
            }
        }

        .main-content {
            transition: margin-left 0.3s ease;
        }

        .hamburger {
            display: none;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            height: 8px;
            background-color: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease-in-out;
        }

        .notification-dot {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 12px;
            height: 12px;
            background-color: #ef4444;
            border-radius: 50%;
        }

        .stats-card {
            border-left: 4px solid var(--primary);
        }

        .stats-card:nth-child(2) {
            border-left-color: #10b981;
        }

        .stats-card:nth-child(3) {
            border-left-color: #f59e0b;
        }

        .stats-card:nth-child(4) {
            border-left-color: #ef4444;
        }

        .course-progress {
            transition: all 0.3s ease;
        }

        .course-progress:hover {
            background-color: #f9fafb;
        }

        .deadline-item {
            transition: all 0.3s ease;
        }

        .deadline-item:hover {
            background-color: #f9fafb;
            transform: translateX(5px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
    </style>

</head>



<body class="bg-gray-100 flex">

     <!-- Overlay for mobile sidebar -->
    <div class="overlay" id="overlay"></div>

    {{-- Sidebar --}}
    @include('student.layouts.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</body>



</html>
