
@extends('Layout.SidePanel')

@section('title', 'Messages Center')

@section('content')
    <h1>Pengumuman</h1>
    
    @can('create', App\Models\Message::class )
        <a class="btn btn-outline-dark" id="open-popup" >Tambah Pengumuman</a> 
    @endcan
    
    @foreach ($messages as $key => $message )
        <table class="table table-hover" style="width:250%">
            <tbody>
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
                </tr>
            </tbody>
        </table>
    @endforeach

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
                    <input class="form-control" name="files" type="file" id="files" value="{{old('files')}}" required>
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
    

<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
@stop
