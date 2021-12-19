<div class="modal fade" id="exams{{ $i->id }}History" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Pengumpulan Ujian {{ $i->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$i->users()->get()->isEmpty())
                                @foreach ($i->users()->first()->pivot->audits as $key => $item)
                                    @php($exam = $item->new_values)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ \Carbon\Carbon::parse($exam['updated_at'])->isoFormat('D MMMM Y, H:mm') }}
                                        </td>
                                        <td>{{ $exam['notes'] }}</td>
                                        <td>
                                            <a download="{{ $exam['file'] }}"
                                                href="{{ asset('storage/file/' . $exam['file']) }}"
                                                title="{{ $exam['file'] }}" class="btn ms-auto">
                                                <i class='fs-25 fa fa-download'></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
