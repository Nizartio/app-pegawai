<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    @vite('resources/css/app.css')
    <style>
        /* Hidden class for JavaScript control */
        .dropdown-hidden {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- 1. Fixed Navbar (Header) -->
    <nav class="fixed top-0 inset-x-0 z-50 bg-gray-800 shadow-xl h-16 flex items-center justify-between px-4 sm:px-6">
        
        <div class="flex items-center">
            <!-- Mobile Sidebar Toggle Button (Only visible on small screens) -->
            <button id="sidebar-toggle-mobile" type="button" class="inline-flex items-center p-2 text-sm text-gray-400 rounded-lg sm:hidden hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-700 mr-3">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
            </button>
            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=white&shade500" alt="App Pegawai Logo" class="h-8 w-auto" />
            <h1 class="text-xl font-bold text-white ml-3">App Pegawai</h1>
        </div>

        <!-- Profile Dropdown (Right Side) -->
        <div class="relative">
            <!-- Dropdown Button -->
            <button id="profile-dropdown-button" type="button" class="relative flex rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false" aria-haspopup="true">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open user menu</span>
                <img src="https://placehold.co/32x32/1a1a1a/ffffff?text=U" alt="User Profile" class="size-8 rounded-full bg-gray-800" />
            </button>

            <!-- Dropdown Menu -->
            <div id="profile-dropdown-menu" class="dropdown-hidden absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <div class="px-4 py-2 text-sm text-gray-700 border-b">
                    <div class="font-medium">User Name</div>
                    <div class="text-xs text-gray-500">user@example.com</div>
                </div>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
            </div>
        </div>
    </nav>

    <!-- 2. Fixed Sidebar (Starts below Navbar) -->
    <aside id="default-sidebar" class="fixed top-16 left-0 z-40 w-64 h-[calc(100vh-4rem)] transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800 shadow-xl">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ url('/employees') }}"
                      class="flex items-center p-2 rounded-lg group transition duration-150
                              {{ request()->is('employees*') ? 'bg-indigo-700 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                          <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>
                        <span class="ms-3">Employees</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/departments') }}"
                      class="flex items-center p-2 rounded-lg group transition duration-150
                              {{ request()->is('departments*') ? 'bg-indigo-700 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                          <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
                        </svg>
                        <span class="ms-3">Departments</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/positions') }}"
                      class="flex items-center p-2 rounded-lg group transition duration-150
                              {{ request()->is('positions*') ? 'bg-indigo-700 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bank2" viewBox="0 0 16 16">
                          <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Positions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/attendance') }}"
                      class="flex items-center p-2 rounded-lg group transition duration-150
                              {{ request()->is('attendance*') ? 'bg-indigo-700 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                         <svg class="shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Attendance</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/salary') }}"
                      class="flex items-center p-2 rounded-lg group transition duration-150
                              {{ request()->is('salary*') ? 'bg-indigo-700 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                          <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                          <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Salary</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- 3. Main Content Area Container (Starts below Navbar and next to Sidebar) -->
    <div class="sm:ml-64 pt-16">
        <!-- Main Content Area -->
        <main class="p-4">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="p-4 text-center text-sm text-gray-500 sm:ml-64">
        <p>&copy; {{ date('Y') }} App Pegawai</p>
    </footer>

    <script>
        // JS for Profile Dropdown Toggle
        document.addEventListener('DOMContentLoaded', () => {
            const button = document.getElementById('profile-dropdown-button');
            const menu = document.getElementById('profile-dropdown-menu');

            button.addEventListener('click', () => {
                const isHidden = menu.classList.toggle('dropdown-hidden');
                button.setAttribute('aria-expanded', !isHidden);
            });
            
            // Close dropdown if user clicks outside
            document.addEventListener('click', (event) => {
                if (!button.contains(event.target) && !menu.contains(event.target)) {
                    menu.classList.add('dropdown-hidden');
                    button.setAttribute('aria-expanded', 'false');
                }
            });
        });

        // JS for Sidebar Mobile Toggle
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('default-sidebar');
            const toggleButton = document.getElementById('sidebar-toggle-mobile');

            if (toggleButton && sidebar) {
                toggleButton.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
