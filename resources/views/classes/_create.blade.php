<div class="modal fade" id="createClasses" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
            </div>
            <form action="{{route('classes.store')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="col-form-label"><b>Nama</b></label>
                        <input type="text" name="name" class="form-input-color  form-control" id="name" required>
                    </div>
                    @error('name')
                        <div class="errors">{{ $message}}</div>
                    @enderror
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-green rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-fill-green rounded-pill">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>