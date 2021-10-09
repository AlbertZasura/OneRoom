@extends('Layout.SidePanel')

@section('title', 'Accounts Center')

@section('content')
    <h1>Akun</h1>
   
    @if (Auth::user())
    <form action="/logout" method="POST">   
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    @else
    <a class="btn btn-info" href="/login">Login</a>  
    @endif
   
    <table>
        <tr>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Jabatan
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Semua jabatan</a>
                        <a class="dropdown-item" href="#">Guru</a>
                        <a class="dropdown-item" href="#">Siswa</a>
                    </div>
                </div>
            </td>
            
            <td>
                <div class="input-group rounded"  style="width:300px"> 
                    <input type="search" class="form-control rounded" placeholder="Cari nama" aria-label="Search"
                    aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </td>
            
        </tr>
    </table>
    
    
        <table class="table table-hover" style="width:150%">
        <thead>
            <tr>
            <th scope="col">Nama Akun</th>
            <th scope="col">Tanggal Daftar</th>
            <th scope="col">jabatan</th>
            <th></th>
            <th></th>
            </tr>
        </thead>   
        
        <tbody>
        @foreach ($users as $key => $user )
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
                    <td>
                        <a href=""><i class="fas fa-check fa-lg" style="color:green"></i></a>
                    </td>
                    <td>
                        <a href=""><i class="fas fa-times fa-lg" style="color:red"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
    

       
<script>
     $(document).ready(function(){
        $('.btn btn-primary dropdown-toggle').dropdown()
    });
</script>

@stop