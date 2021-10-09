
@extends('Layout.SidePanel')

@section('title', 'Classes Center')

@section('content')
    <h1>Tugas</h1>
    @foreach ($courses as $course )
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">{{$course->name}}</h5>
                <a href="{{route('assignment.show',$c->id)}}" class="stretched-link"></a>
                <p class="card-text text-end"><small> {{$c->users->count()}} orang</small></p>
            </div>
        </div>
    @endforeach
    @can('create', App\Models\Classes::class )
        <div class="card">
            <a data-bs-toggle="modal" data-bs-target="#createClasses" class="card-body btn btn-outline-dark">
                <i class='fa fa-plus '></i> Tambah Kelas
            </a>
        </div>
    @endcan
    @include('classes._create')
   
    @yield('show')
@stop
