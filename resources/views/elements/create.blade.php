@extends('layouts.admin')
@section('title', 'element-create')

@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

    <div class="my-3">
        <div class="text-end p-3">
            <a href="{{route('admin.show.elements')}}" class="btn btn-outline-secondary">Назад</a>
        </div>
        @include('inc.errors')
        <div class="card mb-3">
            <form action="{{route('admin.elements.store')}}" method="post" enctype="multipart/form-data" class="row g-0">
                @csrf
                <div class="col-md-8 d-flex flex-column justify-content-between">
                    {{-- Категория --}}
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Выберите категорию</label>
                            <select name="category_id" id="category_id">
                                <option value="0" selected> Выберите категорию </option>

                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"> {{$category->name}} </option>
                                @endforeach
                            </select>
                        </div>

                        {{--Название--}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Введите название...">
                        </div>

                        {{--Описание--}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <textarea type="text" class="form-control" id="description" name="description"
                                      rows="3"></textarea>
                        </div>

                        {{-- Изображение --}}
                        <div class="md-3">
                            <p>Выберите изображение</p>
                            <input type="file" id="image" name="image">
                        </div>

                        <div class="col-md-4">
                            <img src="{{ asset('/storage/default.jpg') }}"
                                 class="img-fluid rounded-start img-create" alt="post" id="showImage">
                        </div>

                        {{-- Фоновое изображение --}}
                        <div class="md-3">
                            <label for="back_image">Выберите фоновое изображение</label>
                            <input type="file" id="back_image" name="back_image">
                        </div>

                        <div class="col-md-4">
                            <img src="{{ asset('/storage/default.jpg') }}"
                                 class="img-fluid rounded-start img-create" alt="post" id="showBackImage">
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
