@extends('Layout.SidePanel')

@section('title', 'Schedule')

@section('content')
    <h1>Jadwal</h1>
    <br>
    <div class="row mb-3">
        <div class="col-md-6">
            <form action="/schedules/all">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari kelas" name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <th>No.</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach ($classes as $key => $c )
                <tr>
                    <th>{{ $key+1 }}</th>
                    <td>{{ $c->name }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href={{ route('classes.schedules.index',$c) }}>Lihat Jadwal</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>    
@endsection
