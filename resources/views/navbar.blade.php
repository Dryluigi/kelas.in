<nav class="flex justify-between px-6 py-4 items-center">
    <a href="{{ route('landing') }}"><h1 class="text-2xl font-bold">Kelas.IN</h1>
    </a>
    @guest
    <div class="flex space-x-4">
        <a href="{{ route('login') }}">
            <div class="btn-indigo hover:btn-indigo-invert">Login</div>
        </a>
        <a href="{{ route('register') }}">
            <div class="btn-indigo-invert hover:btn-indigo">Register</div>
        </a>
    </div>
    @endGuest
    @auth
    <div class="flex space-x-4">
        <a href="{{ route('profile.classes') }}">
            <div class="btn-indigo hover:btn-indigo-invert">Kelas saya</div>
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="submit" class="btn-indigo-invert" value="Logout">
        </form>
    </div>
    
    @endauth
</nav>