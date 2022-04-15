@extends('layouts.admin')
@section('title', 'element-update')

@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

    <div class="my-3">
        @include('inc.errors')
        <div class="card mb-3">
            <form action="{{route('admin.elements.update', ['element' => $element])}}" method="post" enctype="multipart/form-data" class="row g-0">
                @csrf
                @method("PATCH")
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
                                   placeholder="Введите название..." value="{{$element->name}}">
                        </div>

                        {{--Описание--}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <textarea type="text" class="form-control" id="description" name="description"
                                      rows="3">{{$element->description}}</textarea>
                        </div>

                        {{-- Добавить изображение --}}
{{--                        <div class="md-3">--}}
{{--                            <p>Добавить изображение</p>--}}
{{--                            <input type="file" id="image" name="addImage" multiple="multiple">--}}
{{--                        </div>--}}

{{--                        <div class="col-md-4">--}}
{{--                            <img src="{{ asset('/storage/default.jpg') }}"--}}
{{--                                 class="img-fluid rounded-start img-create" alt="post" id="showImage">--}}
{{--                        </div>--}}
{{--                        <br>--}}

                        {{-- Изображение --}}
                        @foreach($element->images as $image)
                            Изменить изображение
                            <div class="col-md-4">
                                <img src="/storage/{{$image->image}}"
                                     class="img-fluid rounded-start img-create" alt="post" id="showImage">
                            </div>

                            <div class="md-3">
                                <input type="file" id="image" name="changeImage" multiple="multiple" value="">
                            </div>
                        @endforeach <br>

                        {{-- Фоновое изображение --}}
                        <div class="md-3">
                            <p>Выберите фоновое изображение</p>
                            <input type="file" id="back_image" name="back_image" value="Выберите фоновое изображение">
                        </div>

                        <div class="col-md-4">
                            <img src="/storage/{{$element->back_img}}"
                                 class="img-fluid rounded-start img-create" alt="post" id="showBackImage">
                        </div>

                        {{--Дата создания--}}
                        <p class="card-text">
                            <small class="text-muted">{{now()->format('d.m.Y')}}</small>
                        </p>
                        <div class="text-end">
                            <button class="btn btn-outline-primary">Изменить</button>
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
