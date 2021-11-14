
@extends('Layout.SidePanel')

@section('title', 'Tambah Anggota Kelas | OneRoom')

@section('content')
    <div class="card-shadow bg-white">
        <div class="card-body">
            <h1>Daftar Anggota Sekolah</h1>    
            <br>
            <form action="/classes/{{$class->id}}/assign_user">
                <div class="row mb-3">
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
                            <button class="btn btn-outline-green" type="submit"><i class='fa fa-search '></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Action</th>
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
                                <p>{{ $user->role }}</p> 
                            </td>
                            <td>
                                <form action="/classes/{{$class->id}}/assign_user/{{$user->id}}?type=attach" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-green rounded-pill" onclick="return confirm('Apakah Anda yakin untuk menambahkan {{ $user->name }} ke dalam kelas?')">Tambahkan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
@stop