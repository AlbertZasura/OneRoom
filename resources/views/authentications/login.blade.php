@extends('Layout.SidePanel')

@section('contentGuest')
    <h1>Login</h1>
    @if (session('loginError'))
        <div class="alert alert-warning">
            {{ session('loginError') }}
        </div>
    @endif
    <form action="/login" method="POST">
        @csrf
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" class="form-control" placeholder="Type your email here.." required autofocus>
                </div>
                @error('email')
                    <div class="errors">{{ $message}}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>password:</strong>
                    <input type="password" name="password" class="form-control" placeholder="Type your password here..." required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
    </form>
    <p>Belum punya akun?
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
            Daftar disini
        </button>
        <button type="button" class="btn btn-primary"     id="open-popup">
            Daftar disini
        </button>
    </p>
    <x-pop-up>
    <div >
        <div class="">
            <div class="">
                <div class="">
                {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-bodytext-center">
                    <h3>Daftar Sebagai</h3>
                    <a href="/register/teacher" class="btn btn-warning">Guru</a>
                    <p>Atau</p>
                    <a href="/register" class="btn btn-warning">Siswa</a>
                    <p>Atau</p>
                    <a href="/register/admin" class="btn btn-warning">Admin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </x-pop-up>

    <!-- @include('authentications.partials._role_modal') -->
@stop
