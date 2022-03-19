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
        <table class="table-light text-center">
            <thead>
            <th class="col-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span> Название/имя </span>
                    <button class="btn btn-outline-dark" id="orderName"> &uarr;</button>
                </div>
            </th>
            <th class="col-3">Описание</th>
            <th class="col-3">Категория</th>
            <th class="col-3">Действия</th>
            </thead>

            <tbody id="tableElements">

            </tbody>
        </table>
    </div>

@endsection

@push('child-scripts')
        <script src="{{asset('/js/fetchGetElements.js')}}"></script>
    <script>
        console.log('hello')

        function createTableRow({name, category, description, id}) {
            console.log('123')
            let tr = document.createElement("tr");
            tr.innerHTML = `<tr>
            <td> ${name} </td>
            <td> ${description.substring(0,101)} </td>
            <td> ${category} </td>
            <td> <a href="#" class="btn btn-outline-primary btn-sm"> Подробно </a> </td>
         </tr>`;

            return tr;
        }

        function createTableRow2({name, category, description, id}) {
            console.log('123')

            // let path = '/admin/elements/edit/'+id;
            return `<tr>
                    <td> ${name} </td>
                    <td> ${description.substring(0,101)} </td>
                    <td> ${category} </td>
                    <td> <a href="#" class="btn btn-outline-primary btn-sm"> Подробно </a> </td>
                </tr>`;
        }

        async function getElements() {
            let response = await fetch('/admin/elements-all');
            let data = await response.json();

            console.log(data);
            return data;
        }

        function renderElements(elements) {
            let table = document.querySelector('#tableElements')
            //clearContainer(table);

            let res = "";
            elements.forEach((element) => {
                //table.append(createTableRow(element));
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
