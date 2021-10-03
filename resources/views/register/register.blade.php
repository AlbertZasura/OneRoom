<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Daftar</h1>
    <p>Sebagai </p>
    <form action="/register" method="POST">
        @csrf
      
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="ex: John Doe..." required autofocus>
                </div>
                @error('name')
                    <div class="errors">{{ $message}}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nomor Induk:</strong>
                    <input type="text" name="identification_number" value="{{old('identification_number')}}" class="form-control" placeholder="ex: 1234..." required>
                </div>
                @error('identification_number')
                    <div class="errors">{{ $message}}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nomor Handphone:</strong>
                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="ex: 081312122161..." required>
                </div>
                @error('phone')
                    <div class="errors">{{ $message}}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="ex: johndoe@gmail.com..." required>
                </div>
                @error('email')
                    <div class="errors">{{ $message}}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input type="password" name="password" class="form-control" placeholder="type password here..." required>
                </div>
                @error('password')
                    <div class="errors">{{ $message}}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Konfirmasi Password:</strong>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="type password again here..." required>
                </div>
                @error('password_confirmation')
                    <div class="errors">{{ $message}}</div>
                @enderror
            </div>
            <input type="text" name="status" value="0" hidden>
            <input type="text" name="role" value="0" hidden>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <p>sudah punya akun? <a href="/login">Login disini</a></p>
       
    </form>
</body>
</html>