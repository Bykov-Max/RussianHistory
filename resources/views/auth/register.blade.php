@extends('layouts.app')
@section('title', 'register')

@section('content')
    <div class="back" style="background: url('/storage/glavnaya3.jpg')">
        <div class="card offset-4 col-4 mt-5">
            <div class="card-header">
                Регистрация
            </div>
            <div class="card-body">
                <form action="{{route('register.store')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text">Имя</span>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="'Введите имя...." name="name"
                               value="{{old('name')}}" aria-label="name">
                    </div>

                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror<br>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Фамилия</span>
                        <input type="text"
                               class="form-control @error('surname') is-invalid @enderror"
                               placeholder="'Введите фамилию...." name="surname"
                               value="{{old('surname')}}" aria-label="surname">
                    </div>

                    @error('surname')
                    <p class="text-danger">{{$message}}</p>
                    @enderror<br>

                    <div class="md-3">
                        <input type="file" id="image" name="image">
                    </div>
                    <br>

                    <div class="input-group mb-3 regPhoto">
                        <img src="{{ old('image', asset('/storage/default.jpg')) }}"
                             class="img-fluid rounded-start img-create" alt="post" id="showImage">
                    </div>
                    <br>



                    <div class="input-group mb-3">
                        <span class="input-group-text">E-mail</span>
                        <input type="text"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="'Введите email...." name="email"
                               value="{{old('email')}}" aria-label="email">
                    </div>

                    @error('email')
                    <p class="text-danger">{{$message}}</p>
                    @enderror<br>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Пароль</span>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="'Введите пароль...." name="password"
                               value="{{old('password')}}" aria-label="password">
                    </div>

                    @error('password')
                    <p class="text-danger">{{$message}}</p>
                    @enderror<br>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Повторите пароль</span>
                        <input type="password"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               placeholder="Повторите пароль...." name="password_confirmation"
                               value="{{old('password')}}" aria-label="password_confirmation">
                    </div>
                    @error('password_confirmation')
                    <p class="text-danger">{{$message}}</p>
                    @enderror

                    @error('errorRegister')
                    <p class="text-danger">{{$message}}</p>
                    @enderror

                    <div class="input-group mb-3">
                        <a href="{{route('login')}}" class="text-secondary text-decoration-none"> Есть аккаунт? </a>
                    </div>

                    <button type="submit" class="btn btn-primary">Регистрация</button>
                </form>
            </div>
        </div>
    </div>

@endsection
