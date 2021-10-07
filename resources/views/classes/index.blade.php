
@extends('Layout.SidePanel')

@section('title', 'Classes Center')

@section('content')
    <h1>Class</h1>
    @foreach ($classes as $key => $c )
        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('classes.edit',$c->id) }}" class="text-white stretched-link" style="position: relative;">{{$c->name}}</a>
                </h5>
                <form action="{{ route('classes.destroy',$c) }}" method="POST">   
                    @csrf
                    @method('DELETE')      
                    <button type="submit">Delete</button>
                </form>
                <p class="card-text bg-light" style="transform: rotate(0);">
                    <a href="{{route('classes.show',$c->id)}}" class="stretched-link">show
                    </a>
                </p>
                <p class="card-text text-end"><small> {{$c->users->count()}} orang</small></p>
            </div>
        </div>
    @endforeach
    @can('create', App\Models\Classes::class )
        <a data-bs-toggle="modal" data-bs-target="#createClasses">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Tambah Kelas</h5>
                </div>
            </div>
        </a>
    @endcan
   
    
    @include('classes._create')
    @yield('show')
@stop
