@extends('Layout.SidePanel')
@section('title', 'Masuk | OneRoom')
@section('contentGuest')
    <div class="mt-5 border border-dark border-1 rounded-3 p-5">
        <main class="row">
            <div class="col-md-8">
                <h1>Images</h1>
            </div>
            <div class="col-md-4">
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    @include('components.notifications')
                    <h1 class="my-5 fw-normal"><strong>Login</strong></h1>
                    
                    <div class="form-floating">
                        <input type="email"  name="email" class="form-control rounded-top @error('email')is-invalid @enderror" value="{{old('email')}}" id="email" placeholder="ex: johndoe@gmail.com..." required autocomplete="email" autofocus>
                        <label for="email">Email</label>
                        @error('email')
                        <div class="invalid-feedback"><strong>{{ $message}}</strong></div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control rounded-bottom @error('password')is-invalid @enderror" id="passwordLogin" required autocomplete="current-password">
                        <label for="password">Password</label>
                        <i class="far fa-eye visible-password" id="openEye" onclick="showPassword()"></i>
                        <i class="far fa-eye-slash visible-password d-none" id="closeEye" onclick="hidePassword()"></i>
                        @error('password')
                        <div class="invalid-feedback"><strong>{{ $message}}</strong></div>
                        @enderror
                    </div>
                    {{-- <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div> 
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>--}}
                    <button class="mt-4 w-100 btn btn-lg btn-primary" type="submit">Login</button>
                    <p class="mt-3 mb-3 text-muted">Belum punya akun?
                        <a class="text-decoration-none cursor-pointer" data-bs-toggle="modal" data-bs-target="#registerModal">
                            Daftar disini
                        </a>
                    </p>
                </form>
            </div> 
        </main>
        @include('auth._role_modal')
    </div>
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
@endsection
