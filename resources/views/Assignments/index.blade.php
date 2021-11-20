@extends('Assignments.course')

@section('title ', 'Tugas | OneRoom')

@section('show')
    <div class="card-shadow bg-white rounded-3">
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
                @include('assignments._create')
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
                <div class="row g-2">
                    @foreach ($assignments as $assignment)
                        <div class="card p-3">
                            <div class="d-grid d-md-flex align-items-center">
                                <i class='fs-25 fa fa-file-signature me-2'></i>
                                <h5 class="card-title me-auto">{{ $assignment->title }}</h5>
                                <h6 class="card-title ms-auto {{ now()->gte($assignment->deadline) ? 'text-danger' : 'text-success' }}"> Deadline {{ $assignment->deadline }}</h6>
                                <a href="{{ route('assignments.download', $assignment->id) }}?type=question" class="btn ms-auto"><i class='fs-25 fa fa-download'></i></a>
                                @can('delete', $assignment)
                                    <form action="{{ route('course.assignments.destroy', [$course, $assignment]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn" type="submit" onclick="return confirm('Apakah Anda yakin untuk menghapus tugas {{ $assignment->title }}?')"><i class='fs-25 fa fa-trash text-danger'></i></button>
                                    </form>
                                @endcan
                                @can('upload', App\Models\Assignment::class)
                                    @if (now()->lt($assignment->deadline))
                                        <a data-bs-toggle="modal" data-bs-target="#uploadAssignments{{ $assignment->id }}"
                                            class="btn"><i class='fs-25 fa fa-upload '></i></a>
                                        @include('assignments._upload')
                                    @elseif (now()->gte($assignment->deadline))
                                        @php($userAssignment = $assignment->users()->where('users.id', Auth::user()->id)->latest()->first())
                                        @if (!empty($userAssignment) && !is_null($userAssignment->pivot->score))
                                            <h1 class="btn fs-25 {{($assignment->kkm() > $userAssignment->pivot->score) ? 'text-danger' : 'text-success'}}"> {{ $userAssignment->pivot->score }} </h1>
                                        @else
                                            <h1 class="text-danger m-0">- </h1>
                                        @endif
                                    @endif
                                @endcan
                                @can('view', $assignment)
                                    <a href="{{ route('course.assignments.show', [$course, $assignment]) }}"class="m-1 btn">
                                        {{ $assignment->users->count() }} / {{ $assignment->class->students->count() }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h3 class="text-center">Tidak ada Tugas</h3>
            @endif
        </div>
    </div>
@stop
