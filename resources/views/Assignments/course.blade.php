
@extends('Layout.SidePanel')

@section('title', 'Assignment Center')

@section('content')
    <h1>Tugas</h1>
    <div class="d-flex">
        <div class="w-200px">
            @foreach ($courses as $course )
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$course->name}}</h5>
                        <a href="{{route('course.assignments.index',$course)}}" class="stretched-link"></a>
                        <p class="card-text text-end"><small> {{$course->classAssignments(Auth::user()->classes->pluck('id'))->count()}} Tugas</small></p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="ml-20 w-85">
            @yield('show')
        </div>
    </div>
@stop
