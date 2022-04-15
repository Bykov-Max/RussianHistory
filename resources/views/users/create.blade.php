@extends('layouts.app')
@section('title', 'post-create')

@section('content')
    <div class="my-3">
        <div class="text-end p-3">
            <a href="{{route('posts.index')}}" class="btn btn-outline-secondary">Назад</a>
        </div>
        @include('inc.errors')
        <div class="card mb-3">
            <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data" class="row g-0">
                @csrf
                <div class="col-md-8 d-flex flex-column justify-content-between">
                    <div class="card-body">
                        <div class="md-3">
                            <input type="file" id="image" name="image">
                        </div>

                        {{--Название--}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Название</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="Введите название..." value="{{old('title')}}">
                        </div>
                        {{--Описание--}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <textarea type="text" class="form-control" id="description" name="content"
                                      rows="3">{{old('title')}}</textarea>
                        </div>
                        {{--Дата создания--}}
                        <p class="card-text">
                            <small class="text-muted">{{now()->format('d.m.Y')}}</small>
                        </p>
                        <div class="text-end">
                            <button class="btn btn-outline-primary">Создать</button>
                        </div>

                        <div class="col-md-4">
                            <img src="{{ old('image', asset('/storage/default.jpg')) }}"
                                 class="img-fluid rounded-start img-create" alt="post" id="showImage">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
