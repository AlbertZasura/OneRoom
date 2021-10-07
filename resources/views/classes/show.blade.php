
@extends('classes.index')

@section('title', "$class->name")

@section('show')
    @can('create', App\Models\Classes::class )
        <a href="/classes/{{$class->id}}/assign_user">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Tambah Anggota</h5>
                </div>
            </div>
        </a>
    @endcan
    <table class="table table-hover" style="width:250%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($class->users as $key => $user )
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
                        <form action="/classes/{{$class->id}}/assign_user/{{$user->id}}?type=detach" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Keluarkan</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
