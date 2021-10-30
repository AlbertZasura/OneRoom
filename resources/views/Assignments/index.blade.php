@extends('Assignments.course')

@section('title', 'Assignment Center')

@section('show')
    
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
                <button type="submit" class="btn btn-outline-dark">
                    <i class='fa fa-search'></i> Cari
                </button>
            </div>
        </form>

        <div class="card mb-3">
            <a data-bs-toggle="modal" data-bs-target="#createAssignments" class="card-body btn btn-outline-dark">
                <i class='fa fa-plus '></i> Tambah Tugas
            </a>
        </div>
        @include('assignments._create')
    @endcan

    @if (!$assignments->isEmpty())
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
                        @php($userAssignment = $assignment->users()->where('users.id', Auth::user()->id)->latest()->first())
                        @if (now()->lt($assignment->deadline) && empty($userAssignment))
                            <a data-bs-toggle="modal" data-bs-target="#uploadAssignments{{ $assignment->id }}"
                                class="btn"><i class='fs-25 fa fa-upload '></i></a>
                            @include('assignments._upload')
                        @else
                            @if (!empty($userAssignment) && !is_null($userAssignment->pivot->score))
                                <h1 class="btn fs-25 {{($assignment->kkm > $userAssignment->pivot->score) ? 'text-danger' : 'text-success'}}"> {{ $userAssignment->pivot->score }} </h1>
                            @else
                                <h1 class="btn fs-25 text-danger"> - </h1>
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
    @else
        <h3 class="text-center">Tidak ada Tugas</h3>
    @endif

@stop
