@extends('Layout.SidePanel')

@section('title', 'Jadwal | OneRoom')

@section('content')
    <div class="card-shadow bg-white m-lg-5 border-radius-8px">
        <div class="card-body p-lg-5">
            <h1>Jadwal</h1>
            <br>
            <div class="row mb-3">
                <div class="col-md-4">
                    <form action="/schedules/all">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari kelas" name="search" value="{{ request('search') }}">
                            <button class="btn btn-fill-green" type="submit"><i class='fa fa-search '></i></button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="table-responsive">
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
                                    <a class="btn btn-fill-green rounded-pill" href={{ route('classes.schedules.index',$c) }}>Lihat Jadwal</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
            
        </div>
    </div> 
@endsection
