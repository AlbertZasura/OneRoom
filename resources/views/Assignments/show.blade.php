
@extends('Layout.SidePanel')

@section('title', "$assignment->title")

@section('content')
    
    <h1>Tugas</h1>
    <div class="d-grid d-md-flex align-items-center p-3">
        <i class='fs-25 fa fa-file-signature me-2'></i>
        <nav style="--bs-breadcrumb-divider: '>';" class="me-auto" aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{route('course.assignments.index',$course)}}">{{$assignment->course->name}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('course.assignments.index',$course)}}">{{$assignment->class->name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$assignment->title}}</li>
            </ol>
        </nav>
        <p class="ms-auto {{(now()->gte($assignment->deadline)) ? "text-danger" : "text-success"}}">{{$assignment->deadline}}</p>
        <a href="{{ route('assignments.download',$assignment->id) }}" class="btn ms-auto"><i class='fs-25 fa fa-download'></i></a>
        @can('delete', $assignment )
            <form action="{{ route('course.assignments.destroy',[$course,$assignment]) }}" method="POST">   
                @csrf
                @method('DELETE')      
                <button class="btn" type="submit"><i class='fs-25 fa fa-trash text-danger'></i></button>
            </form>
        @endcan
        <p class="m-1">{{$assignment->class->users->count()}} / {{$assignment->class->users->count()}}</p>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Tanggal Submit</th>
                <th>Notes</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assignment->class->users as $key => $user )
                <tr>
                    <th>
                        <p>{{ $key+1 }}.</p> 
                    </th>
                    <td>
                        <p>{{ $user->name }}</p> 
                    </td>
                    <td>
                        <p>{{ $user->role }}</p> 
                    </td>
                    <td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
