@extends('Layout.SidePanel')

@section('title', "Jadwal Kelas {{ $class->name }}")

@section('content')
    <h1>Jadwal kelas {{ $class->name }}</h1>
    <br>
    <form action="/classes/{{$class->id}}/assign_user">
        <div class="row">
            <div class="col-md-2">
                <select class="form-select" name="role">
                    <option selected value="">Semua</option>
                    <option value="1">Guru</option>
                    <option value="2">Murid</option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Nama" name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row mb-2">
        <div class="col-md-6">
            <a data-bs-toggle="modal" data-bs-target="#createSchedules" class="btn btn-outline-dark">
                <i class='fa fa-plus '></i> Buat Jadwal Baru
            </a>
        </div>
    </div>    
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Hari</th>
                <th>Mata Pelajaran</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $key => $s )
                <tr>
                    <th>
                        <p>{{ $key+1 }}.</p> 
                    </th>
                    <td>
                        <p>{{ \Carbon\Carbon::parse($s->date)->isoFormat('dddd') }}</p> 
                    </td>
                    <td>
                        <p>{{ $s->course->name }}</p> 
                    </td>
                    <td>
                        <p>{{ $s->start_time}} - {{ $s->end_time}}
                        </p> 
                    </td>
                    <td>
                        <p>{{ $s->end_time }}</p> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('schedules._create')
@endsection