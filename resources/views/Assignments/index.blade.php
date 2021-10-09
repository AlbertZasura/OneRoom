
@extends('Assignments.course')

@section('title', 'Assignment Center')

@section('show')
    <div class="row">
        <div class="col-md-6">
            <form action="{{route('course.assignments.index',$course)}}">
                <select class="form-select" name="class">
                    @foreach ($course->classes as $key => $class )
                        @if (request()->get('class'))
                            <option {{(request()->get('class')==$class->id) ? "selected" : ""}} value="{{$class->id}}">{{$class->name}}</option>
                        @else
                            <option {{($key===0) ? "selected" : "" }} value="{{$class->id}}">{{$class->name}}</option>
                        @endif   
                    @endforeach
                </select>
                <button class="btn" type="submit">Search</button>
            </form>
        </div>
    </div>

    
    @can('user_list', App\Models\Classes::class )
        <div class="card">
            <a href="#" class="card-body btn btn-outline-dark">
                <i class='fa fa-plus '></i> Tambah Tugas
            </a>
        </div>
    @endcan

    @if ($assignments)
    @foreach ($assignments as $assignment )
    <div class="card">
        <div class="d-grid d-md-flex align-items-center">
            <i class='fs-25 fa fa-file-signature me-2'></i>
            <h5 class="card-title flex-grow-1">{{$assignment->title}}</h5>
            <a href="{{ route('classes.edit',$assignment->class->id) }}" class="btn"><i class='fs-25 fa fa-download'></i></a>
            @can('delete', $assignment )
            <form action="{{ route('course.assignments.destroy',[$course,$assignment]) }}" method="POST">
                            @csrf
                            @method('DELETE')      
                            <button class="btn" type="submit"><i class='fs-25 fa fa-trash text-danger'></i></button>
                        </form>
                        @endcan
                        <a href="{{route('course.assignments.show',[$course,$assignment])}}" class="m-1">{{$assignment->class->users->count()}} / {{$assignment->class->users->count()}}</a>
                    </div>
                </div>   
                @endforeach
    @endif
                {{-- @include('classes._create') --}}
   
@stop
