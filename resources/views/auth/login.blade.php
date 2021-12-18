@extends('Layout.SidePanel')
@section('title', 'Masuk | OneRoom')
@section('contentGuest')
    <div class="mt-5 bg-white border shadow rounded-3 p-lg-5">
        <div class="container">
            <main class="row">
                <div class="col-md-8 p-lg-5">
                    <div class="img-thumbnail">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://source.unsplash.com/random/1000×700/?programming"
                                        class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://source.unsplash.com/random/1000×700/?code" class="d-block w-100"
                                        alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://source.unsplash.com/random/1000×700/?education" class="d-block w-100"
                                        alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-start text-center">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        @include('components.notifications')
                        <h1 class="mt-3 fw-normal"><strong>Login</strong></h1>
                        <p class="text-muted m-0 mb-3">Belum punya akun?
                            <a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#registerModal">
                                Daftar disini
                            </a>
                        </p>
                        <div class="form-floating mb-2">
                            <input type="email" name="email"
                                class="form-control form-input-color rounded-top @error('email')is-invalid @enderror"
                                value="{{ old('email') }}" id="email" placeholder="ex: johndoe@gmail.com..." required
                                autocomplete="email" autofocus>
                            <label for="email">Email</label>
                            @error('email')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password"
                                class="form-control form-input-color rounded-bottom @error('password')is-invalid @enderror"
                                id="passwordLogin" required autocomplete="current-password">
                            <label for="password">Password</label>
                            {{-- <i class="far fa-eye visible-password" id="openEye" onclick="showPassword()"></i>
                            <i class="far fa-eye-slash visible-password d-none" id="closeEye" onclick="hidePassword()"></i> --}}
                            @error('password')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
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
                        </div> --}}
                        <button class="my-4 w-100 btn btn-lg btn-fill-green rounded-pill" type="submit">Login</button>
                        {{-- <div class="mb-3">
                            @if (Route::has('password.request'))
                                <p class="text-muted m-0">Lupa password?
                                    <a class="mb-3 cursor-pointer" href="{{ route('password.request') }}">
                                        Reset Password
                                    </a>
                                </p>
                            @endif
                        </div> --}}
                    </form>
                </div>
            </main>
        </div>
        @include('auth._role_modal')
    </div>
    <script>
        // function showPassword() {
        //     document.getElementById("passwordLogin").type = 'text'
        //     document.getElementById("openEye").classList.add("d-none")
        //     document.getElementById("closeEye").classList.remove("d-none")
        // }

        // function hidePassword() {
        //     document.getElementById("passwordLogin").type = 'password'
        //     document.getElementById("openEye").classList.remove("d-none")
        //     document.getElementById("closeEye").classList.add("d-none")
        // }
    </script>
@endsection
