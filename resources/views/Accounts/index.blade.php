@extends('Layout.SidePanel')

@section('title', 'Accounts Center')

@section('content')
    <h1>Akun</h1>
    @foreach ($users as $key => $user )
    
        <table class="table table-hover" style="width:100%">
        <thead>
            <tr>
            <th scope="col">Nama Akun</th>
            <th scope="col">Tanggal Daftar</th>
            <th scope="col">Role</th>
            </tr>
        </thead>   
        
        <tbody>
                <tr class='clickable-row' data-href="{{ route('users.show', $user->id) }}">
                    <td>
                        <a>{{ $user->name }}</a>
                    </td>
                    <td>
                        <a>{{ $user->created_at->format('d M Y') }}</a> 
                    </td>
                    <td style="width:30%">
                        <a>{{ $user->role }}</a>
                    </td>
                </tr>
                
            </tbody>
        </table>
    @endforeach
   

@stop