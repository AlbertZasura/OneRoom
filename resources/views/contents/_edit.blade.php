<div class="modal fade" id="editContents{{ $content->id  }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit {{ $content->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('contents.update',$content)}}" method="POST">
                <div class="modal-body">
                    @method('PUT')
                    @csrf
                    <div class="form-group mb-3">
                        <label for="value" class="col-form-label"><b>Isi</b></label>
                        <input type="{{ $content->type }}" name="value" value="{{ $content->value }}" class="form-control" id="value" required>
                    </div>
                    @error('value')
                        <div class="errors">{{ $message}}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>