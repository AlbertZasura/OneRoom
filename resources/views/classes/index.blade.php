
@extends('Layout.SidePanel')

@section('title', 'Classes Center')

@section('content')
    <h1>Class</h1>
    @foreach ($classes as $key => $c )
        <a href="{{route('classes.show',$c->id)}}">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$c->name}}</h5>
                    <p class="card-text text-end"><small> {{$c->users->count()}} orang</small></p>
                </div>
            </div>
        </a>
    @endforeach
@stop
