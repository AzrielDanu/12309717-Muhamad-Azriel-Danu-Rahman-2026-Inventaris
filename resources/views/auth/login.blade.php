<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Latukk4</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite('resources/css/app.css')
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top right, #eef2ff 0%, #f8fafc 50%, #f1f5f9 100%);
        }
    </style>
</head>

<body class="h-full flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <!-- Logo/Header -->
        <div class="text-center mb-10">
            
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Login <span class="text-indigo-600">Here</span></h1>
            <p class="text-slate-500 mt-2 font-medium">Login Your Acoount Here</p>
        </div>

        <div class="bg-white p-10 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-100 text-rose-600 rounded-2xl animate-in fade-in duration-300">
                    <ul class="text-sm font-medium space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                        <input type="email" name="email" id="email"
                            class="w-full px-4 py-3.5 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none placeholder:text-slate-400"
                             required>
                    </div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                        </div>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-3.5 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 outline-none placeholder:text-slate-400"
                             >
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-bold hover:bg-indigo-700 transition-all duration-200 shadow-lg shadow-indigo-100 active:scale-[0.98]">
                        Login
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</body>

</html>