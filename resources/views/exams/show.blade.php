@extends('exams.index')


@section('mainContent')

<div class="w-25">
  
        <div class="d-flex">
            <select class="form-select form-select-lg mb-3" id="courseFilter" onchange="getCourse()" aria-label=".form-select-lg example">
                <option selected>Pilih Pelajaran</option>
                @foreach($course as $it)
                    <option value="{{$it->id}}">{{$it->name}}</option>
                @endforeach
            </select>
    
            <select class="form-select form-select-lg mb-3" id="classFilter" onchange="getClass()" aria-label=".form-select-lg example">
                <option selected>pilih kelas</option>
                @foreach($class as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>

        </div>
        @if(request()->input('class_id'))
            <h2>{{$class->find(request()->input('class_id'))->name}}</h2>
        @else    
            <h2>Semua Kelas</h2>
        @endif

        @if(request()->input('course_id'))
            <h2>{{$course->find(request()->input('course_id'))->name}}</h2>
        @else    
            <h2>Semua Pelajaran</h2>
        @endif
   
</div>


<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">nama ujian</th>
            <th scope="col">waktu ujian</th>
            <th scope="col">action</th>
            <th scope="col">jumlah pengumpulan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($exam as $i)
        <tr>
            <td onclick="window.location='{{route('examsubmitlist',$i->id)}}'">{{$i->title}}</td>
            <td onclick="window.location='{{route('examsubmitlist',$i->id)}}'">
                <div>Dari {{date('d-m-Y', strtotime($i->start_date))}} {{date('H:i', strtotime($i->start_date))}}</div>
                <div>Sampai {{date('d-m-Y', strtotime($i->end_date))}} {{date('H:i', strtotime($i->end_date))}}</div>
            </td>
            <td class="fs-25">
                <i class="fas fa-download mr-10 cursor-pointer" onclick="window.location='{{route('downloadexams', $i->id)}}'"></i>
                <i class="fas fa-plus mr-10 cursor-pointer"></i>
                <i class="fas fa-upload cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal{{$i->id}}"></i>
                
                <div class="modal fade" id="exampleModal{{$i->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$i->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{$i->id}}">Unggah {{$i->type}} {{$i->title}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <form action="/exams/submitExam?e={{$i->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="modal-body">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <label for="note86" class="col-form-label">Notes</label>
                                        </div>
                                        <div class="col-auto">
                                            <input type="text"  name="notes" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="file" name="file_upload" class="form-control" id="inputGroupFile01">
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
            </td>
            <td>
                {{$i->users->count()}}
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

<div>

    <div class="accordion-item">
        <h2 class="accordion-header" >
            <button class="accordion-button collapsed accordion-button-none" type="button" onclick="openEditSession()" >
                <span class="text-navi fw-bolder d-flex" style="height: 20px;"><i class="far fa-plus-square" style="margin-top: 3px; margin-right: 10px;"></i> <p>Tambah Ujian</p></span>
            </button>
        </h2>
    </div>

</div>

<div class="d-none" id="formEditSession">
    <form action="/exams/createExam?type={{$exType}}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="exampleInputEmail1" class="form-label">Nama Ujian</label>
        <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <br>
        <label for="exampleInputEmail1" class="form-label">Waktu Ujian</label>
        
        <input type="datetime-local" name="startDate" class="datetimepicker form-control" id="deadline" required>
        <input type="datetime-local" name="deadline" class="datetimepicker form-control" id="deadline" required>

        <br>
        
        <br>
        <input type="file" name="file_upload" class="form-control"><br>
        <button type="submit" class="btn btn-dark form-control">Upload Now</button>
    </form>

</div>

<script>

    function getCourse(){
        var e = document.getElementById("courseFilter");
        var url_str = document.URL;
        let url = new URL(url_str);
        let search_params = url.searchParams;
        if(search_params.get('class_id')){
            window.location='/exams/list/{{$exType}}?course_id=' + e.value + '&class_id=' + search_params.get('class_id');
        }else{
            window.location='/exams/list/{{$exType}}?course_id=' + e.value
        }
    }

    function getClass(){
        var e = document.getElementById("classFilter");
        var url_str = document.URL;
        let url = new URL(url_str);
        let search_params = url.searchParams;
        if(search_params.get('course_id')){
            window.location='/exams/list/{{$exType}}?course_id=' + search_params.get('course_id') + '&class_id=' + e.value;
        }else{
            window.location='/exams/list/{{$exType}}?class_id=' + e.value
        }
    }

    function openEditSession(){
        
        document.getElementById("formEditSession").classList.toggle("d-none");
    }
</script>
       


@stop