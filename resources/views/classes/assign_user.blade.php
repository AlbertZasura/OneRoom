
@extends('Layout.SidePanel')

@section('title', 'Tambah Anggota')

@section('content')
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
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin untuk menambahkan {{ $user->name }} ke dalam kelas?')">Tambahkan</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop