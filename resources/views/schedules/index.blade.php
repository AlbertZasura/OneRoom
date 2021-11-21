@extends('Layout.SidePanel')

@section('title', "Jadwal Kelas {$class->name} | OneRoom")

@section('content')
    <div class="card-shadow bg-white m-lg-5 border-radius-8px">
        <div class="card-body">
            <h1>Jadwal kelas {{ $class->name }}</h1>
            <br>
            <form action="{{ route('classes.schedules.index',$class) }}">
                <div class="row">
                    <div class="col-md-2">
                        <select class="form-select" name="weekday">
                            <option value="">Semua Hari</option>
                            <option value="1">Minggu</option>
                            <option value="2">Senin</option>
                            <option value="3">Selasa</option>
                            <option value="4">Rabu</option>
                            <option value="5">Kamis</option>
                            <option value="6">Jumat</option>
                            <option value="7">Sabtu</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <select class="form-select" name="course">
                                <option {{ request('course') ? "" : "selected" }} value="">Semua Mata Pelajaran</option>
                                @foreach ($class->courses as $c)
                                    <option {{ request('course')==$c->id ? "selected":"" }} value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-fill-green" type="submit"><i class='fa fa-search '></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mb-2">
                <div class="col-md-6">
                    <a data-bs-toggle="modal" data-bs-target="#createSchedules" class="btn btn-outline-green">
                        <i class='fa fa-plus '></i> Buat Jadwal Baru
                    </a>
                </div>
            </div>    

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hari</th>
                            <th>Mata Pelajaran</th>
                            <th>Jam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $key => $s )
                            <tr>
                                <th>
                                    <p>{{ $key+1 }}.</p> 
                                </th>
                                <td>
                                    <p>{{ \Carbon\Carbon::parse($s->date)->isoFormat('dddd, D MMMM Y') }}</p> 
                                </td>
                                <td>
                                    <p>{{ $s->course->name }}</p> 
                                </td>
                                <td>
                                    <p>{{ $s->start_time}} - {{ $s->end_time}}
                                    </p> 
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a data-bs-toggle="modal" data-bs-target="#editSchedules{{ $s->id }}" class="btn btn-sm btn-fill-green rounded-pill">Ubah Jadwal</a>
                                        <form action="{{ route('classes.schedules.destroy',[$class,$s]) }}" method="POST">   
                                            @csrf
                                            @method('DELETE')      
                                            <button class="btn" type="submit" onclick="return confirm('Apakah Anda yakin untuk menghapus jadwal {{ $s->course->name }} ?')"><i class='fa fa-trash text-danger'></i></button>
                                        </form>
                                    </div>
                                    @include('schedules._edit')
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @include('schedules._create')
        </div>
    </div>
@endsection