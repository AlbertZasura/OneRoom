@extends('Layout.SidePanel')
@section('title', 'Pengumuman | OneRoom')
@section('content')
    <div class="card-shadow bg-white m-lg-5 border-radius-8px">
        <div class="card-body p-5">
            <h1>Pengumuman</h1>
            <br>
            <table style="">
                <tr>
                    <td>
                        <h5>Pengirim</h5>

                    </td>
                    <td>
                        <h5>:</h5>
                    </td>
                    <td>
                        <a>&nbsp; {{ $message->user->name }}</a>
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
                        <a>&nbsp; {{ \Carbon\Carbon::parse($message->created_at)->isoFormat('D MMMM Y') }}</a>
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
                        <a>&nbsp; {{ $message->title }}</a>
                        <br>
                    </td>
                </tr>
            </table>

            <br>

            <div class="card mobile-w-100" style="width: 60%; height: 50%;">
                <div class="card-body">
                    <h6>Isi :</h6>
                    <p> {{ $message->content }}</p>
                    @if ($message->file)
                        <h6>File Attachments :</h6>
                        <a href="{{ route('downloadMessage', $message->id) }}"><i
                                class="fas fa-paperclip"></i>{{ $message->file }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
