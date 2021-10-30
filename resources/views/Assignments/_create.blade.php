<div class="modal fade" id="createAssignments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('course.assignments.store',$course)}}" method="POST"  enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title" class="col-form-label"><b>Topik</b></label>
                        <input type="text" name="title" class="form-control @error('title')is-invalid @enderror" id="title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="deadline" class="col-form-label"><b>Deadline</b></label>
                        <div class="input-group date">
                            <input type="datetime-local" name="deadline" class="form-control  @error('deadline')is-invalid @enderror" id="deadline" required>
                        </div>
                        @error('deadline')
                            <div class="invalid-feedback">{{ $message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="file"><b>File</b></label>
                        <input type="file" name="file" class="form-control @error('file')is-invalid @enderror" id="file" required>
                        @error('file')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="class" class="col-form-label"><b>Kelas</b></label>
                        <input type="text" value="{{$selectedClasses->name}}" class="form-control" disabled>
                        <input type="text" name="class" value="{{$selectedClasses->id}}" placeholder="test" class="form-control" id="class" hidden>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>