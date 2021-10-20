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
                <div class="form-group pos-relative">
                    <strong>password:</strong>
                    <input type="password" id="passwordLogin" name="password" class="form-control" placeholder="Type your password here..." required>
                    <i class="far fa-eye visible-password" id="openEye" onclick="showPassword()"></i>
                    <i class="far fa-eye-slash visible-password d-none" id="closeEye" onclick="hidePassword()"></i>
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
    </p>
    @include('authentications.partials._role_modal')
    <script>
        function showPassword(){
            document.getElementById("passwordLogin").type = 'text'
            document.getElementById("openEye").classList.add("d-none")
            document.getElementById("closeEye").classList.remove("d-none")
        }
    
        function hidePassword(){
            document.getElementById("passwordLogin").type = 'password'
            document.getElementById("openEye").classList.remove("d-none")
            document.getElementById("closeEye").classList.add("d-none")
        }
    </script>
@stop
