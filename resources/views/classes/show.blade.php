
@extends('Layout.SidePanel')

@section('title', "$class->name")

@section('content')
    <h1>Class</h1>
    @foreach ($classes as $key => $c )
    <a href="{{route('classes.show',$c->id)}}">
        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$c->name}}</h5>
                <p class="card-text text-end"><small> {{$c->users->count()}} orang</small></p>
            </div>
        </div>
    </a>
    @endforeach
    <table class="table table-hover" style="width:250%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jabatan</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
