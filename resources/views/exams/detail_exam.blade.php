@extends('Layout.SidePanel')

@section('title', 'Materi')

@section('content')

    <h1>Exam</h1>
    <div class="py-3">
        <a href="{{ route('exams.export',$exam_id) }}" class="btn btn-primary rounded-pill">Export Excel</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Waktu Pengumpulan</th>
                <th scope="col">Catatan</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($userList as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>
                    <div>{{date('d-m-Y', strtotime($item->created_at))}} {{date('H:i', strtotime($item->update_at))}}</div>
                </td>
                <td>
                    <div>{{$item->pivot->notes ? $item->pivot->notes : 'Tidak ada catatan' }}</div>
                </td>
                <td class="fs-25">
                    <i class="fas fa-download mr-10 cursor-pointer" onclick="window.location='/exams/downloadexamstudent/download?user_id={{$item->id}}&pivotId={{$item->pivot->id}}&e={{$exam_id}}'" ></i>
                    <i class="fas fa-plus cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}"></i>
                </td>
                <td class="fw-bolder {{(App\Models\Exam::first()->kkm() > $item->pivot->score) ? 'text-danger' : 'text-success'}}">
                    {{$item->pivot->score}}
                </td>
            </tr>
            <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$item->id}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel{{$item->id}}">Beri Nilai Untuk {{$item->name}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/exams/submitscore/{{$item->id}}?e={{$exam_id}}&pivotId={{$item->pivot->id}}" method="POST">
                        @csrf
                            <div class="modal-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="score86" class="col-form-label">Nilai</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="number"  name="score" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>

@stop