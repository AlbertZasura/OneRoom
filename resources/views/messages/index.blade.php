
@extends('Layout.SidePanel')

@section('title', 'Pengumuman | OneRoom')

@section('content')
<div class="card-shadow bg-white m-lg-5 border-radius-8px" style="width: auto; height: auto;">
    <div class="card-body p-lg-5">
    <h1>Pengumuman</h1>
    @can('create', App\Models\Message::class )
        <br>
        <button class="btn btn-outline-secondary" id="open-popup" ><i class="fas fa-plus"></i></i>&nbsp Tambah Pengumuman</button>
    @endcan
    
    <div class="table-responsive mt-4">
        <table class="table table-hover">
            <thead>
            <tr>
                    <th scope="col">Waktu</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Pengirim</th> 
                    <th scope="col">Tanggal</th>
                    @can('create', App\Models\Message::class )
                    <th scope="col">Aksi</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $key => $message )
                    <tr>
                        <td>
                            <a>{{ $message->created_at->format('H:i') }}</a> 
                        </td>
                        <td style="width:20%">
                            <a>{{ $message->title }}</a>
                        </td>
                        <td>
                            <a>{{ $message->user->name }}</a>
                        </td>
                        <td>
                            <a>{{  \Carbon\Carbon::parse($message->created_at)->isoFormat('D MMMM Y')  }}</a>
                        </td>
                        @can('create', App\Models\Message::class )
                        <td>
                            <form action="{{  route('messages.destroy',$message->id) }}" onsubmit="deleteAnnouncementBtn(event)" id="deleteAnouncementForm"  method="POST" >
                                @csrf
                                @method('DELETE')      
                                <button class="btn" type="submit" ><i class="fas fa-times fa-lg" style="color:red"></i></button>
                            </form>
                        </td>
                        @endcan
                        <td>
                            <a class="btn btn-fill-green rounded-pill" role="button" id= "myButton" type="button"  href="{{ route('messages.show',$message->id) }}">Lihat Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {{ $messages->links() }}
    </div>
</div>

<form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
@csrf
   <x-pop-up>
   <div>
        <div class="">
            <div class="">
            <div class="">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumuman</h5>
               
            </div>
            <div class="modal-body">
                <form>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label"><b>Judul</b></label>
                    <input type="text" name="title" class="form-control form-input-color" id="title" value="{{old('title')}}" required>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label"><b>Isi</b></label>
                    <textarea class="form-control form-input-color" name="content" id="content" value="{{old('content')}}"  required></textarea>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label"><b>File</b></label>
                    <input class="form-control" name="file" type="file" id="file" >
                </div>
                </form>
            </div>
            <div class="d-flex justify-content-end">
            <button id="action-closes-popup" class="btn btn-outline-green rounded-pill">Batal</button>
            <button class="btn btn-fill-green rounded-pill" type="submit" id="action-submit-popup">Simpan</button>
            </div>
            </div>
        </div>
    </div>
   </x-pop-up>
</form>

<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });

    function deleteAnnouncementBtn(e){
            e.preventDefault();
            var form = document.getElementById("deleteAnouncementForm")
            Swal.fire({
                    title: `Hapus Pengumuman`,
                    text: "Apakah Anda yakin untuk menghapus pengumuman?",
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

</script>
@stop
