@extends('Layout.SidePanel')
@section('title', 'Verifikasi Email | OneRoom')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-shadow mt-5 bg-white rounded">
                <div class="card-header">Verifikasi Email Anda</div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Tautan verifikasi baru telah dikirim ke alamat email Anda.
                        </div>
                    @endif
                    <p>Sebelum melanjutkan, harap periksa email Anda untuk tautan verifikasi.<br>
                        Jika Anda tidak menerima email,</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-fill-green rounded-pill align-baseline">Kirim tautan verifikasi baru</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
