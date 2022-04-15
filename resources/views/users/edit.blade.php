@extends('layouts.admin')
@section('title', 'user-edit')

@section('content')
    <h3>{{$user->full_name}}</h3>

    <form id="editUser" action="#" method="post">
        @csrf
        @method('PATCH')
        <select id="selectRole">
            @foreach($roles as $role)
                <option value="{{$role->id}}" {{$role->id == $user->role_id ? 'selected' : ''}}> {{$role->name}} </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-outline-primary"> Обновить </button>
        <br>

        <p id="res"></p>
    </form>
@endsection

@push('child-scripts')
    <script>
        console.log('333')
        async function updateUser(route, data, _token){
            console.log(1111)
            let response = await fetch(route, {
                method: 'PATCH',
                headers: {'Content-Type': 'application/json;charset=utf-8'},
                body: JSON.stringify({data, _token})
            });
            console.log(response)
            return await response.json();
        }

        document.querySelector('#editUser').addEventListener('submit', async (e)=>{
            e.preventDefault();
            console.log(222)
            let data = await updateUser("{{route('admin.users.update', $user)}}", selectRole.value, '{{ csrf_token() }}');
            console.log(data)
            document.querySelector("#res").innerText = "Роль успешно обновлена";
        });
    </script>
@endpush
