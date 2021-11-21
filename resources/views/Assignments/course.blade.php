@extends('Layout.SidePanel')

@section('title', 'Tugas | OneRoom')

@section('content')
    <h1>Tugas</h1>
    <div class="d-flex mobile-overflow-hidden mobile-w-100">
        <div id="cardMenu" class="mobile-card-menu mobile-w-100 w-200px">
            @foreach ($courses as $c )
            <div class="card {{ (isset($course) && $course->id===$c->id) ? " color-hijau-tua"  : "bg-hijau-tua text-white" }} mb-3">
                <div class="card-body">
                    <div class="text-capitalize fs-16">{{$c->name}}</div>
                    <a href="{{route('course.assignments.index',$c)}}" class="stretched-link"></a>
                    <p class="card-text text-end fs-14 mt-2"><small> {{$c->classAssignments(Auth::user()->classes->pluck('id'))->count()}} Tugas</small></p>
                </div>
            </div>
            @endforeach
        </div>
        <div id="cardMenu2" class="mobile-ml-0 mobile-card-menu2 mobile-w-100 ml-20 w-85">
            @yield('show')
        </div>
    </div>

    <script>
        @if(Request::is('course/*'))
            $(document).ready(function(){
                $("#cardMenu").animate({right: '100%'})
                $("#cardMenu2").animate({left: '0'})
            });
        @endif
    </script>

@endsection
    