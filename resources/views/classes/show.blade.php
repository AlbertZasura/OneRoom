
@extends('classes.index')

@section('title', "$class->name")

@section('show')
    <div class="d-flex align-items-center">
        <h1 class="text-uppercase">{{$class->name}}</h1>
        {{-- @can('update',$class )
            <a href="{{ route('classes.edit',$class->id) }}" class="btn"><i class='fs-25 fa fa-pencil text-primary'></i></a>
        @endcan --}}
        @can('delete', $class )
            <form action="{{ route('classes.destroy',$class) }}" method="POST">   
                @csrf
                @method('DELETE')      
                <button class="btn" type="submit"><i class='fs-25 fa fa-trash text-danger'></i></button>
            </form>
        @endcan
    </div>
    @can('user_list', App\Models\Classes::class )
        <div class="card mb-1">
            <a href="/classes/{{$class->id}}/assign_user" class="card-body btn btn-outline-dark">
                <i class='fa fa-plus '></i> Tambah Anggota
            </a>
        </div>
    @endcan
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Aksi</th>
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
