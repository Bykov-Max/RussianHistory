@extends('layouts.app')

@isset($post)
    @section('title', 'post')
@endisset

@section('content')
    @if($post)
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2 mb-2">
            <a href="{{URL::previous()}}" type="button" class="btn btn-outline-primary">Назад</a>
        </div>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{$post->image_url}}" class="img-fluid rounded-start" alt="img">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        @canany(['edit-post', 'delete-post'], $post)
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{route('posts.edit', $post)}}" class="btn btn-sm btn-outline-warning me-2">Изменить</a>
                                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDestroy">
                                    Удалить
                                </a>
                            </div>
                        @endcanany
                        <h4 class="card-title">{{$post->title}}</h4>
                        <h5 class="card-title">{{$post->user->name}}</h5>
                        <p class="card-text">{{$post->content}}</p>

                        @if($usedCategories->count() > 0)
                            <strong>Категории статьи</strong> (щёлкните для удаления)
                            <div class="my-3 d-flex justify-content-center flex-wrap">
                                @foreach($usedCategories as $category)
                                    <a href="{{route('post-category-detach', [$post, $category])}}" class="px-3 py-2 m-1 text-decoration-none badge bg-danger">
                                        {{$category->name}}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        @if($freeCategories->count() > 0)
                            <strong>Свободные статьи</strong> (щёлкните для добавления)
                            <div class="my-3 d-flex justify-content-center flex-wrap">
                                @foreach($freeCategories as $category)
                                    <a href="{{route('post-category-attach', [$post, $category])}}" class="px-3 py-2 m-1 text-decoration-none badge bg-danger">
                                        {{$category->name}}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        <p class="card-text"><small class="text-muted">{{$post->date_order_humans}}</small></p>
                    </div>
                </div>
            </div>
        </div>
        @include('inc.modal-destroy')
    @endif
@endsection
