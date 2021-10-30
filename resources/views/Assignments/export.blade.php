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
        @foreach ($users as $user )
            <tr>
                <td>
                    <p>{{ $user->pivot->created_at }}</p> 
                </td>
                <td>
                    <p>{{ $user->name }}</p> 
                </td>
                <td>
                    <p>{{ $user->pivot->score }}</p> 
                </td>
                <td>
                    <p>{{ $user->pivot->notes }}</p> 
                </td>
                <td>
                    <p>{{ storage_path($user->pivot->file) }}</p> 
                </td>
            </tr>
        @endforeach
    </tbody>
</table>