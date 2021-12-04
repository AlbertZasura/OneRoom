@extends('Layout.SidePanel')

@section('title', 'Ujian detail | OneRoom')

@section('content')

    <div class="card-shadow bg-white py-2 px-4 mt-20">
        <h1>Daftar Pengumpulan {{ $exam->title }}</h1>
        @if (now()->lt($exam->end_date))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <strong>Note!</strong>  Setelah melewati batas waktu, Anda dapat memberikan nilai Ujain !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card" >
            <div class="d-lg-grid d-lg-flex align-items-center p-3">
                <div class="d-flex me-auto justify-content-center">
                <i class='fs-25 fa fa-file-signature me-2'></i>
                    <nav style="--bs-breadcrumb-divider: '>';" class="me-auto" aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('exlist',$exam->type)}}">{{$exam->courses->name}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('exlist',$exam->type)}}">{{$exam->class->name}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$exam->title}}</li>
                        </ol>
                    </nav>
                </div>
                <p class="my-2 text-center {{(now()->gte($exam->end_date)) ? "text-danger" : "text-success"}}">{{ \Carbon\Carbon::parse($exam->end_date)->isoFormat('dddd, D MMMM Y') }}, {{date('H:i', strtotime($exam->end_date))}}</p>
                <div class="d-flex ms-auto justify-content-center">
                    <a href="{{route('downloadexams', $exam->id)}}" class="btn"><i class='fs-25 fa fa-download'></i></a>
                    <form action="{{ route('exams.destroy',[$exam]) }}" method="POST">   
                        @csrf
                        @method('DELETE')      
                        <button class="btn" type="submit" onclick="return confirm('Apakah Anda yakin untuk menghapus tugas {{ $exam->title }} ?')"><i class='fs-25 fa fa-trash text-danger'></i></button>
                    </form>
                    <p class="m-1">{{$exam->users->count()}} / {{count($exam->class->first()->users->where('role','like','student'))}}</p>
                </div>
            </div>
        </div>
        <div class="d-grid d-md-flex align-items-center p-3 justify-content-center">
            <a href="{{ route('exams.export',$exam_id) }}" class="ms-auto btn btn-fill-green rounded-pill">Export Excel</a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Waktu Pengumpulan</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Aksi</th>
                        <th scope="col">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userList as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>
                            <div>{{  \Carbon\Carbon::parse($item->pivot->updated_at)->isoFormat('D MMMM Y, H:mm')  }}</div>
                            
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
                                                <input type="number"  name="score" class="form-control form-input-color" >
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
        </div>
        {{ $userList->links() }}
    </div>


@stop