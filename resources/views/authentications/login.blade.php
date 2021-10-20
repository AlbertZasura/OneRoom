@extends('Layout.SidePanel')

@section('contentGuest')
    <div class="mt-5 border border-dark border-1 rounded-3 p-5">
        <main class="row">
            <div class="col-md-8">
                <h1>Images</h1>
            </div>
            <div class="col-md-4">
                <form action="/login" method="POST">
                    @csrf
                    @include('components.notifications')
                    <h1 class="my-5 fw-normal"><strong>Login</strong></h1>
                    <div class="form-floating">
                        <input type="email"  name="email" class="form-control rounded-top @error('email')is-invalid @enderror" value="{{old('email')}}" id="email"placeholder="ex: johndoe@gmail.com..." required autofocus>
                        <label for="email">Email</label>
                        @error('email')
                        <div class="invalid-feedback">{{ $message}}</div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control rounded-bottom @error('password')is-invalid @enderror" id="passwordLogin" placeholder="Password" required>
                        <label for="password">Password</label>
                        <i class="far fa-eye visible-password" id="openEye" onclick="showPassword()"></i>
                        <i class="far fa-eye-slash visible-password d-none" id="closeEye" onclick="hidePassword()"></i>
                        @error('password')
                        <div class="invalid-feedback">{{ $message}}</div>
                        @enderror
                    </div>
                    {{-- <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div> --}}
                    <button class="mt-4 w-100 btn btn-lg btn-primary" type="submit">Login</button>
                    <p class="mt-3 mb-3 text-muted">Belum punya akun?
                        <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                            Daftar disini
                        </a>
                    </p>
                </form>
            </div> 
        </main>
        @include('authentications._role_modal')
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
