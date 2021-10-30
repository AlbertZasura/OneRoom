<table>
    <thead>
        <tr>
            <th>Waktu Pengumpulan</th>
            <th>Nama Siswa</th>
            <th>Nilai</th>
            <th>Catatan</th>
            <th>Link File</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{date('d-m-Y', strtotime($user->created_at))}} {{date('H:i', strtotime($user->update_at))}}</td>
                <td>{{$user->pivot->score}}</td>
                <td>{{$user->pivot->notes ? $user->pivot->notes : 'Tidak ada catatan' }}</td>
                <td>{{ public_path('storage/file/'.$user->pivot->file) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>