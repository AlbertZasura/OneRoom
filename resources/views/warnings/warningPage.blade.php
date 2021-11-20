@extends('Layout.SidePanel')

@section('title', 'Warning | OneRoom')

@section('content')
    {{-- <div class="card-shadow bg-white m-5 border-radius-8px " >
        <div class="card-body p-5">
            <h2>Maaf, anda belum termapping, silahkan menghubungi admin dengan kontak dibawah ini</h2>
        </div>
    </div> --}}
    <div class="card-body p-5 m-5 text-center">
        <img src="{{ asset('img/Logo-OneRoom.png') }}" class="img-fluid" alt="forget-password">
        <h3>Maaf, Anda belum termapping, silahkan menghubungi Admin dengan kontak dibawah ini</h3>
    </div>
@endsection
