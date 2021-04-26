@extends('layouts.app')

@section('content')

<div class="flex h-screen">
    <aside class="flex flex-col flex-none w-72 bg-indigo-700 border-r border-gray-7000">
        <a href="#">
            <div class="flex p-4 space-x-2 flex-none border-b border-indigo-800 pb-6">
                <div class="w-12 h-12 rounded-full bg-yellow-200 flex-none"></div>
                <div class="flex flex-col justify-center">
                    <h4 class="hover:underline text-lg font-semibold text-gray-100">Mario Prasetya Mulya</h4>
                    <p class="text-sm text-gray-300">marioprasetyamulya85@gmail.com</p>
                </div>
            </div>
        </a>
        <div class="flex-auto">
            <ul>
                <li class="hover:bg-indigo-800 cursor-pointer">
                    <div class="flex items-center p-3 space-x-2 text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        <h5 class="font-bold text-xl">Kelas saya</h5>
                    </div>
                </li>
                <li class="hover:bg-indigo-800 cursor-pointer">
                    <div class="flex items-center p-3 space-x-2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h5 class="font-bold text-xl ">Tugas</h5>
                    </div>
                </li>
            </ul>
        </div>
        <div class="flex flex-col border-t border-indigo-800">
            <a href="{{ route('logout') }}">
                <div class="hover:bg-indigo-800">
                    <div class="flex items-center p-3 space-x-2 text-gray-200">
                        <h5 class="font-bold text-xl ">Logout</h5>
                    </div>
                </div>
            </a>
            <h1 class="inline-block text-2xl font-bold text-white p-3">Kelas.in</h1>

        </div>
    </aside>

    <main class="flex flex-col flex-auto p-4">
        <div class="flex justify-end pb-4">
            <a href="{{ route('kelas.create') }}">
                <div class="btn-indigo">Buat kelas</div>
            </a>
        </div>
        <div class="overflow-y-auto">
            <div class="h-72 flex space-x-4 py-2">
                <div class="border border-gray-300 rounded-lg h-full w-72 flex flex-col overflow-hidden">
                    <div class="h-20 bg-red-400 flex-none">
                        <h4 class="text-2xl text-white font-bold">D4 IT A 2019</h4>
                    </div>
                    <div class="flex-auto px-2">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error quod iste vel tempora minima, totam veritatis esse, doloribus ad labore excepturi facilis eum quisquam modi expedita. Unde dicta illum magnam?
                    </div>
                    <div class="px-2 border-t border-gray-300 h-6 text-sm text-gray-600">Politeknik Elektronika Negeri Surabaya</div>
                </div>

                <div class="border border-gray-300 rounded-lg h-full w-72 flex flex-col overflow-hidden">
                    <div class="h-20 bg-pink-400 flex-none">
                        <h4 class="text-2xl text-white font-bold">D4 IT B 2019</h4>
                    </div>
                    <div class="flex-auto px-2">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error quod iste vel tempora minima, totam veritatis esse, doloribus ad labore excepturi facilis eum quisquam modi expedita. Unde dicta illum magnam?
                    </div>
                    <div class="px-2 border-t border-gray-300 h-6 text-sm text-gray-600">Politeknik Elektronika Negeri Surabaya</div>
                </div>

                <div class="border border-gray-300 rounded-lg h-full w-72 flex flex-col overflow-hidden">
                    <div class="h-20 bg-pink-400 flex-none">
                        <h4 class="text-2xl text-white font-bold">D4 IT B 2019</h4>
                    </div>
                    <div class="flex-auto px-2">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error quod iste vel tempora minima, totam veritatis esse, doloribus ad labore excepturi facilis eum quisquam modi expedita. Unde dicta illum magnam?
                    </div>
                    <div class="px-2 border-t border-gray-300 h-6 text-sm text-gray-600">Politeknik Elektronika Negeri Surabaya</div>
                </div>

            </div>
            <div class="h-72 flex py-2 bg-yellow-200">

            </div>
            <div class="h-72 flex py-2 bg-green-200">

            </div>
        </div>
    </main>
</div>


@endSection