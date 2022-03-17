@extends('layouts.admin')
@section('title', 'admin_panel')

@section('content')
    <h4>Привет, {{Auth::user()->role->role}} {{Auth::user()->full_name}}</h4>
    <div style="background-color: red; color: white; width: 200px; height: 50px;"> Количество элементов: {{$elements->count()}} </div> <br>
    <div style="background-color: blue; color: white; width: 200px; height: 50px;"> Количество пользователей: {{Auth::user()->count()}} </div> <br>
    <div style="background-color: blue; color: white; width: 200px; height: 50px;"> Количество категорий: {{$categories->count()}} </div>

@endsection
