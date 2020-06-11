<nav class="navbar navbar-dark bg-dark navbar-expand-md sticky-top">
    <a class="navbar-brand" href="{{ route('projects.index') }}">Laratodo</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navAlt" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navAlt">
        <div class="navbar-nav ml-auto">
            @guest
                <a class="nav-item nav-link text-white" href="{{ route('login') }}">ログイン</a>
                <a class="nav-item nav-link text-white" href="{{ route('register') }}">ユーザ登録</a>
            @endguest
            @auth
                <button form="logout-button" type="submit" class="btn  btn-link text-white">ログアウト</button>
            @endauth
        </div>
    </div>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">@csrf</form>
</nav>
