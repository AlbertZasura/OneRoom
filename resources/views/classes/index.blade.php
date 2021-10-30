
@extends('Layout.SidePanel')

@section('title', 'Classes Center')

@section('content')
    <h1>Kelas</h1>
    <div class="d-flex">
        <div class="w-200px">
            @foreach ($classes as $key => $c )
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$c->name}}</h5>
                        <a href="{{route('classes.show',$c->id)}}" class="stretched-link"></a>
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
                @include('classes._create')
            @endcan
        </div>
        <div class="ml-20 w-85">
            @yield('show')
        </div>
    </div>
    
   
@endsection
