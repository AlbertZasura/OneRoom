@extends('Layout.SidePanel')

@section('content')
    <h1>Pengumuman</h1>
    <table style="width:35%">
        <tr>
            <td>
                <a>Pengirim</a> 
            </td>
            <td>
                <a>{{ $message->user->name  }}</a>
                <br>
            </td>
        </tr>
        <tr>
            <td>
                <a>Tanggal</a>
            </td>
            <td>
                <a>{{ $message->created_at->format('d M Y') }}</a>
                <br>
            </td>
            
        </tr>
        <tr>
            <td>
                <a>Judul</a>
            </td>
            <td>
                <a>{{ $message->title }}</a>
                <br>
            </td>
        </tr>
    </table>
    <br>
    <div class="card" style="width: 80%; height: 50%;">
        <div class="card-body">
            <a> {{ $message->content }}</a>
        </div>
    </div>
@stop