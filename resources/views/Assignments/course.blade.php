
@extends('Layout.SidePanel')

@section('title', 'Assignment Center')

@section('content')
    <h1>Tugas</h1>
    @foreach ($courses as $course )
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">{{$course->name}}</h5>
                <a href="{{route('course.assignments.index',$course)}}" class="stretched-link"></a>
                <p class="card-text text-end"><small> {{$course->assignments->count()}} Tugas</small></p>
            </div>
        </div>
    @endforeach
   
    @yield('show')
@stop
