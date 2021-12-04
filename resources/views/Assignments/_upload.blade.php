<div class="modal fade" id="uploadAssignments{{$assignment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Unggah Tugas {{$assignment->title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('assignments.upload',$assignment)}}" method="POST"  enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="notes" class="col-form-label"><b>Notes</b></label>
                        <input type="text" name="notes" class="form-control" id="notes" required>
                    </div>
                    @error('notes')
                        <div class="errors">{{ $message}}</div>
                    @enderror
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="file"><b>File</b></label>
                        <input type="file" name="file" class="form-control" id="file" required>
                    </div>
                    @error('file')
                        <div class="errors">{{$message}}</div>
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