<div class="bg-navbar text-white flex items-center justify-end">
    @auth
        <a href="{{ url('/manage/posts') }}" class="hover:opacity-75 mx-2">Dashboard</a>
        <form action="/logout" class="ml-2" method="post">
            @csrf
            <button class="btn bg-navbar-light hover:opacity-50">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    @endauth
</div>