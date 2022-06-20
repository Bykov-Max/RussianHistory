@extends('layouts.app')
@section('title', $element->name)


@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    @if($element)
        <div class="back" style="background: url('/storage/{{$element->back_img}}'), rgba(0, 0, 0, 0.6)">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2 mb-2">
                <a href="{{URL::previous()}}" type="button" class="btn btn-outline-primary" style="font-family: Ancient; font-size: 2rem; color: white; background-color: blue">Назад</a>
            </div>
            <br><br>
            <div class="element">

                <h1> {{$element->name}} </h1>
                @foreach($element->images as $image)
                    <img src="{{ asset('storage/'.$image->image) }}" alt="Картинка для элемента">
                @endforeach <br>
                {!! $element->description !!}

                <hr noshade size="6">

                <h3>Ваши комментарии</h3>
                <input type="hidden" name="element_id" value="{{$element->id}}" id="element_id">

                <p id="comments"> </p>

                <br>
                @guest()
                    <a href="{{route('login')}}"> Авторизуйтесь, чтобы оставлять комментарии </a>
                @endguest

                @auth()

                    <form action="{{route('comments.store')}}" method="post">
                        @csrf
                        <textarea type="text" class="form-control" id="comment" rows="3" name="comment"></textarea>

                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="element_id" value="{{$element->id}}" id="element_id">

                        <br>
                        <button id="submit"> Отправить комментарий </button>
                    </form>

                @endauth
            </div>
        </div>
    @endif
    <script>
        ClassicEditor
            .create(document.querySelector('#comment'))
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection



@push('child-scripts')
    <script src="{{asset('js/fetchGetComments.js')}}"></script>
    <script>
        function createTableRow({comment, user_name, id}){
            let p = document.createElement("p");
            p = `${user_name}<br>
                 ${comment}`;
            return p;
        }

        async function getComments(){
            let response = await fetch('/api/comments');
            let data = await response.json();
            console.log("dfdfd"+data);
            return data;
        }

        async function getFilterComments(element){
            let response = await fetch('/api/comment/'+element+'/element');
            let data = await response.json();
            return data;
        }

        function renderComments(comments) {
            let comms = document.querySelector('#comments')
            let res = "";
            comments.forEach((comment) => {
                if (comment.status == 1){
                    res += createTableRow(comment);
                }
                else{
                    res += comment.user_name+"<br>Комментарий был отправлен на проверку <br><br>"
                }
            })
            comms.innerHTML=res;
        }

        async function loadComments() {
            comments = await getComments();
            return comments;
        }

        async function loadFilterComments(element = 0) {
            if(element == 0){
                comments = await getComments();
            }
            else{
                comments = await getFilterComments(element);
            }
            return comments;
        }

        async function start() {
            let element = document.querySelector("#element_id");
            console.log(element.value)
            comments = await loadFilterComments(element.value);
            renderComments(comments)
        }

        start();
    </script>
@endpush
