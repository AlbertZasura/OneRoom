@extends('Layout.SidePanel')
@section('title', 'Pengumuman  | OneRoom')
@section('content')
<div class="card-shadow bg-white m-5 border-radius-8px " >
    <div class="card-body p-5">
    <h1>Pengumuman</h1>
    <br>
    <table style="width:18%">
        <tr>
            <td>
                <h5>Pengirim</h5>
                
            </td>
            <td>
                <h5>:</h5>
            </td>
            <td>
                <a>&nbsp;  {{ $message->user->name  }}</a>
                <br>
            </td>
        </tr>
        <tr>
            <td>
                <h5>Tanggal</h5>   
            </td>
            <td>
                <h5>:</h5>
            </td>
            <td>
                <a>&nbsp;  {{ $message->created_at->format('d M Y') }}</a>
                <br>
            </td>
            
        </tr>
        <tr>
            <td>
                <h5>Judul</h5>
            </td>
            <td>
                <h5>:</h5>
            </td>
            <td>
                <a>&nbsp;   {{ $message->title }}</a>
                <br>
            </td>
        </tr>
    </table>

    <br>
    
    <div class="card" style="width: 60%; height: 50%;">
        <div class="card-body">
            <h6>Isi :</h6>
            <a> {{ $message->content }}</a>
            <br>
            <br>
            <h6>File Attachments :</h6>
            <div onclick="window.location='{{route('downloadMessage',$message->id)}}'" class="">
                <i class="fas fa-paperclip"></i> 
            </div>
        </div>
    </div>
    </div>
</div>
@endsection