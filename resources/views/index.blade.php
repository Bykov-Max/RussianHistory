@extends('layouts.app')

@section('title', 'home')

@section('content')
    <main>
        <img src="{{asset('/storage/glavnaya3.jpg')}}">
        <div class="welcome">
            Добро пожаловать
        </div>
    </main>
@endsection
