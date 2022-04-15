@extends('layouts.admin')
@section('title', 'elements')

@section('content')



    <div class="container">
        <select name="categories" id="categories">
            <option value="0" selected> Все элементы</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}"> {{$category->name}} </option>
            @endforeach
        </select>

        <a href="{{route('admin.create.elements')}}" class="btn btn-outline-primary btn-sm"> Добавить элемент </a>

        <p id="countElements">Элементов найдено: </p>
        <table class="table-light text-center" border="2" cellpadding="20px" cellspacing="20px">
            <thead>
            <th class="col-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span> Название/имя </span>
                    <button class="btn btn-outline-dark" id="orderName"> &uarr;</button>
                </div>
            </th>
            <th class="col-3">Описание</th>
            <th class="col-3">Категория</th>
            <th class="col-3">Изменить</th>
            <th class="col-3">Удалить</th>
            </thead>

            <tbody id="tableElements" style="border: 2px solid black">

            </tbody>
        </table>
    </div>

@endsection

@push('child-scripts')
        <script src="{{asset('/js/fetchGetElements.js')}}"></script>
    <script>
        function createTableRow2({name, category, description, id}) {
            let path = '/admin/elements/edit/'+id;
            let path2 = '/admin/elements/'+id;
            return `<tr style="border: 2px solid black">
                        <td> ${name} </td>
                        <td> ${description.substring(0,101)} </td>
                        <td> ${category} </td>
                        <td> <a href="${path}" class="btn btn-outline-primary btn-sm"> Изменить </a> </td>
                        <td> <form action='${path2}' method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Вы действительно хотите удалить информацию?');"
                                        name="deleteBtn" class="buttonDel">
                                        Удалить
                                </button>
                               </form>
                        </td>
                    </tr>`;
        }

        async function getElements() {
            let response = await fetch('/admin/elements-all');
            let data = await response.json();

            console.log(data);
            return data;
        }

        function renderElements(elements) {
            console.log(elements)
            let table = document.querySelector('#tableElements')

            let res = "";
            elements.forEach((element) => {
                res += createTableRow2(element);
            })
            table.innerHTML = res;
        }

        async function loadElements() {
            elements = await getElements();
            document.querySelector('#countElements').textContent += elements.length;
            return elements;
        }

        async function start() {
            elements = await loadElements();
            renderElements(elements)
        }

        start();
    </script>
    <script src="{{asset('/js/workWithElements.js')}}"></script>
@endpush
