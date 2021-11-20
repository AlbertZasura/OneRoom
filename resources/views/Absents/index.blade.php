@extends('Absents.course')

@section('title', 'Absen | OneRoom')

@section('show')
    <div class="card-shadow bg-white m-5 border-radius-8px">
        <div class="card-body">
            <h3>Daftar Pertemuan</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pertemuan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $key => $schedule )
                            <tr>
                                <th>
                                    {{ $key+1 }}.
                                </th>
                                <td>
                                    Pertemuan {{ $key+1 }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($schedule->date)->isoFormat('dddd, D MMMM Y') }}
                                    <br>
                                    {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                </td>
                                <td>
                                    @if ($schedule->absents->where('user_id',Auth::user()->id)->first())
                                        {{ $schedule->absents->where('user_id',Auth::user()->id)->first()->status }}
                                    @else
                                        @if (today()->toDateString() == $schedule->date && time() >= strtotime($schedule->start_time) && time() <= strtotime($schedule->end_time))
                                            <form action="{{ route('course.absents.store', $schedule->course) }}?schedule_id={{ $schedule->id }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-fill-green rounded-pill" type="submit"><i class='fa fa-user-check'></i> Absent</button>
                                            </form>
                                        @elseif (today()->toDateString() > $schedule->date && time() >= strtotime($schedule->end_time))
                                            Tidak hadir
                                        @else
                                            -
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
