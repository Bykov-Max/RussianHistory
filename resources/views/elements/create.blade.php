@extends('layouts.app')
@section('title', 'post-create')

@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

    <div class="my-3">
        <div class="text-end p-3">
            <a href="{{route('elements.index')}}" class="btn btn-outline-secondary">Назад</a>
        </div>
        @include('inc.errors')
        <div class="card mb-3">
            <form action="{{route('elements.store')}}" method="post" enctype="multipart/form-data" class="row g-0">
                @csrf
                <div class="col-md-8 d-flex flex-column justify-content-between">
                    <div class="card-body">
                        {{--Название--}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Введите название..." value="{{old('name')}}">
                        </div>
                        {{--Описание--}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <textarea type="text" class="form-control" id="description" name="content"
                                      rows="3">{{old('description')}}</textarea>
                        </div>

                        {{-- Изображение --}}
                        <div class="md-3">
                            <p>Выберите изображение</p>
                            <input type="file" id="image" name="image">
                        </div>

                        <div class="col-md-4">
                            <img src="{{ old('image', asset('/storage/default.jpg')) }}"
                                 class="img-fluid rounded-start img-create" alt="post" id="showImage">
                        </div>

                        {{-- Фоновое изображение --}}
                        <div class="md-3">
                            <p>Выберите фоновое изображение</p>
                            <input type="file" id="back_image" name="back_image">
                        </div>

                        <div class="col-md-4">
                            <img src="{{ old('back_image', asset('/storage/default.jpg')) }}"
                                 class="img-fluid rounded-start img-create" alt="post" id="showImage">
                        </div>

                        {{--Дата создания--}}
                        <p class="card-text">
                            <small class="text-muted">{{now()->format('d.m.Y')}}</small>
                        </p>
                        <div class="text-end">
                            <button class="btn btn-outline-primary">Создать</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
