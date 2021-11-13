
@extends('Layout.SidePanel')

@section('title', 'Messages Center')

@section('content')
    <h1>Pengumuman</h1>
    <br>
    <br>
    @can('create', App\Models\Message::class )
        <button class="btn btn-outline-dark" id="open-popup" ><i class="fas fa-plus-circle"></i>&nbspTambah Pengumuman</button>
    @endcan
    
    <table class="table table-hover" style="width:75%">
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
    {{ $messages->links() }}

<form action="{{ route('messages.store') }}" method="POST">
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
                    <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" required>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label"><b>Isi</b></label>
                    <textarea class="form-control" name="content" id="content" value="{{old('content')}}"  required></textarea>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label"><b>File</b></label>
                    <input class="form-control" name="file" type="file" id="file" >
                </div>
                </form>
            </div>
            <div class="d-flex justify-content-end">
            <button id="action-closes-popup">Cancel</button>
            <button type="submit"  id="action-submit-popup">Submit</button>
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
