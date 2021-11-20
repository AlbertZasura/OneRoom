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
            @foreach ($users as $key=> $user )
                <tr>
                    <td>
                        <p>{{ $key+1 }}</p> 
                    </td>
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
</div>
