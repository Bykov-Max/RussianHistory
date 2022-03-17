@extends('layouts.app')
@section('title', 'auth')

@section('content')
    <div class="card offset-4 col-4 mt-5" style="background: url('/public/storage/glavnaya3.jpg')">
        <div class="card-header">
            Авторизация
        </div>
        <div class="card-body">
            <form action="{{route('login.check')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text">E-mail</span>
                    <input type="text"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="'Введите email...." name="email"
                           value="{{old('email')}}" aria-label="email">
                </div>

                @error('email')
                <p class="text-danger">{{$message}}</p>
                @enderror

                <div class="input-group mb-3">
                    <span class="input-group-text">Пароль</span>
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="'Введите пароль...." name="password"
                           value="{{old('password')}}" aria-label="password">
                </div>

                @error('password')
                <p class="text-danger">{{$message}}</p>
                @enderror

                <div class="input-group mb-3">
                    <input type="checkbox"
                           class="form-check-input @error('password') is-invalid @enderror"
                           name="remember"
                            id="remember" {{old('remember') ? 'checked':''}}>
                    <label for="remember" class="form-check-label"> Запомнить меня</label>
                </div>

                @error('errorLogin')
                    <p><small class="text-danger">{{$message}}</small></p>
                @enderror

                <div class="input-group mb-3">
                    <a href="{{route('register.index')}}" class="text-secondary text-decoration-none"> Регистрация </a>
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
        </div>
    </div>
@endsection
