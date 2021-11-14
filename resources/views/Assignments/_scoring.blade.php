<div class="modal fade" id="scoringAssignments{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Input Nilai {{$user->name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('assignments.scoring',$assignment)}}?u={{$user->id}}&t={{$user->pivot->created_at}}" method="POST" >
                <div class="modal-body">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="score" class="col-form-label"><b>Nilai</b></label>
                        <input type="number" name="score" class="form-control" id="score" required>
                    </div>
                    @error('score')
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