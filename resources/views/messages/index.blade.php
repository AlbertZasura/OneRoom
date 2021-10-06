
@extends('Layout.SidePanel')

@section('title', 'Messages Center')

@section('content')
    <h1>Pengumuman</h1>
    @if (Auth::user())
    <form action="/logout" method="POST">   
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    @else
    <a class="btn btn-info" href="/login">Login</a>  
    @endif
    @can('create', App\Models\Message::class )
        <a class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#uploadAnnouncement">Tambah Pengumuman</a> 
    @endcan
        @foreach ($messages as $key => $message )
    
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
                        <a>{{ Auth::user()->name }}</a>
                    </td>
                    <td>
                        <a>{{ $message->created_at->format('d M Y') }}</a>
                    </td>
                </tr>
            </tbody>
        </table>
    @endforeach

    <div class="modal fade" id="uploadAnnouncement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumuman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label"><b>Judul</b></label>
                    <input type="text" name="title" class="form-control" id="title">
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label"><b>Isi</b></label>
                    <textarea class="form-control" name="content" id="content"></textarea>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label"><b>File</b></label>
                    <input class="form-control" name="files" type="file" id="files">
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </div>
        </div>
    </div>

<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
@stop
