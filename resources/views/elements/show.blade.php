@extends('layouts.app')

@section('title', 'home')

@section('content')

    @if($elements)
        @foreach($elements as $element)
            @if($category->id == 1)
                <div class="backHistory" style="background: url('/storage/{{$element->back_img}}')">
                    <div>
                        <h1> {{$element->name}} </h1>
                        <span> {!! $element->description !!} </span>
                    </div>
                </div>
            @endif
        @endforeach

        @if($category->id != 1)
            <div class="backCateg">
                <img src="{{ asset('storage/'.$category->back_img) }}">
                <div class="informCateg">
                    @foreach($elements as $element)
                        <div class="informName">
                            <a href="{{route('elements.oneElement', $element)}}"> {{$element->name}} </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
@endsection
