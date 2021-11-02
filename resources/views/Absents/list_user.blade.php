
@extends('Layout.SidePanel')

@section('title', 'Daftar Siswa')

@section('content')
    @can('isTeacher')
        <h1>{{ "Daftar Absen Siswa Kelas ".$schedule->class->name }}</h1> 
        <h5>Hari {{ \Carbon\Carbon::parse($schedule->date)->isoFormat('dddd, D MMMM Y') }}</h5>
        <h5>Mata Pelajaran: {{ $schedule->course->name }}</h5>
    @endcan
    @can('isAdmin')
        <h1>Daftar Absen Guru</h1>
    @endcan
    <br>
    <form action="{{ route('absents.users') }}">
        @if ($role==="teacher")
            <input type="hidden" name="schedule" value="{{ $schedule->id }}">
        @endif
        <div class="row mb-3">
            @can('isAdmin')
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}" id="date">
                    </div>
                </div>
            @endcan
            <div class="col-md-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Nama {{ $role==="teacher" ? "Siswa" : "Guru" }}" name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </div>
            <div class="col-md-1">
                <div class="input-group mb-3">
                    <a href="{{ route('absents.export') }}?date={{ request('date') }}&search={{ request('search') }}&schedule={{ request('schedule') }}" class="btn btn-primary rounded-pill">Export Excel</a>
                </div>
            </div>
        </div>
    </form>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama {{ $role==="teacher" ? "Siswa" : "Guru" }}</th>
                <th>Jam</th>
                <th>Status</th>
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
                        @if ($role==="teacher")
                            <p>{{ $user->absent_schedule($schedule->id)->first() ? $user->absent_schedule($schedule->id)->first()->created_at->format('H:i') : "-" }} </p> 
                        @else
                            <p>{{ $user->check_absent(request('date'))?$user->check_absent(request('date'))->created_at->format('H:i'):'-'}}</p>
                        @endif
                    </td>
                    <td>
                        @if ($role==="teacher")
                            <p> {{ $user->absent_schedule($schedule->id)->first() ? $user->absent_schedule($schedule->id)->first()->status : (now()->gte($schedule->date) ? "Tidak Hadir" : "-") }} </p> 
                        @else
                            <p>{{ $user->check_absent(request('date'))?$user->check_absent(request('date'))->status:(now()->gte(request('date')) ? "Tidak Hadir" : "-")}}</p>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@stop