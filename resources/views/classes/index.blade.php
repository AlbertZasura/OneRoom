
@extends('Layout.SidePanel')

@section('title', 'Kelas | OneRoom')

@section('content')
    <h1 class="show-on-dekstop">Kelas</h1>
    <div class="d-flex  mobile-overflow-hidden mobile-w-100">
        <div id="cardMenu" class="mobile-card-menu mobile-w-100 w-200px">
            <h1 class="show-on-mobile">Kelas</h1>
            @can('create', App\Models\Classes::class )
                <div class="card mb-3 border-0">
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
        <div id="cardMenu2" class="mobile-ml-0 mobile-card-menu2 mobile-w-100 ml-20 w-85">
            @yield('show')
        </div>
    </div>
    
    <script>
        @if(Request::is('classes/*'))
            $(document).ready(function(){
                $("#cardMenu").animate({right: '100%'})
                $("#cardMenu2").animate({left: '0'})
            });
        @endif
    </script>
   
@endsection
