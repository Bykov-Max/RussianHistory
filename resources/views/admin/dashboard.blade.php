@extends('layouts.admin')
@section('title', 'admin_panel')

@section('content')
    <h4>Привет, {{Auth::user()->role->role}} {{Auth::user()->full_name}}</h4>
    <div class="counts">
        <div style="background-color: red; color: white;"> Количество пользователей: {{Auth::user()->count()}} </div>
        <div style="background-color: blue; color: white;"> Количество элементов: {{$elements->count()}} </div>
        <div style="background-color: blue; color: white;"> Количество категорий: {{$categories->count()}} </div>
        <div style="background-color: blue; color: white;"> Количество комментариев: {{$comments->count()}} </div>
    </div>


@endsection
