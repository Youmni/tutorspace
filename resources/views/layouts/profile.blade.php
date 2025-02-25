<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TutorSpace</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800">
    <header class="shadow-lg bg-white border">
    <nav class="container mx-auto flex flex-col md:flex-row items-center justify-between p-4">
            <a href="{{ route('home.index') }}" class="text-2xl font-bold text-gray-900">TutorSpace</a>
            <form method="get" action="{{ route('courses.index') }}" class="flex items-center gap-2 mt-4 md:mt-0">
                <span class="material-icons text-gray-500">search</span>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search courses..." 
                    value="{{ request('search') }}"
                    class="border border-gray-300 rounded-full py-2 px-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </form>

            <ul class="flex flex-wrap items-center gap-6 md:flex-nowrap md:gap-6">
                <li>
                    <a href="{{ route('courses.index') }}" class="text-gray-700 hover:text-blue-500 transition-colors">
                        Courses
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact.index') }}" class="text-gray-700 hover:text-blue-500 transition-colors">
                        Contact
                    </a>
                </li>
                <li>
                    <a href="{{ route('faq.index') }}" class="text-gray-700 hover:text-blue-500 transition-colors">
                        FAQ
                    </a>
                </li>
                @if (Route::has('login'))
                    @auth
                        <li>
                            <a
                                href="{{ route('profile.index') }}"
                                class="rounded-md px-3 py-2 text-gray-700 transition hover:text-blue-500"
                            >
                                Profile
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="rounded-md text-red-600 hover:text-red-800 transition-colors">
                                    | Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 bg-blue-500 text-white transition hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                Log in
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li>
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 bg-blue-500 text-white transition hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    Register
                                </a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>

        </nav>
    </header>
    <hr>
    <div class="flex flex-col md:flex-row flex-grow">
        <nav id="sidebar" class="bg-white text-black border-r w-full md:w-64 shadow-lg p-4">
            <ul class="flex flex-col gap-4">
                <li>
                    <a href="{{ route('profile.index') }}" class="flex items-center gap-4 p-4 rounded-md hover:text-white hover:bg-black transition-colors text-lg w-full {{ request()->routeIs('admin.home.index') ? 'bg-white text-black' : '' }}">
                        <span class="material-icons">home</span>
                        Overview
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.courses') }}" class="flex items-center gap-4 p-4 rounded-md hover:text-white hover:bg-black transition-colors text-lg w-full {{ request()->routeIs('admin.users.index') ? 'bg-white text-black' : '' }}">
                        <span class="material-icons">people</span>
                        Courses
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.security') }}" class="flex items-center gap-4 p-4 rounded-md hover:text-white hover:bg-black transition-colors text-lg w-full {{ request()->routeIs('admin.courses.index') ? 'bg-white text-black' : '' }}">
                        <span class="material-icons">school</span>
                        Security
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.chats.index', ['conversation' => 2]) }}" class="flex items-center gap-4 p-4 rounded-md hover:text-white hover:bg-black transition-colors text-lg w-full {{ request()->routeIs('admin.courses.index') ? 'bg-white text-black' : '' }}">
                        <span class="material-icons">chat</span>
                        Chats
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.reservations.index', ['conversation' => 2]) }}" class="flex items-center gap-4 p-4 rounded-md hover:text-white hover:bg-black transition-colors text-lg w-full {{ request()->routeIs('admin.courses.index') ? 'bg-white text-black' : '' }}">
                        <span class="material-icons">calendar_today</span>
                        Reservations
                    </a>
                </li>
            </ul>
        </nav>

        <main class="flex-grow p-4 container mx-auto">
            <div class="bg-white border border-black p-6 rounded-lg shadow-md flex-grow">
                @yield('content')
            </div>
        </main>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; 2024 Youmni</p>
    </footer>
</body>
</html>