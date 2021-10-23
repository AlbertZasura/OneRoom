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
                        <input type="text" name="title" class="form-control" id="title" required>
                    </div>
                    @error('title')
                        <div class="errors">{{ $message}}</div>
                    @enderror
                    <div class="form-group mb-3">
                        <label for="deadline" class="col-form-label"><b>Deadline</b></label>
                        <div class="input-group date">
                            <input type="datetime-local" name="deadline" class="datetimepicker form-control" id="deadline" required>
                            {{-- <span class="input-group-append">
                                <span class="input-group-text bg-white">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span> --}}
                        </div>
                    </div>
                    @error('deadline')
                        <div class="errors">{{ $message}}</div>
                    @enderror
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="file"><b>File</b></label>
                        <input type="file" name="file" class="form-control" id="file" required>
                    </div>
                    @error('file')
                        <div class="errors">{{$message}}</div>
                    @enderror
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
<script type="text/javascript">
    $(function() {
       $('.datetimepicker').datetimepicker();
    });
</script>  