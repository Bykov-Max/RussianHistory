@extends('layouts.admin')
@section('title', 'element-update')

@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

    <div class="my-3">
        <div class="text-end p-3">
            <a href="{{route('posts.show')}}" class="btn btn-outline-secondary">Назад</a>
        </div>
        @include('inc.errors')
        <div class="card mb-3">
            <form action="{{route('elements.update', ['element' => $element])}}" method="post" enctype="multipart/form-data" class="row g-0">
                @csrf
                @method("PATCH")
                <div class="col-md-8 d-flex flex-column justify-content-between">
                    <div class="card-body">
                        {{--Название--}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Название</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="Введите название..." value="{{old('title', $element->name)}}">


                        </div>
                        {{--Описание--}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <textarea type="text" class="form-control" id="description" name="description"
                                      rows="3">{{old('title')}}</textarea>
                        </div>
                        {{--Дата создания--}}
                        <p class="card-text">
                            <small class="text-muted">{{now()->format('d.m.Y')}}</small>
                        </p>
                        <div class="text-end">
                            <button class="btn btn-outline-primary">Обновить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#biography'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
