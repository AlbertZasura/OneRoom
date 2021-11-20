@extends('Layout.SidePanel')
@section('title', 'Ubah Password | OneRoom')
@section('contentGuest')
    <div class="bg-white text-center border shadow rounded-3 p-lg-5 mt-5">
        <main class="form-signin rounded">
            <h2 class="fw-normal"><strong>Reset Password</strong></h2><br>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-floating mb-2">
                    <input type="email" name="email"
                        class="form-control form-input-color @error('email')is-invalid @enderror" value="{{ old('email') }}"
                        id="email" placeholder="ex: johndoe@gmail.com..." required>
                    <label for="email">Email</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-2">
                    <input type="password" name="password"
                        class="form-control form-input-color @error('password')is-invalid @enderror" id="password"
                        placeholder="Password" required>
                    <label for="password">Password</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password_confirmation"
                        class="form-control form-input-color @error('password_confirmation')is-invalid @enderror rounded-bottom"
                        id="password_confirmation" placeholder="type password again here..." required>
                    <label for="password_confirmation">Konfirmasi Password</label>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="mt-4 w-100 btn btn-fill-green rounded-pill" type="submit">Reset Password</button>
            </form>
        </main>
    </div>
@endsection
