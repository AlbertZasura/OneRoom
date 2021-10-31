@extends('Layout.SidePanel')

@section('title', 'Profile')

@section('content')

    <form action="{{ route('updateProfile', $users->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="shadow p-3 container rounded bg-white mt-3 mx-auto">
            <div class="row d-flex align-items-center justify-content-center">
                
                <div class="col-md-5 border-right">
                    <div class="">
                        <div class="d-flex flex-column align-items-center text-center ">
                            @if(Auth::user()->profile_picture) 
                            <img class="img-fluid rounded-circle img-thumbnail" id="image_preview" style="width:200px;height:200px;" src="storage/images/{{ Auth::user()->profile_picture }}">
                            @else
                            <img class="img-fluid rounded-circle img-thumbnail" id="image_preview" style="width:200px;height:200px;" src="{{ ('img/profile.png') }}">
                            @endif 
                            <div>
                                <label for="profile_picture" class="btn"><b>Ubah Gambar Profil</b></label>
                                <input name="profile_picture" id="profile_picture" style="visibility:hidden;" type="file">
                                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" >
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Nama</label><input type="text" class="form-control @error('name')is-invalid @enderror" name="name" id="name" placeholder="ex: John Doe..." value="{{ old('name', Auth::user()->name) }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12"><label class="labels">Nomor Induk</label><input type="text" class="form-control @error('identification_number')is-invalid @enderror" name="identification_number" id="identification_number" placeholder="ex: 1234..." value="{{ old('identification_number', Auth::user()->identification_number) }}" required>
                                @error('identification_number')
                                <div class="invalid-feedback">{{ $message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12"><label class="labels">Nomor Handphone</label><input type="text" class="form-control @error('phone')is-invalid @enderror" name="phone" id="phone" placeholder="ex: 081312122161..." value="{{ old('phone', Auth::user()->phone) }}" required>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control @error('email')is-invalid @enderror" name="email" id="email" placeholder="ex: johndoe@gmail.com..." value="{{ old('email', Auth::user()->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12"><label class="labels">Password</label><input type="password" class="form-control @error('password')is-invalid @enderror" name="password" id="password" placeholder="Password" value="" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12"><label class="labels">Konfirmasi Password</label><input type="password" class="form-control @error('password_confirmation')is-invalid @enderror rounded-bottom" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" value="" required>
                                @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5 text-center"><button type="button" class="btn btn-danger" onclick="window.location.href='/'">Batal</button>&nbsp;<button class="btn btn-primary profile-button" type="submit">Simpan</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<script>
    $(function(){
        $("#profile_picture").change(function(e){
            const file = e.target.files[0];
            let url = window.URL.createObjectURL(file);
            $("#image_preview").attr('src', url);

            let fd = new FormData();
            fd.append('profile_picture', file);
            fd.append('user_id' , $("#user_id").val());
            fd.append('_token', '{{ csrf_token() }}');
            $.ajax({
                url: "{{ route('profile.image') }}",
                method: "POST",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success:function(response){
                    console.log(response);
                }

            });
        });
    });

</script>
@stop