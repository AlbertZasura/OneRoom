
<div class="modal fade" id="createPosts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Forum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('course.posts.store',$course)}}" method="POST"  enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title" class="col-form-label"><b>Topik</b></label>
                        <input type="text" placeholder="Topik Forum" name="title" class="form-control @error('title')is-invalid @enderror" id="title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="col-form-label"><b>Deskripsi</b></label>
                        <textarea class="form-control @error('description')is-invalid @enderror" style="height:150px" id="description" name="description" placeholder="Deskripsi Forum" required></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="attachment"><b>Attachment</b> (optional)</label>
                        <input type="file" name="attachment" class="form-control @error('attachment')is-invalid @enderror" id="attachment">
                        @error('attachment')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="class" class="col-form-label"><b>Kelas</b></label>
                        <input type="text" value="{{$selectedClasses->name}}" class="form-control" disabled>
                        <input type="text" name="class" value="{{$selectedClasses->id}}" placeholder="test" class="form-control" id="class" hidden>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-green rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-fill-green rounded-pill">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>