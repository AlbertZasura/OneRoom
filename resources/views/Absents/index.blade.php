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
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
