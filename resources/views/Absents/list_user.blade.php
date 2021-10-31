
@extends('Layout.SidePanel')

@section('title', 'Daftar Siswa')

@section('content')
    <h1>Daftar Absen Siswa Kelas {{ $schedule->class->name }}</h1> 
    <h5>Hari {{ \Carbon\Carbon::parse($schedule->date)->isoFormat('dddd, D MMMM Y') }}</h5>
    <h5>Mata Pelajaran: {{ $schedule->course->name }}</h5>
    <br>
    <form action="{{ route('absents.users',$schedule) }}">
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Nama Siswa" name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
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
                        <p>{{ $user->absent_schedule($schedule->id)->first() ? $user->absent_schedule($schedule->id)->first()->created_at->format('H:i') : "-" }} </p> 
                    </td>
                    <td>
                        <p> {{ $user->absent_schedule($schedule->id)->first() ? $user->absent_schedule($schedule->id)->first()->status : (now()->gte($schedule->date) ? "Tidak Hadir" : "-") }} </p> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop