<div class="menu">
    <header>
        <nav class="site">
            <div class="siteName">
                <p>RussianHistory.ru</p>
            </div>

            <div class="login">
                @guest()
                    <a href="{{route('register.index')}}" class="reg"> Регистрация </a>
                @endguest
                @auth()
                    <a href="{{route('profile')}}" class="name">{{Auth::user()->name}}</a>
                @endauth
            </div>

            <div class="logout">
                @guest()
                    <a href="{{route('login')}}">Войти</a>
                @endguest
                @auth
                    <a href="{{route('logout')}}">Выйти</a>
                @endauth
            </div>
        </nav>
    </header>


    <div class="burger"> <p align="center">Меню</p> </div>
    <div class="block-menu">
        
        <a href="{{route('home')}}" class="logo"> <img src="{{asset('/storage/logo2.jpg')}}" alt="logo"> </a>
        @if($categories)
            @foreach($categories as $category)
                <a href="{{route('elements.filter', $category->id)}}"> {{$category->name}} </a>
            @endforeach
        @endif
    </div>


</div>


