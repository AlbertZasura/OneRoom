@extends('Layout.SidePanel')

@section('title', 'Accounts')

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
                
                <select class="form-select" id = "filterTable" oninput="selectTable()" aria-label="Default select example">
                    <option value="">Semua jabatan</option>
                    <option value="teacher">teacher</option>
                    <option value="student">student</option>
                </select>
            </td>
            
            <td>
                <div class="input-group rounded" style="width:300px"> 
                    <input type="text" id="myInput" class="form-control rounded" placeholder="Cari nama" aria-label="Search"
                    aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </td>
            
        </tr>
    </table>
    
    
        <table class="table table-hover table-responsive" id="tableSearch"  style="width:75%">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Akun</th>
            <th scope="col">Tanggal Daftar</th> 
            <th scope="col">Jabatan</th>
            <th></th>
            <th></th>
            </tr>
        </thead>   
        
        <tbody id = "myTable">
        @foreach ($users as $key => $user )
                <tr class='clickable-row' data-bs-toggle="modal" data-bs-target="#modal{{$user->id}}" >
                    <td>
                        <a>{{ $key+1}}</a>
                    </td>
                    <td>
                        <a>{{ $user->name }}</a>
                    </td>
                    <td>
                        <a>{{ $user->created_at->format('d M Y') }}</a> 
                    </td>
                    <td style="width:20%">
                        <a>{{ $user->role }}</a>
                    </td>
                    <td>
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn" type="submit"><i class="fas fa-check fa-lg" style="color:green"></i></button>
                        </form>
                    </td>
                    <td>
                        <form action="{{  route('users.destroy',$user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')      
                            <button class="btn" type="submit"><i class="fas fa-times fa-lg" style="color:red"></i></button>
                        </form>
                    </td>
                </tr>

                
                <div class="modal fade" id="modal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" >
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >Detail Informasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label"><b>Nama</b></label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label"><b>Nomor Induk</b></label>
                                <input type="text" name="identification_number" class="form-control" id="identification_number" value="{{ $user->identification_number }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label"><b>Nomor Handphone</b></label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{ $user->phone }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label"><b>Email</b></label>
                                <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label"><b>Jabatan</b></label>
                                <input type="text" name="role" class="form-control" id="role" value="{{ $user->role }}" readonly>
                            </div>
                            
                    </div>
                </div>
                
                @endforeach
            </tbody>   
        </table>
        <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
            </nav>

       

<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function selectTable() {
        let dropdown, filter;
        dropdown = document.getElementById("filterTable");
        filter = dropdown.value;
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(filter) > -1)
            });
    }

</script>
@stop