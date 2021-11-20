@extends('Layout.SidePanel')
@section('title', 'Daftar | OneRoom')
@section('contentGuest')
    <div class="bg-white text-center border shadow rounded-3 p-lg-5 mt-5">
        <main class="form-signin rounded">
            @include('components.notifications')
            <form action="{{ route('register') }}?role={{ $role }}" method="POST">
                @csrf
                <h1 class="fw-normal"><strong>Daftar</strong></h1>
                <h5 class="mb-4 fw-normal">Sebagai {{ $humanizeRole }}</h5>
                <div class="form-floating mb-2">
                    <input type="text" name="name"
                        class="form-control form-input-color rounded-top @error('name')is-invalid @enderror"
                        value="{{ old('name') }}" id="name" placeholder="ex: John Doe..." required autocomplete="name"
                        autofocus>
                    <label for="name">Nama</label>
                    @error('name')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                @if ($role != 'admin')
                    <div class="form-floating mb-2">
                        <input type="text" name="identification_number"
                            class="form-control form-input-color @error('identification_number')is-invalid @enderror"
                            value="{{ old('identification_number') }}" id="identification_number" placeholder="ex: 1234..."
                            required>
                        <label for="identification_number">Nomor Induk {{ $humanizeRole }}</label>
                        @error('identification_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                <div class="form-floating mb-2">
                    <input type="text" name="phone"
                        class="form-control form-input-color @error('phone')is-invalid @enderror"
                        value="{{ old('phone') }}" id="phone" placeholder="ex: 081312122161..." required>
                    <label for="phone">Nomor Handphone</label>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-2">
                    <input type="email" name="email"
                        class="form-control form-input-color @error('email')is-invalid @enderror"
                        value="{{ old('email') }}" id="email" placeholder="ex: johndoe@gmail.com..." required>
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
                <input type="text" name="role" value="{{ $role }}" hidden>
                <button class="mt-4 w-100 btn btn-fill-green rounded-pill" type="submit">Simpan</button>
                <p class="mt-3 mb-3 text-muted">Sudah punya akun? <a href="/login">Login disini</a></p>
            </form>
        </main>
    </div>
@endsection
