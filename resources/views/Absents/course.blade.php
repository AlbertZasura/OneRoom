
@extends('Layout.SidePanel')

@section('title', 'Class')

@section('content')
    <h1>Absen</h1>
    @if ($courses->isEmpty())
        <div class="mt-5">
            <h3>Silahkan hubungi admin sekolah, untuk menempatkan Anda di salah satu kelas!</h3>
        </div>    
    @else
        <div class="d-flex">
            <div class="w-200px">
                @can('viewAny', App\Models\Absent::class )
                    @foreach ($courses as $course )
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{$course->name}}</h5>
                            <a href="{{route('course.absents.index',$course)}}" class="stretched-link"></a>
                            <p class="card-text text-end">
                                {{ App\Models\Schedule::where('course_id',$course->id)->where('class_id',Auth::user()->classes->first()->id)->count() }} Pertemuan
                            </p>
                        </div>
                    </div>
                    @endforeach
                @endcan
            </div>
            <div class="ml-20 w-85">
                @yield('show')
            </div>
        </div>
    @endif
@endsection
    