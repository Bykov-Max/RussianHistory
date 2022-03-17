<header>
    <nav class="site">
        <div>
            <p>RussianHistory.ru</p>
        </div>

        <div>
            @guest()
                <a href="{{route('register.index')}}" class="reg"> Регистрация </a>
            @endguest
            @auth()
                <a href="{{route('profile')}}" class="name">{{Auth::user()->name}}</a>
            @endauth
        </div>

        <div>
            @guest()
                <a href="{{route('login')}}">Войти</a>
            @endguest
            @auth
                <a href="{{route('logout')}}">Выйти</a>
            @endauth
        </div>
    </nav>
</header>

<nav class="block-menu">
    <a href="/" class="logos"> <img src="{{asset('/storage/logo2.jpg')}}" style="height: auto; width: 100%;"> </a>
    @if($categories)
        @foreach($categories as $category)
            <a href="{{route('elements.filter', $category)}}"> {{$category->name}} </a>
        @endforeach
    @endif
</nav>

<script src="{{asset('/js/js2.js')}}"> </script>
