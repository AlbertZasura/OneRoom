
@extends('Layout.SidePanel')

@section('title', 'Pengumuman | OneRoom')

@section('content')
<div class="card-shadow bg-white m-lg-5 border-radius-8px" style="width: auto; height: auto;">
    <div class="card-body p-5">
    <h1>Pengumuman</h1>
    <br>
    <br>
    @can('create', App\Models\Message::class )
        <button class="btn btn-outline-secondary" id="open-popup" ><i class="fas fa-plus"></i></i>&nbsp Tambah Pengumuman</button>
    @endcan
    
    <div class="table-responsive">
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
                    <tr class='clickable-row' data-href="{{ route('messages.show',$message->id) }}">
                        <td>
                            <a>{{ $message->created_at->format('H:i') }}</a> 
                        </td>
                        <td style="width:30%">
                            <a>{{ $message->title }}</a>
                        </td>
                        <td>
                            <a>{{ $message->user->name }}</a>
                        </td>
                        <td>
                            <a>{{ $message->created_at->format('d M Y') }}</a>
                        </td>
                        @can('create', App\Models\Message::class )
                        <td>
                            <form action="{{  route('messages.destroy',$message->id) }}" method="POST">
                                @csrf
                                @method('DELETE')      
                                <button class="btn" type="submit" onclick="return confirm('Apakah Anda yakin untuk menghapus pengumuman?')"><i class="fas fa-times fa-lg" style="color:red"></i></button>
                            </form>
                        </td>
                        @endcan
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
</script>
@stop
