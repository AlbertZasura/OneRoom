@extends('Layout.SidePanel')

@section('title', 'Akun | OneRoom')

@section('content')
<div class="card-shadow bg-white m-lg-5 border-radius-8px" style="width: auto; height: auto;">
    <div class="card-body p-5">
    <h1>Daftar Akun</h1>
    <div class="row g-2">
        <div class="col-md-2">
            <select class="form-select" id = "filterTable" oninput="selectTable()" aria-label="Default select example">
                <option value="">Semua Jabatan</option>
                <option value="teacher">teacher</option>
                <option value="student">student</option>
            </select>
        </div>
        
        <div class="col-md-3">
            <form action="/accounts">
                <div class="input-group" style="width:300px">
                    <input type="text" id="myInput" class="form-control" placeholder="Cari nama" name="search">
                    <button class="btn btn-outline-secondary" type="submit"><i class='fa fa-search '></i></button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover" id="tableSearch">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Akun</th>
                    <th scope="col">Tanggal Daftar</th> 
                    <th scope="col">Jabatan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>   
        
        <tbody id = "myTable">
        @foreach ($users as $key => $user )
                <tr class='clickable-row' >
                    <td>
                        <a>{{ $key+1}}</a>
                    </td>
                    <td>
                        <a>{{ $user->name }}</a>
                    </td>
                    <td>
                        <a>{{ $user->created_at->format('d M Y') }}</a> 
                    </td>
                    <td>
                        <a>{{ $user->humanizeRole() }}</a>
                    </td>
                    <td>
                        <div class="d-flex">
                            <form action="{{ route('users.update', $user->id) }}" onsubmit="acceptUserBtn(event)" id="acceptUser" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn" type="submit" ><i class="fas fa-check fa-lg" style="color:green"></i></button>
                            </form>
                            <form action="{{  route('users.destroy',$user->id) }}" onsubmit="deleteUserBtn(event)" id="deleteUser" method="POST">
                                @csrf
                                @method('DELETE')      
                                <button class="btn" type="submit" ><i class="fas fa-times fa-lg" style="color:red"></i></button>
                            </form>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-fill-green rounded-pill" id= "myButton" type="button" data-bs-toggle="modal" data-bs-target="#modal{{$user->id}}">Lihat Detail</button>
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
                                <input type="text" name="role" class="form-control" id="role" value="{{ $user->humanizeRole() }}" readonly>
                            </div>
                            
                    </div>
                </div>
                
                @endforeach
            </tbody>   
        </table>
    </div>
    
    {{ $users->links() }}
    </div>
</div> 

<script>
    // $(document).ready(function(){
    //     $("#myInput").on("keyup", function() {
    //         var value = $(this).val().toLowerCase();
    //         $("#myTable tr").filter(function() {
    //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //         });
    //     });
    // });

    function acceptUserBtn(e){
            e.preventDefault();
            var form = document.getElementById("acceptUser")
            Swal.fire({
                    title: `Terima Pengguna`,
                    text: "Apakah Anda yakin untuk menerima pengguna?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        
    }

    function deleteUserBtn(e){
            e.preventDefault();
            var form = document.getElementById("deleteUser")
            Swal.fire({
                    title: `Tolak Pengguna`,
                    text: "Apakah Anda yakin untuk menolak pengguna?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        
    }

    function selectTable() {
        let dropdown, filter;
        dropdown = document.getElementById("filterTable");
        filter = dropdown.value;
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(filter) > -1)
            });
    }

</script>
@endsection