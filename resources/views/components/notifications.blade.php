@if (session('loginError'))
  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
      <strong>Gagal!</strong> {{ session('loginError') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      <strong>Berhasil!</strong> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (count($errors)>0)
  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <strong>Gagal!</strong>, Silahkan cek inputan kembali
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif