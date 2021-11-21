
@extends('Layout.SidePanel')

@section('title', 'Absen | OneRoom')

@section('content')
    <h1 class="show-on-dekstop">Absen</h1>
    <div class="d-flex mobile-overflow-hidden mobile-w-100">
        <div id="cardMenu" class="mobile-card-menu mobile-w-100 w-200px">
            <h1 class="show-on-mobile">Absen</h1>
            @can('viewAny', App\Models\Absent::class )
                @foreach ($courses as $c )
                <div class="card {{ (isset($course) && $c->id===$course->id) ? " color-hijau-tua"  : "bg-hijau-tua text-white" }} mb-3">
                    <div class="card-body">
                        <div class="text-capitalize fs-16">{{$c->name}}</div>
                        <a href="{{route('course.absents.index',$c)}}" class="stretched-link"></a>
                        <p class="card-text text-end fs-14 mt-2">
                            {{ App\Models\Schedule::where('course_id',$c->id)->where('class_id',Auth::user()->classes->first()->id)->count() }} Pertemuan
                        </p>
                    </div>
                </div>
                @endforeach
            @endcan
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
    