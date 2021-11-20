
@extends('Layout.SidePanel')

@section('title', "Tugas {$assignment->title} | OneRoom")

@section('content')
    <div class="card-shadow bg-white">
        <div class="card-body">
        <h1>Tugas</h1>
        @if (now()->lt($assignment->deadline))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <strong>Note!</strong>  Setelah melewati batas waktu, Anda dapat memberikan nilai tugas !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card" >
        <div class="d-grid d-md-flex align-items-center p-3">
            <i class='fs-25 fa fa-file-signature me-2'></i>
            <nav style="--bs-breadcrumb-divider: '>';" class="me-auto" aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('course.assignments.index',$course)}}">{{$assignment->course->name}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('course.assignments.index',$course)}}?class={{$assignment->class_id}}">{{$assignment->class->name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$assignment->title}}</li>
                </ol>
            </nav>
            <p class="ms-auto {{(now()->gte($assignment->deadline)) ? "text-danger" : "text-success"}}">{{$assignment->deadline}}</p>
            <a href="{{ route('assignments.download',$assignment->id) }}?type=question" class="btn ms-auto"><i class='fs-25 fa fa-download'></i></a>
            <form action="{{ route('course.assignments.destroy',[$course,$assignment]) }}" method="POST">   
                @csrf
                @method('DELETE')      
                <button class="btn" type="submit" onclick="return confirm('Apakah Anda yakin untuk menghapus tugas {{ $assignment->title }} ?')"><i class='fs-25 fa fa-trash text-danger'></i></button>
            </form>
            <p class="m-1">{{$assignment->users->count()}} / {{$assignment->class->students->count()}}</p>
        </div>
        </div>
        </div>
        <div class="d-grid d-md-flex align-items-center p-3">
            <a href="{{ route('assignments.export',$assignment->id) }}" class="ms-auto btn btn-fill-green rounded-pill">Export Excel</a>
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
                @foreach ($users as $key => $user )
                    <tr>
                        <th>
                            <p>{{ $key+1 }}.</p> 
                        </th>
                        <td>
                            <p>{{ $user->name }}</p> 
                        </td>
                        <td>
                            <p>{{ $user->pivot->created_at }}</p> 
                        </td>
                        <td>
                            <p>{{ $user->pivot->notes }}</p> 
                        </td>
                        <td>
                            <div class="align-item-center">
                                <a href="{{ route('assignments.download',$assignment->id) }}?type=answer&u={{$user->id}}&t={{$user->pivot->created_at}}" class="btn"><i class='fs-25 fa fa-download'></i></a>
                                @if ($user->pivot->score)
                                    <h4 class="d-inline-block {{($assignment->kkm() > $user->pivot->score) ? 'text-danger' : 'text-success'}}">{{ $user->pivot->score }}</h4> 
                                @else
                                    @if(now()->gte($assignment->deadline))
                                        <a data-bs-toggle="modal" data-bs-target="#scoringAssignments{{$user->id}}" class="btn"><i class='fs-25 fa fa-plus '></i></a>
                                        @include('assignments._scoring')
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
        </div>
    </div>
@stop
