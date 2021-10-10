
@extends('Assignments.course')

@section('title', 'Assignment Center')

@section('show')
    <form action="{{route('course.assignments.index',$course)}}" class="row mb-3">
        <div class="col-md-6">
            <select class="form-select" name="class" id="filterClass" oninput="filterByClass()">
                @foreach ($course->classes as $key => $class )
                    @if (request()->get('class'))
                        <option {{(request()->get('class')==$class->id) ? "selected" : ""}} value="{{$class->id}}">{{$class->name}}</option>
                    @else
                        <option {{($key===0) ? "selected" : "" }} value="{{$class->id}}">{{$class->name}}</option>
                    @endif   
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button  type="submit" class="btn btn-outline-dark">
                <i class='fa fa-search'></i> Cari 
            </a>
        </div>
    </form>

    @can('user_list', App\Models\Classes::class )
        <div class="card mb-3">
            <a data-bs-toggle="modal" data-bs-target="#createAssignments" class="card-body btn btn-outline-dark">
                <i class='fa fa-plus '></i> Tambah Tugas
            </a>
        </div>
    @endcan

    @if ($assignments)
        @foreach ($assignments as $assignment )
            <div class="card p-3">
                <div class="d-grid d-md-flex align-items-center">
                    <i class='fs-25 fa fa-file-signature me-2'></i>
                    <h5 class="card-title me-auto">{{$assignment->title}}</h5>
                    <h6 class="card-title ms-auto {{(now()->gte($assignment->deadline)) ? "text-danger" : "text-success"}}">{{$assignment->deadline}}</h6>
                    
                    <a href="{{ route('assignments.download',$assignment->id) }}" class="btn ms-auto"><i class='fs-25 fa fa-download'></i></a>
                    @can('delete', $assignment )
                        <form action="{{ route('course.assignments.destroy',[$course,$assignment]) }}" method="POST">
                            @csrf
                            @method('DELETE')      
                            <button class="btn" type="submit"><i class='fs-25 fa fa-trash text-danger'></i></button>
                        </form>
                    @endcan
                    <a href="{{route('course.assignments.show',[$course,$assignment])}}" class="m-1 btn">{{$assignment->class->users->count()}} / {{$assignment->class->users->count()}}</a>
                </div>
            </div>   
        @endforeach
    @endif

    @include('assignments._create')
@stop
