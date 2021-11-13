@extends('Layout.SidePanel')
@section('title', " Kelas | OneRoom")

@section('content')
    <div class="d-flex align-items-center">
        <h1 class="text-uppercase">Kelas {{$class->name}}</h1>
    </div>
    <div class="d-flex">
        <div class="w-200px">
            @if (Auth::user()->role === "teacher")
                {{-- @can('create', App\Models\Classes::class ) --}}
                <form action="{{route('absents.store')}}" method="POST">
                    @csrf
                    <div class="card">
                        <input type="text" name="class_id" value="{{ $class->id }}" class="form-control" id="class_id" hidden>
                        <input type="number" name="course_id" value="1" class="form-control" id="course_id" hidden>
                        <button type="submit" class="btn btn-primary"> <i class='fa fa-user-check '></i> Absen</button>
                    </div>
                </form>
                {{-- @endcan --}}
           @endif
           @if (Auth::user()->role === "student")
            <form action="{{route('absents.store')}}" method="POST">
                    @csrf
                    <div class="card">
                        <input type="text" name="class_id" value="{{ $class->id }}" class="form-control" id="class_id" hidden>
                        <input type="number" name="course_id" value="1" class="form-control" id="course_id" hidden>
                        <button type="submit" class="btn btn-primary"> <i class='fa fa-user-check '></i> Absen</button>
                    </div>
                </form>
            @endif
        </div>
        <div class="ml-20 w-85">
           test
        </div>
    </div>
@endsection
