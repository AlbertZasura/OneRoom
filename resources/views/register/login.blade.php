<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
    </form>
    <p>Belum punya akun? <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#registerModal" id="open">Daftar disini</button></p>
    

    <div class="modal" tabindex="-1" role="dialog" id="registerModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="alert alert-danger" style="display:none"></div>
                <div class="modal-header">
                    <h5 class="modal-title">Uefa Champion League</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Daftar Sebagai</p>
                <button type="button" class="btn btn-info btn-lg">Guru</button>
                    <p>Atau</p>
                <button type="button" class="btn btn-info btn-lg">Siswa</button>
                    <p>Atau</p>
                <button type="button" class="btn btn-info btn-lg">Admin</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>