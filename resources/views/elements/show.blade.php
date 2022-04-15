@extends('layouts.app')
@section('title', $category->name)

@section('content')
    @if($elements)
        
        <div class="backCateg" style="background: url('{{ asset('storage/'.$category->back_img) }}'), rgba(0, 0, 0, 0.6)">
            <div class="informCateg">
                @foreach($elements as $element)
                    <div class="informName">
                        <a href="{{route('elements.oneElement', $element)}}"> {{$element->name}} </a>
                    </div>
                @endforeach
            </div>
        </div>
        
    @endif
@endsection

