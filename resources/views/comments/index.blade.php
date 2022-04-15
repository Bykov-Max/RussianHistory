@extends('layouts.admin')
@section('title', 'comments')

@section('content')
    <div class="container">
        <select name="status" id="status">
            <option value="-1" selected> Все комментарии</option>
            <option value="0"> Неопубликованные комментарии </option>
            <option value="1"> Опубликованные комментарии </option>
        </select>
        <br>
        <p id="countComments"></p>

        <table class="table-light text-center" border="2" cellpadding="20px" cellspacing="20px">
            <thead>
            <th class="col-3">Пользователь</th>
            <th class="col-3">Комментарий</th>
            <th class="col-3">Опубликовать</th>
            <th class="col-3">Удалить</th>
            </thead>

            <tbody id="tableComments" style="border: 2px solid black">
            </tbody>
        </table>
    </div>

@endsection

@push('child-scripts')
    <script src="{{asset('js/fetchGetComments.js')}}"></script>
    <script>
        function createTableRow({comment, user_name, id}) {
            let path = '/admin/comments/' + id;
            let path2 = '/admin/comments/' + id + '/updateStatus';
            return `<tr style="border: 2px solid black">
                        <td> ${user_name} </td>
                        <td> ${comment.substring(0, 101)} </td>
                        <td> <a href="${path2}" class="btn btn-outline-primary btn-sm"> Опубликовать </a> </td>
                        <td> <form action='${path}' method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Вы действительно хотите удалить комментарий?');"
                                        name="deleteBtn" class="buttonDel">
                                        Удалить
                                </button>
                               </form>
                        </td>
                    </tr>`;
        }

        async function getComments() {
            let response = await fetch('/admin/comments-all');
            let data = await response.json();
            return data;
        }

        async function getFilterComments(status){
            let response = await fetch('/admin/comments/filter/'+status);
            let data = await response.json();
            return data;
        }

        async function loadFilterComments(status = -1){
            console.log('----------- = '+status)
            if (status == -1){
                comments = await getComments();
            }
            else{
                comments = await getFilterComments(status);
            }
            document.querySelector('#countComments').textContent = "Комментариев найдено: "+comments.length;
            return comments;
        }

        function renderComments(comments) {
            let comms = document.querySelector('#tableComments')

            let res = "";
            comments.forEach((comment) => {
                res += createTableRow(comment);
            })
            comms.innerHTML = res;
        }

        async function loadComments() {
            comments = await getComments();
            return comments;
        }

        async function start() {
            comments = await loadComments();
            renderComments(comments)
        }

        start();

        document.querySelector('#status').addEventListener('change', async (e)=>{
            let statusValue = e.target.value;
            comments = await loadFilterComments(statusValue);
            renderComments(comments);
        });

    </script>
    <script src="{{asset('/js/workWithComments.js')}}"></script>
@endpush
