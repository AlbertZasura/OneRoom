<div class="modal fade" id="showSchedules{{ $sch->first()->date }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Jadwal {{ $sch->first()->date }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach ( $sch as $key =>$s )
                    <p><strong>{{ $key+1 }}.</strong> {{ $s->course->name }} {{ $s->start_time }}-{{ $s->end_time }} </p>
                @endforeach
            </div>
        </div>
    </div>
</div>