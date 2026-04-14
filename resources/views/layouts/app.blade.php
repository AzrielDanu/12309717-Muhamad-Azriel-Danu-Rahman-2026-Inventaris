<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Inventaris</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .sidebar-active {
            background-color: #4f46e5;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.4);
        }
    </style>
</head>

<body class="h-full overflow-hidden bg-slate-50">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 bg-white border-r border-slate-200">
            <div class="flex flex-col flex-grow pt-5 overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-6 mb-8 mt-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-800">Inventaris</span>
                </div>
                @if (auth()->user()->role === 'admin')
                    
                <div class="flex flex-col justify-between h-screen">
                    <div class="mt-5 flex-1 px-4 space-y-2">
                        <a href="{{ route('admin.categories.index') }}"
                            class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl fill-white transition-all duration-200 {{ request()->routeIs('admin.categories.*') ? 'sidebar-active' : 'text-slate-600 hover:bg-slate-50 fill-[#fff]' }}">
                            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 -960 960 960"  class="size-5 mr-3" ><path d="m260-520 220-360 220 360H260ZM700-80q-75 0-127.5-52.5T520-260q0-75 52.5-127.5T700-440q75 0 127.5 52.5T880-260q0 75-52.5 127.5T700-80Zm-580-20v-320h320v320H120Zm580-60q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm-500-20h160v-160H200v160Zm202-420h156l-78-126-78 126Zm78 0ZM360-340Zm340 80Z"/></svg>
                            Categories
                        </a>
    
                        <a href="{{ route('admin.items.index') }}"
                            class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.items.*') ? 'sidebar-active' : 'text-slate-600 hover:bg-slate-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Items
                        </a>
                        
                        <a href="{{ route('admin.users.admins') }}"
                            class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users.admins') ? 'sidebar-active' : 'text-slate-600 hover:bg-slate-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Users - Admin
                        </a>
                        <a href="{{ route('admin.users.operators') }}"
                            class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users.operators') ? 'sidebar-active' : 'text-slate-600 hover:bg-slate-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Users - Operator
                        </a>
                @endif
                 @if (auth()->user()->role === 'staff')
                    
                <div class="flex flex-col justify-between h-screen">
                    <div class="mt-5 flex-1 px-4 space-y-2">
    
                        <a href="{{ route('staff.items.index') }}"
                            class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('staff.items.*') ? 'sidebar-active' : 'text-slate-600 hover:bg-slate-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Items
                        </a>
                        <a href="{{ route('staff.lendings.index') }}"
                            class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('staff.lendings.*') ? 'sidebar-active' : 'text-slate-600 hover:bg-slate-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Lendings
                        </a>
                        
                            <button onclick="openProfileModal()"
                                class="group w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 text-slate-600 hover:bg-slate-50">
                                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Edit Account
                            </button>
                        
                @endif
                    </div>
                    <div class="my-6 flex items-center justify-center">
                        <form action="{{ route('logout') }}" method="POST" class="w-full mx-4">
                            @csrf
                            <button type="submit" class="w-full py-2 bg-slate-200 font-medium rounded-lg shadow text-slate-700 hover:bg-slate-300 transition duration-300">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="md:pl-64 flex flex-col flex-1 w-0">
            <!-- Mobile Header -->
            <div class="md:hidden flex items-center justify-between bg-white border-b border-slate-200 px-4 py-3">
                <span class="text-xl font-bold text-slate-800">Inventaris</span>
                <button class="p-2 text-slate-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <main class="flex-1 relative overflow-y-auto focus:outline-none bg-slate-50/50">
                <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <div id="profileModal" class="fixed inset-0 z-50 hidden" aria-modal="true" role="dialog">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeProfileModal()"></div>

        <!-- Modal Panel -->
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0" id="profileModalPanel">

                <!-- Header -->
                <div class="flex items-center justify-between p-6 border-b border-slate-100">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Edit Account</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Update your personal information</p>
                    </div>
                    <button onclick="closeProfileModal()" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-xl transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Flash message in modal context -->
                @if (session('profile_success'))
                <div class="mx-6 mt-4 flex items-center gap-3 px-4 py-3 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl text-sm">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">{{ session('profile_success') }}</span>
                </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('profile.update') }}" class="p-6 space-y-5">
                    @csrf

                    <div class="space-y-1.5">
                        <label for="profile_name" class="text-sm font-semibold text-slate-700">Full Name</label>
                        <input type="text" id="profile_name" name="name"
                            value="{{ old('name', Auth::user()->name) }}"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-slate-50/50 text-sm">
                        @error('name')
                            <p class="text-rose-500 text-xs font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="profile_email" class="text-sm font-semibold text-slate-700">Email Address</label>
                        <input type="email" id="profile_email" name="email"
                            value="{{ old('email', Auth::user()->email) }}"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-slate-50/50 text-sm">
                        @error('email')
                            <p class="text-rose-500 text-xs font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="profile_password" class="text-sm font-semibold text-slate-700">New Password</label>
                        <p class="text-xs text-slate-400">Leave blank to keep current password.</p>
                        <input type="password" id="profile_password" name="new_password"
                            placeholder="Enter new password"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all bg-slate-50/50 text-sm">
                        @error('new_password')
                            <p class="text-rose-500 text-xs font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit"
                            class="flex-1 bg-indigo-600 text-white font-bold py-3 px-6 rounded-xl hover:bg-indigo-700 transition-all duration-200 shadow-sm shadow-indigo-100 text-sm">
                            Save Changes
                        </button>
                        <button type="button" onclick="closeProfileModal()"
                            class="px-5 py-3 bg-slate-50 text-slate-600 font-bold rounded-xl hover:bg-slate-100 transition-all border border-slate-100 text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
</body>
</html>

  <script>
        function openProfileModal() {
            const modal = document.getElementById('profileModal');
            const panel = document.getElementById('profileModalPanel');
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                panel.classList.remove('scale-95', 'opacity-0');
                panel.classList.add('scale-100', 'opacity-100');
            });
        }

        function closeProfileModal() {
            const modal = document.getElementById('profileModal');
            const panel = document.getElementById('profileModalPanel');
            panel.classList.remove('scale-100', 'opacity-100');
            panel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 200);
        }

        // Auto-open modal if there are validation errors or success for profile fields
        @if ($errors->has('name') || $errors->has('email') || $errors->has('new_password') || session('profile_success'))
            document.addEventListener('DOMContentLoaded', () => openProfileModal());
        @endif
    </script>
