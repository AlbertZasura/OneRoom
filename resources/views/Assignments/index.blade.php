@extends('Assignments.course')

@section('title ', 'Tugas | OneRoom')

@section('show')
    <div class="card-shadow bg-white rounded-3">
        <div class="show-on-mobile">
            <div class="d-flex a-center mobile-mb-20">
                <i class="fas fa-arrow-left mr-10 fs-20" onclick="window.history.go(-1); return false;"></i>
                <h1 class="mobile-mb-0">Tugas</h1>
            </div>
        </div>
        <div class="card-body">
            @can('create', App\Models\Assignment::class)
                <form action="{{ route('course.assignments.index', $course) }}" class="row mb-3">
                    <div class="col-md-6">
                        <select class="form-select" name="class" id="filterClass" oninput="filterByClass()">
                            @foreach ($classes as $key => $class)
                                @if (request()->get('class'))
                                    @php( request()->get('class') == $class->id ? $selectedClasses = $class : 'null')
                                    <option {{ request()->get('class') == $class->id ? 'selected' : '' }} value="{{ $class->id }}">
                                        {{ $class->name }}</option>
                                @else
                                    @php($selectedClasses = $classes->first())
                                    <option {{ $key === 0 ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-fill-green">
                            <i class='fa fa-search'></i> Cari
                        </button>
                    </div>
                </form>

                <a data-bs-toggle="modal" data-bs-target="#createAssignments" class="btn btn-outline-green mb-3 ">
                    <i class='fa fa-plus '></i> Tambah Tugas
                </a>
                @include('Assignments._create')
            @endcan

            @if (!$assignments->isEmpty())
                @can('upload', App\Models\Assignment::class)
                    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <strong>Note!</strong>  Setelah melewati batas waktu, Anda tidak dapat mengumpulkan file tugas !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endcan
                   
                    <div class="table-responsive-lg">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Tugas</th>
                                    <th scope="col">Tenggat waktu</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($assignments as $assignment)
                                <tr>
                                    <td>
                                        <h5 class="card-title me-auto">{{ $assignment->title }}</h5>
                                    </td>
                                    <td>
                                        <h6 class="card-title ms-auto {{ now()->gte($assignment->deadline) ? 'text-danger' : 'text-success' }}">{{  \Carbon\Carbon::parse($assignment->deadline)->isoFormat('dddd, D MMMM Y H:mm')  }}</h6>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start a-center">
                                            <a href="{{ route('assignments.download', $assignment->id) }}?type=question" class="btn"><i class='fs-25 fa fa-download'></i></a>
                                            @can('delete', $assignment)
                                                <form action="{{ route('course.assignments.destroy', [$course, $assignment]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn" type="submit" onclick="return confirm('Apakah Anda yakin untuk menghapus tugas {{ $assignment->title }}?')"><i class='fs-25 fa fa-trash text-danger'></i></button>
                                                </form>
                                            @endcan
                                            @can('upload', App\Models\Assignment::class)
                                            @php($userAssignment = $assignment->users()->where('users.id', Auth::user()->id)->latest()->first())
                                            <a data-bs-toggle="modal" data-bs-target="#assignments{{ $assignment->id }}History" class="btn"><i class='fs-25 fas fa-history'></i></a>
                                            @include('Assignments._history')
                                            @if (now()->lt($assignment->deadline))
                                                <a data-bs-toggle="modal" data-bs-target="#uploadAssignments{{ $assignment->id }}"
                                                    class="btn"><i class='fs-25 fa fa-upload '></i></a>
                                                @include('Assignments._upload')
                                            @elseif (now()->gte($assignment->deadline))
                                                @if (!empty($userAssignment) && !is_null($userAssignment->pivot->score))
                                                    <h1 class="btn m-0 fs-25 {{($assignment->kkm() > $userAssignment->pivot->score) ? 'text-danger' : 'text-success'}}"> {{ $userAssignment->pivot->score }} </h1>
                                                @else
                                                    <h1 class="btn fs-25 text-danger m-0">- </h1>
                                                @endif
                                            @endif
                                            
                                            @endcan
                                            @can('view', $assignment)
                                                <a href="{{ route('course.assignments.show', [$course, $assignment]) }}"class="m-1 btn btn-outline-green rounded-pill px-20px">
                                                    {{ $assignment->users->count() }} / {{ $assignment->class->students->count() }} 
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>                  
            @else
                <h3 class="text-center">Tidak ada Tugas</h3>
            @endif
        </div>
    </div>
@stop
