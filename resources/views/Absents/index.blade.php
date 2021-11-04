@extends('Absents.course')

@section('title', 'Absent Center')

@section('show')
    <h3>Daftar Pertemuan</h3>
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
                                    <button class="btn btn-sm btn-primary" type="submit"><i class='fa fa-user-check'></i> Absent</button>
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
@endsection