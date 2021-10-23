<div class="modal fade" id="editSchedules{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jadwal {{ $s->course->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('classes.schedules.update',[$class,$s])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group mb-3">
                        <label for="date" class="col-form-label"><b>Hari</b></label>
                        <input type="date" value="{{ $s->date }}" name="date" class="form-control @error('date')is-invalid @enderror" id="date" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label"><b>Jam</b></label>
                        <div class="row">
                            <div class="col-md-5">
                                <input type="time"  value="{{ $s->start_time }}" name="start_time" class="form-control @error('start_time')is-invalid @enderror" id="start_time" required>
                                @error('start_time')
                                    <div class="invalid-feedback">{{ $message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 text-center">
                                -
                            </div>
                            <div class="col-md-5">
                                <input type="time" name="end_time"  value="{{ $s->end_time }}" class="form-control  @error('end_time')is-invalid @enderror" id="end_time" required>
                                @error('end_time')
                                    <div class="invalid-feedback">{{ $message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>