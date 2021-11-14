
@extends('Layout.SidePanel')

@section('title', 'Tugas | OneRoom')

@section('content')
    <h1>Tugas</h1>
    @if ($courses->isEmpty())
        <div class="mt-5">
            <h3>Silahkan hubungi admin sekolah, untuk menempatkan Anda di salah satu kelas!</h3>
        </div>    
    @else
        <div class="d-flex">
            <div class="w-200px">
                @foreach ($courses as $c )
                <div class="card {{ (isset($course) && $course->id===$c->id) ? "bg-biru-muda color-hijau-tua"  : "bg-hijau-tua text-white" }} mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$c->name}}</h5>
                        <a href="{{route('course.assignments.index',$c)}}" class="stretched-link"></a>
                        <p class="card-text text-end"><small> {{$c->classAssignments(Auth::user()->classes->pluck('id'))->count()}} Tugas</small></p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="ml-20 w-85">
                @yield('show')
            </div>
        </div>
    @endif
@endsection
    