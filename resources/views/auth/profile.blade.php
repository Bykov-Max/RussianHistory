@extends('layouts.app')
@section('title', 'profile')

@section('content')
    @auth
        <div class="col">
            <div class="card h-100">
                <div class="card-header" align="center">Личный кабинет пользователя {{Auth::user()->name}}</div>

                <div class="profile">
                    <p>Личное фото:</p>
                    <img src="/storage/{{Auth::user()->photo}}" class="card-img-top" alt="img">
                </div>

            </div>
        </div>
    @endauth
@endsection
