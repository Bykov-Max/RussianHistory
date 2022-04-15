@extends('layouts.app')

@section('content')
    <div class="adminka">
        <main class="form-signin mt-5 admin-panel" align="center" style="width: 50%; margin: 0 auto 4% auto;">
            <form action="{{route('admin.login.check')}}" method="post">
                @csrf
                <img class="mb-4" src="{{asset('storage/default.jpg')}}" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Введите email и пароль</h1>

                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                           placeholder="name@example.com"
                           name="email">
                    <label for="floatingInput">Email address</label>
                </div>

                @error('email')
                <p class="text-danger">{{$message}}</p>
                @enderror<br>

                <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password') is-invalid    @enderror"
                           id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Пароль</label>
                </div>

                @error('password')
                <p class="text-danger">{{$message}}</p>
                @enderror<br>

                @error('errorLogin')
                <p class="text-danger">{{$message}}</p>
                @enderror

                <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
            </form>
        </main>
    </div>

@endsection
