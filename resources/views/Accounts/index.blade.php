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
    
    
        <table class="table table-hover" id="tableSearch"  style="width:75%">
        <thead>
            <tr>
            <th scope="col">Nama Akun</th>
            <th scope="col">Tanggal Daftar</th>
            <th scope="col">Jabatan</th>
            <th></th>
            <th></th>
            </tr>
        </thead>   
        
        <tbody id = "myTable">
        @foreach ($users as $key => $user )
                <tr class='clickable-row'  id="open-popup">
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

    <x-pop-up>
        <div>
            <div class="">
                <div class="">
                <div class="">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Informasi </h5>
                
                </div>
                <div class="modal-body">
                    <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label"><b>Nama</b></label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label"><b>Nomor Induk</b></label>
                        <input class="form-control" name="identification_number" id="identification_number" value="{{old('identification_number')}}"  required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label"><b>Nomor Handphone</b></label>
                        <input class="form-control" name="phone"  id="phone" value="{{old('phone')}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label"><b>Email</b></label>
                        <input class="form-control" name="email" id="email" value="{{old('email')}}" required>
                    </div>
                    </form>
            </div>
        </div>
   </x-pop-up> 

       

<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            //window.location = $(this).data("href");
        });
    });

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