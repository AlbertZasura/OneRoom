<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th><strong>No.</strong></th>
                <th><strong>Waktu Pengumpulan</strong></th>
                <th><strong>Nama Siswa</strong></th>
                <th><strong>Nilai</strong></th>
                <th><strong>Catatan</strong></th>
                <th><strong>Link File</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{date('d-m-Y', strtotime($user->created_at))}} {{date('H:i', strtotime($user->update_at))}}</td>
                    <td>{{$user->pivot->score}}</td>
                    <td>{{$user->pivot->notes ? $user->pivot->notes : 'Tidak ada catatan' }}</td>
                    <td>{{ public_path('storage/file/'.$user->pivot->file) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>