<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col md:flex-row min-h-screen max-w-screen bg-gray-100 text-gray-900">
    <div class="flex flex-col h-auto md:h-screen bg-navy-800 text-white w-full md:w-64 shadow-lg">
        <div class="flex items-center justify-between md:justify-center h-20 border-b border-navy-700 px-4 md:px-0">
            <h1 class="text-2xl font-semibold">Admin</h1>
            <button id="menu-toggle" class="md:hidden">
                <span class="material-icons">menu</span>
            </button>
        </div>
        <nav id="sidebar" class="flex grow mt-4 md:mt-0 md:block hidden">
            <ul class="flex flex-col gap-4 px-4">
                <li>
                    <a href="{{ route('admin.home.index') }}" class="flex items-center gap-4 p-4 rounded-md hover:text-black hover:bg-white transition-colors text-lg w-full">
                        <span class="material-icons">home</span>
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-4 p-4 rounded-md hover:text-black hover:bg-white transition-colors text-lg w-full">
                        <span class="material-icons">people</span>
                        Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.courses.index') }}" class="flex items-center gap-4 p-4 rounded-md hover:text-black hover:bg-white transition-colors text-lg w-full">
                        <span class="material-icons">school</span>
                        Courses
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.faq.index') }}" class="flex items-center gap-4 p-4 rounded-md hover:text-black hover:bg-white transition-colors text-lg w-full">
                        <span class="material-icons">bar_chart</span>
                        FAQ
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <main class="flex-grow p-2 md:p-2">
        <div class="bg-white p-6 rounded-lg shadow-md">
            @yield('content')
        </div>
    </main>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>
</html>