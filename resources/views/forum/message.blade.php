@extends('layouts.app')

@section('title', 'forum')

@section('content')
    <div class="chats" style="background: url('{{asset('/storage/glavnaya3.jpg')}}')">
        <div class="add">
            <button class="btn btn-primary addTheme">  </button>
            <form action="{{route('theme.add')}}" class="new_theme" method="post">
                @csrf
                <label for="theme_name"> Введите название темы</label>
                <input type="text" name="name" id="theme_name">
                <button> Предложить тему </button>
            </form>
        </div>



        <div class="themes">
            @foreach($themes as $theme)
                <div>
                    <a href="{{route('show.messages', $theme)}}" class="theme"> {{$theme->name}} </a>
                </div>
            @endforeach




        </div>
    </div>


    <script>

        let new_theme = document.querySelector('.new_theme');
        let add_theme = document.querySelector('.addTheme');
        add_theme.innerHTML = "Предложить тему";

        add_theme.addEventListener('click', function (){
            new_theme.hidden = !new_theme.hidden;
            add_theme.innerHTML = (add_theme.innerHTML === 'Предложить тему') ? add_theme.innerHTML = 'Отменить' : add_theme.innerHTML = 'Предложить тему';
            // document.querySelector('.addTheme').classList.add('removeTheme');
        })

        // document.querySelector('.removeTheme').addEventListener('click', function (){
        //
        // })
    </script>
@endsection



