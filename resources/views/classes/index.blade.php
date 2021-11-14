
@extends('Layout.SidePanel')

@section('title', 'Kelas | OneRoom')

@section('content')
    <h1>Kelas</h1>
    <div class="d-flex">
        <div class="w-200px">
            @can('create', App\Models\Classes::class )
                <div class="card mb-3">
                    <a data-bs-toggle="modal" data-bs-target="#createClasses" class="card-body btn btn-outline-green">
                        <i class='fa fa-plus '></i> Tambah Kelas
                    </a>
                </div>
                @include('classes._create')
            @endcan
            @foreach ($classes as $key => $c )
                <div class="card {{ (isset($class) && $class->id===$c->id) ? "bg-biru-muda color-hijau-tua"  : "bg-hijau-tua text-white" }} mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$c->name}}</h5>
                        <a href="{{route('classes.show',$c->id)}}" class="stretched-link"></a>
                        <p class="card-text text-end"><small> {{$c->users->count()}} orang</small></p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="ml-20 w-85">
            @yield('show')
        </div>
    </div>
    
   
@endsection
