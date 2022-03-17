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
            <th class="col-3">Действия</th>
            </thead>

            <tbody id="tableUsers">

            </tbody>
        </table>
    </div>

@endsection

@push('child-scripts')
        <script src="{{asset('/js/fetchGet.js')}}"></script>
    <script>
        console.log('hello')

        function createTableRow({full_name, role, comments_count, id}) {
            console.log('123')
            let tr = document.createElement("tr");
            tr.innerHTML = `<tr>
            <td> ${full_name} </td>
            <td> ${role} </td>
            <td> ${comments_count} </td>
            <td> <a href="#" class="btn btn-outline-primary btn-sm"> Подробно </a> </td>
         </tr>`;

            return tr;
        }

        function createTableRow2({full_name, role, comments_count, id}) {
            console.log('123')

            let path = '/admin/users/edit/'+id;
            return `<tr>
                    <td> ${full_name} </td>
                    <td> ${role} </td>
                    <td> ${comments_count} </td>
                    <td> <a href="${path}" class="btn btn-outline-primary btn-sm"> Подробно </a> </td>
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
                //table.append(createTableRow(user));
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
    </script>
    <script src="{{asset('/js/workWithElements.js')}}"></script>
@endpush
