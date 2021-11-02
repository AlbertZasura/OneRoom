<table>
    <tr>
        <th></th>
        <th><strong>Mata Pelajaran: {{ $schedule->course->name }}</strong></th>
    </tr>
    <thead>
        <tr>
            <th><strong>No</strong></th>
            <th><strong>Nama {{ $role==="teacher" ? "Siswa Kelas ".$schedule->class->name : "Guru" }}</strong></th>
            <th><strong>Jam</strong></th>
            <th><strong>Status</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $key => $user )
            <tr>
                <th>
                    <p>{{ $key+1 }}.</p> 
                </th>
                <td>
                    <p>{{ $user->name }}</p> 
                </td>
                <td>
                    @if ($role==="teacher")
                        <p>{{ $user->absent_schedule($schedule->id)->first() ? $user->absent_schedule($schedule->id)->first()->created_at->format('H:i') : "-" }} </p> 
                    @else
                        <p>{{ $user->check_absent(request('date'))?$user->check_absent(request('date'))->created_at->format('H:i'):'-'}}</p>
                    @endif
                </td>
                <td>
                    @if ($role==="teacher")
                        <p> {{ $user->absent_schedule($schedule->id)->first() ? $user->absent_schedule($schedule->id)->first()->status : (now()->gte($schedule->date) ? "Tidak Hadir" : "-") }} </p> 
                    @else
                        <p>{{ $user->check_absent(request('date'))?$user->check_absent(request('date'))->status:(now()->gte(request('date')) ? "Tidak Hadir" : "-")}}</p>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>