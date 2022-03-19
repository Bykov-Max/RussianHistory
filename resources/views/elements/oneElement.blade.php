@extends('layouts.app')

@section('title', $element->name)

@section('content')
    @if($element)
            <div class="back" style="background: url('/storage/{{$element->back_img}}')">
                <div class="element">
                    <h1> {{$element->name}} </h1>
                    @foreach($element->images as $image)
                        <img src="{{ asset('storage/'.$image->image) }}">
                    @endforeach <br>
                    {!! $element->description !!}
                </div>
            </div>
    @endif
@endsection
