
@extends('Layout.SidePanel')

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
    
    <a class="btn btn-outline-dark" data-bs-toggle="modal">Tambah Pengumuman</a> 
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

<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
@stop
