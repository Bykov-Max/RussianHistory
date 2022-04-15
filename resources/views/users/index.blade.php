@extends('layouts.admin')
@section('title', 'users')

@section('content')
    <div class="container">
        <select name="roles" id="roles">
            <option value="0" selected> Все пользователи</option>
            @foreach($roles as $role)
                <option value="{{$role->id}}"> {{$role->name}} </option>
            @endforeach
        </select>

        <p id="countUsers">Пользователей найдено: </p>
        <table class="table-light text-center">
            <thead>
            <th class="col-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span> Полное имя </span>
                    <button class="btn btn-outline-dark" id="orderName"> &uarr;</button>
                </div>
            </th>
            <th class="col-3">Роль</th>
            <th class="col-3">
                <div class="d-flex justify-content-between align-items-center">
                    <span> Количество комментариев </span>
                    <button class="btn btn-outline-dark" id="orderPost"> &darr;</button>
                </div>
            </th>
            <!--<th class="col-3"> Комментарии пользователя </th>-->
            <th class="col-3">Действия</th>
            </thead>

            <tbody id="tableUsers">

            </tbody>
        </table>
        
    <!--    <br><br><br>-->
        
    <!--    <table class="table-light text-center loadComments" border="2" cellpadding="20px" cellspacing="20px" style="display: none;">-->
    <!--        <thead>-->
    <!--        <th class="col-3">Пользователь</th>-->
    <!--        <th class="col-3">Комментарий</th>-->
    <!--        <th class="col-3">Опубликовать</th>-->
    <!--        <th class="col-3">Удалить</th>-->
    <!--        </thead>-->

    <!--        <tbody id="tableComments" style="border: 2px solid black">-->
    <!--        </tbody>-->
    <!--    </table>-->
    <!--</div>-->

@endsection

@push('child-scripts')
        <script src="{{asset('/js/fetchGet.js')}}"></script>
    <script>
        // comments = [];

        function createTableRow2({full_name, role, comments_count, id}) {
            console.log('123')

            let path = '/admin/users/edit/'+id;
            return `<input type="hidden" id="user_id" value="${id}">
                <tr>
                    <td> ${full_name} </td>
                    <td> ${role} </td>
                    <td> ${comments_count} </td>
                    <td> <a href="${path}" class="btn btn-outline-primary btn-sm"> Изменить роль </a> </td>
                </tr>`;
        }

        async function getUsers() {
            let response = await fetch('/admin/users-all');
            let data = await response.json();

            console.log(data);
            return data;
        }

        function renderUsers(users) {
            let table = document.querySelector('#tableUsers')
            //clearContainer(table);

            let res = "";
            users.forEach((user) => {
                res += createTableRow2(user);
            })
            table.innerHTML = res;
        }

        async function loadUsers() {
            users = await getUsers();
            document.querySelector('#countUsers').textContent += users.length;
            return users;
        }

        async function start() {
            users = await loadUsers();
            renderUsers(users)
        }

        start();
        
        
        
        // function createTableComments({comment, user_name, id}) {
        //     let path = '/admin/comments/' + id;
        //     let path2 = '/admin/comments/' + id + '/updateStatus';
        //     return `<tr style="border: 2px solid black">
        //                 <td> ${user_name} </td>
        //                 <td> ${comment.substring(0, 101)} </td>
        //                 <td> <a href="${path2}" class="btn btn-outline-primary btn-sm"> Опубликовать </a> </td>
        //                 <td> <form action='${path}' method="post">
        //                         @csrf
        //                         @method('DELETE')
        //                         <button onclick="return confirm('Вы действительно хотите удалить комментарий?');"
        //                                 name="deleteBtn" class="buttonDel">
        //                                 Удалить
        //                         </button>
        //                       </form>
        //                 </td>
        //             </tr>`;
        // }
            
        // async function getFilterComments(user_id){
        //     let response = await fetch('/admin/comments/filter/'+user_id);
        //     let data = await response.json();
        //     return data;
        // }
        
        // async function loadFilterComments(user_id){
        //     comments = await getFilterComments(user_id);
        //     if ($comments != []){
        //         return comments;
        //     }
            
        //     else return "У данного пользователя нет комментариев"
        // }
        
        // function renderComments(comments) {
        //     let comms = document.querySelector('#tableComments')

        //     let res = "";
        //     comments.forEach((comment) => {
        //         res += createTableComments(comment);
        //     })
        //     comms.innerHTML = res;
        // }
        
        // let showComments = document.querySelector("#showComments");
        
        // showComments.addEventListener("click", function(e){
        //     let loadComments = document.querySelector(".loadComments");
            
        //     loadComments.hidden = !loadComments.hidden;
            
            
            
        //     let user_id = document.querySelector("#user_id");
            
        //     comments = await loadFilterComments(user_id.value);
        //     renderComments(comments);
        // });
        
    </script>
    <script src="{{asset('/js/workWithElements.js')}}"></script>
@endpush
