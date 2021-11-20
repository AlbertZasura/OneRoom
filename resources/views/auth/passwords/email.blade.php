@extends('Layout.SidePanel')
@section('title', 'Reset Password | OneRoom')
@section('contentGuest')
<div class="mt-5 bg-white border shadow rounded-3 p-lg-5">
    <div class="container">
        <main class="row">
            <div class="col-md-8 p-md-5 text-center">
                <img src="{{ asset('img/Logo-OneRoom.png') }}" alt="forget-password">
            </div>
            <div class="col-md-4 text-md-start text-center">
                <h2 class="fw-normal"><strong>Reset Password</strong></h2>
                <br>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-floating my-3">
                        <input type="email" id="email" name="email" class="form-control rounded form-input-color @error('email')is-invalid @enderror" value="{{old('email')}}" id="email"placeholder="ex: johndoe@gmail.com..." required>
                        <label for="email">Email</label>
                        @error('email')
                        <div class="invalid-feedback">{{ $message}}</div>
                        @enderror
                    </div>
                    <button class="mb-4 w-100 btn btn-lg btn-fill-green rounded-pill" type="submit">Kirim link password reset</button>
                </form>
                <p class="mb-3 text-muted">Ingat Password? <a href="/login">Login disini</a></p>
            </div>
        </main>
    </div>
</div>
@endsection
