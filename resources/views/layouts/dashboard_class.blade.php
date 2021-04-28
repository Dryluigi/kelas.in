<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="flex h-screen">
        <aside class="flex flex-col flex-none w-72 bg-indigo-700 border-r border-gray-7000">
            <div class="border-b border-indigo-800 text-center p-2">
                <h1 class="text-2xl font-bold text-white">{{ $class->nama }}</h1>
                <h2 class="text-gray-300 text-sm">{{ $class->instansi }}</h2>
            </div>
            <a href="{{ route('profile') }}">
                <div class="flex space-x-2 p-4 flex-none border-b border-indigo-800 pb-6">
                    <div class="w-12 h-12 flex-none relative">
                        <div class="w-full h-full rounded-full bg-yellow-200"></div>
                        <small class="absolute -bottom-0.5 -translate-x-1/2 inline-block px-1 py-0.5 rounded-full text-xs font-semibold text-white bg-red-500">{{ $role }}</small>
                    </div>
                    <div class="flex flex-col justify-center">
                        <h4 class="hover:underline text-lg font-semibold text-gray-100">{{ $user->user->nama }}</h4>
                        <p class="text-sm text-gray-300">{{ $user->email }}</p>
                    </div>
                </div>
            </a>
            <div class="flex-auto">
                <ul>
                    <a href="{{ route('classes.show', $class) }}">
                        <li class="hover:bg-indigo-800 cursor-pointer">
                            <div class="flex items-center p-3 space-x-2 text-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <h5 class="font-bold text-xl ">Beranda</h5>
                            </div>
                        </li>
                    </a>
                    <a href="#">
                        <li class="hover:bg-indigo-800 cursor-pointer">
                            <div class="flex items-center p-3 space-x-2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <h5 class="font-bold text-xl ">Tugas</h5>
                            </div>
                        </li>
                    </a>
                    <a href="{{ route('classes.users', $class) }}">
                        <li class="hover:bg-indigo-800 cursor-pointer">
                            <div class="flex items-center p-3 space-x-2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <h5 class="font-bold text-xl ">Anggota</h5>
                            </div>
                        </li>
                    </a>
                    <a href="#">
                        <li class="hover:bg-indigo-800 cursor-pointer">
                            <div class="flex items-center p-3 space-x-2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                <h5 class="font-bold text-xl ">Jadwal Pelajaran</h5>
                            </div>
                        </li>
                    </a>
                    <a href="{{ route('classes.posts', $class) }}">
                        <li class="hover:bg-indigo-800 cursor-pointer">
                            <div class="flex items-center p-3 space-x-2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <h5 class="font-bold text-xl ">Post</h5>
                            </div>
                        </li>
                    </a>
                    <a href="#">
                        <li class="hover:bg-indigo-800 cursor-pointer">
                            <div class="flex items-center p-3 space-x-2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
                                </svg>    
                                <h5 class="font-bold text-xl ">Jadwal Piket</h5>
                            </div>
                        </li>
                    </a>
                </ul>
            </div>
            <div class="flex flex-col border-t border-indigo-800">
                <a href="{{ route('profile.classes') }}">
                    <div class="hover:bg-indigo-800 cursor-pointer">
                        <div class="flex items-center p-3 space-x-2 text-gray-200">
                            <h5 class="font-bold text-xl">Kelasku</h5>
                        </div>
                    </div>
                </a>
                <div class="hover:bg-indigo-800">
                    <div class="flex items-center space-x-2 text-gray-200">
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf        
                            <input type="submit" value="Logout" class="h-full w-full p-3 font-bold text-xl bg-transparent text-left cursor-pointer">
                        </form>
                    </div>
                </div>
                <h1 class="inline-block border-t border-indigo-800 text-2xl font-bold text-white p-3">Kelas.in</h1>
    
            </div>
        </aside>
    
        <main class="flex flex-col flex-auto p-4">
            
            @yield('content')
    
        </main>
    </div>    
</body>
</html>