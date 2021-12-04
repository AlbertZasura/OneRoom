@extends('exams.index')

@section('title', 'Ujian | OneRoom')
@section('mainContent')

<div id="cardMenu2" class="mobile-ml-0 mobile-card-menu2 mobile-w-100 ml-20 w-85 card-shadow bg-white p-3 border-radius-8px" style="margin-right: 1%;">
    <div class="show-on-mobile">
        <div class="d-flex a-center mobile-mb-20">
            <i class="fas fa-arrow-left mr-10 fs-20" onclick="window.history.go(-1); return false;"></i>
            <h1 class="mobile-mb-0">Ujian</h1>
        </div>
    </div>
    <div class="mobile-w-100 w-25">
      
            <div class="mobile-w-100 d-flex" style="width:500px">
                <select class="form-select form-select-lg mb-3 mr-10" id="courseFilter" onchange="getCourse()" aria-label=".form-select-lg example">
                    <option value="all" {{ request()->input('course_id') ? '' : 'selected' }} >Pilih Semua</option>
                    @foreach($course as $it)
                        <option value="{{$it->id}}" {{ request()->input('course_id') ? request()->input('course_id') == $it->id ? 'selected' : '' : '' }}>{{$it->name}}</option>
                    @endforeach
                </select>
    
                @can('viewTeacher', App\Models\Exam::class)
                    <select class="form-select form-select-lg mb-3" id="classFilter" onchange="getClass()" aria-label=".form-select-lg example">
                        <option value="all" {{ request()->input('class_id') ? '' : 'selected' }} >Pilih Semua</option>
                        @foreach($class as $item)
                            <option value="{{$item->id}}" {{ request()->input('class_id') ? request()->input('class_id') == $item->id ? 'selected' : '' : '' }}>{{$item->name}}</option>
                        @endforeach
                    </select>
                @endcan
               
    
            </div>
    
            
    
            {{-- @can('viewStudent', App\Models\Exam::class)
                <h2>{{Auth::user()->classes->first()->name}}</h2>
                @if(request()->input('course_id'))
                    <h2>{{$course->find(request()->input('course_id'))->name}}</h2>
                @else    
                    <h2>Semua Pelajaran</h2>
                @endif
            @endcan
    
            @can('viewTeacher', App\Models\Exam::class )
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
            @endcan --}}
       
    </div>
    @can('viewStudent', App\Models\Exam::class)
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <strong>Note!</strong>  Jika sudah melewati tenggat waktu yang telah di tentukan, anda tidak bisa mengumpulkan ujian lagi!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endcan
    <div class="table-responsive-lg custom-scroll-y" style="max-height: 367px; overflow-y: scroll">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nama Ujian</th>
                    <th scope="col">Waktu Ujian</th>
                    <th scope="col">Aksi</th>
                    @can('viewTeacher', App\Models\Exam::class )
                        <th scope="col">Jumlah Pengumpulan</th>
                    @endcan
                    @can('viewStudent', App\Models\Exam::class)
                        <th scope="col">Nilai</td>
                    @endcan
                    
                </tr>
            </thead>
            <tbody>
                @foreach($exam as $i)
                <tr>
                    @can('viewTeacher', App\Models\Exam::class )
                        <td onclick="window.location='{{route('examsubmitlist',$i->id)}}'">{{$i->title}}</td>
                    @endcan
                    @can('viewStudent', App\Models\Exam::class)
                        <td>{{$i->title}}</td>
                    @endcan
                    @can('viewTeacher', App\Models\Exam::class )
                        <td onclick="window.location='{{route('examsubmitlist',$i->id)}}'">
                            <div><strong>Dari</strong> {{ \Carbon\Carbon::parse($i->start_date)->isoFormat('dddd, D MMMM Y') }}, {{date('H:i', strtotime($i->start_date))}}</div>
                            <div><strong>Sampai</strong> {{ \Carbon\Carbon::parse($i->end_date)->isoFormat('dddd, D MMMM Y') }}, {{date('H:i', strtotime($i->end_date))}}</div>
                        </td>
                    @endcan
                    @can('viewStudent', App\Models\Exam::class)
                        <td>
                            <div> <strong>Dari</strong> {{ \Carbon\Carbon::parse($i->start_date)->isoFormat('dddd, D MMMM Y') }}, {{date('H:i', strtotime($i->start_date))}}</div>
                            <div> <strong>Sampai</strong> {{ \Carbon\Carbon::parse($i->end_date)->isoFormat('dddd, D MMMM Y') }}, {{date('H:i', strtotime($i->end_date))}}</div>
                        </td>
                    @endcan
                    <td class="fs-25">
                        <div class="d-flex a-center">
                            @if(now()->gte($i->start_date))
                                <i class="fas fa-download mr-10 cursor-pointer" onclick="window.location='{{route('downloadexams', $i->id)}}'"></i>
                            @endif
                            @can('viewTeacher', App\Models\Exam::class )
                                <form action="{{ route('exams.destroy',[$i]) }}" onsubmit="deleteExamBtn(event)" id="delteForm" method="POST">   
                                    @csrf
                                    @method('DELETE')     
                                    <button class="btn" type="submit"><i class="far fa-trash-alt text-danger mr-10 cursor-pointer"></i></button>
                                </form>
                            @endcan
                            @can('viewStudent', App\Models\Exam::class)
                                @if(now()->lte($i->end_date))
                                    <i class="fas fa-upload cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal{{$i->id}}"></i>
                                @endif
                                <a data-bs-toggle="modal" data-bs-target="#exams{{ $i->id }}History" class="btn"><i class='fs-25 fas fa-history'></i></a>
                                @include('exams._history')
                            @endcan
                        </div>
                        
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
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    @can('viewTeacher', $i)
                        <td class="cursor-pointer" onclick="window.location='{{route('examsubmitlist',$i->id)}}'">
                            {{$i->users->count()}} / {{count($i->class->first()->users->where('role','like','student'))}} Pengumpulan
                        </td>
                    @endcan
                        
                    @can('viewStudent', App\Models\Exam::class)
                        <td>
                            @if($i->usersExams(Auth::id())->first())
                                <div class="{{(App\Models\Exam::first()->kkm() > $i->usersExams(Auth::id())->first()->pivot->score) ? 'text-danger' : 'text-success'}}">{{$i->usersExams(Auth::id())->first()->pivot->score}}</div>
                            @endif
                        </td>
                    @endcan
                </tr>
        
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function deleteExamBtn(e){
            e.preventDefault();
            var form = document.getElementById("delteForm")
            Swal.fire({
                    title: `Hapus Ujian`,
                    text: "Apakah Anda Yakin ingin menghapus Ujian ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        
        }
    </script>
    
    @can('viewTeacher', App\Models\Exam::class )
    
    <div>
    
        @if(request()->input('class_id') && request()->input('course_id'))
        

            <div class="accordion-item">
                <h2 class="accordion-header" >
                    <button class="accordion-button collapsed accordion-button-none" type="button" onclick="openEditSession()" >
                        <span class="color-hijau-tua fw-bolder d-flex" style="height: 20px;"><i class="far fa-plus-square" style="margin-top: 3px; margin-right: 10px;"></i> <p>Tambah Ujian</p></span>
                    </button>
                </h2>
            </div>
        @else    

            

            <div class="accordion-item bg-grey">
                <h2 class="accordion-header" >
                    <button class="accordion-button collapsed accordion-button-none bg-grey" type="button" >
                        <span class="color-hijau-tua fw-bolder d-flex" style="height: 20px;"><i class="far fa-plus-square" style="margin-top: 3px; margin-right: 10px;"></i> <p>Tambah Ujian</p></span>
                    </button>
                </h2>
                <div class="ml-20 mb-10">

                    @if(request()->input('class_id'))
                        {{-- <div>Ujian akan dibuat untuk kelas <strong>{{$class->find(request()->input('class_id'))->name}}</strong></div> --}}
                    @else    
                        <div class="text-danger">Kelas Belum Dipilih(tolong pilih salah satu kelas melelui filter dibagian atas)</div>
                    @endif
    
                    @if(request()->input('course_id'))
                        <div>Mata pelajaran ujian yang dibuat yaitu <strong>{{$course->find(request()->input('course_id'))->name}}</strong></div>
                    @else    
                        <div class="text-danger">Dan Mata Pelajaran Belum Dipilih(tolong pilih salah satu pelarajaran melelui filter dibagian atas)</div>
                    @endif
                </div>
            </div>

        @endif

    
    </div>
    
    <div class="d-none" id="formEditSession">
        <form class="py-4" action="/exams/createExam?type={{$exType}}&class_id={{request()->input('class_id')}}&course_id={{request()->input('course_id')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="exampleInputEmail1" class="form-label">Nama Ujian</label>
            <input type="text" name="title" value="{{old('title')}}" class="form-control form-input-color" id="exampleInputEmail1" aria-describedby="emailHelp">
            <br>
            <label for="exampleInputEmail1" class="form-label">Waktu Ujian</label>
            
            <div class="d-flex flex-wrap">
                <div class="mr-10"> 
                    <label for="exampleInputEmail1" class="form-label">Mulai</label>
                    <input type="datetime-local" value="{{old('startDate')}}" name="startDate" class="datetimepicker form-control form-input-color" id="deadline" required>
                </div>
                <div>
                <label for="exampleInputEmail1" class="form-label">Berakhir</label>
                    <input type="datetime-local" value="{{old('deadline')}}" name="deadline" class="datetimepicker form-control form-input-color" id="deadline" required>
                </div>
            </div>
    
            <br>
            
            <br>
            <input type="file" name="file_upload" value="{{old('file_upload')}}" class="form-control"><br>
    
            @if(request()->input('class_id') && request()->input('course_id'))
    
                @if(request()->input('class_id'))
                    <span>Ujian akan dibuat untuk kelas <strong>{{$class->find(request()->input('class_id'))->name}}</strong></span>
                @else    
                    <span>Semua Kelas</span>
                @endif
    
                @if(request()->input('course_id'))
                    <span>dan untuk mata pelajarannya yaitu <strong>{{$course->find(request()->input('course_id'))->name}}</strong></span>
                @else    
                    <span>Semua Pelajaran</span>
                @endif
    
                <button type="submit" class="btn bg-hijau-tua text-white rounded-pill form-control mt-20">Unggah Ujian</button>
            @else    
    
                @if(request()->input('class_id'))
                    <div>Ujian akan dibuat untuk kelas <strong>{{$class->find(request()->input('class_id'))->name}}</strong></div>
                @else    
                    <div class="text-danger">Kelas Belum Dipilih(tolong pilih salah satu kelas melelui filter dibagian atas)</div>
                @endif
    
                @if(request()->input('course_id'))
                    <div>Mata pelajaran ujian yang dibuat yaitu <strong>{{$course->find(request()->input('course_id'))->name}}</strong></div>
                @else    
                    <div class="text-danger">Mata Pelajaran Belum Dipilih(tolong pilih salah satu pelarajaran melelui filter dibagian atas)</div>
                @endif
    
                <button class="btn bg-hijau-tua text-white form-control rounded-pill disabled mt-20">Unggah Ujian</button>
    
            @endif
        </form>
    
    </div>
    
    @endcan
    
    <script>
    
        function getCourse(){
            var e = document.getElementById("courseFilter");
            if(e.value == "all"){
                window.location='/exams/list/{{$exType}}'
            }else{
                var url_str = document.URL;
                let url = new URL(url_str);
                let search_params = url.searchParams;
                if(search_params.get('class_id')){
                    window.location='/exams/list/{{$exType}}?course_id=' + e.value + '&class_id=' + search_params.get('class_id');
                }else{
                    window.location='/exams/list/{{$exType}}?course_id=' + e.value
                }
    
            }
        }
    
        function getClass(){
            var e = document.getElementById("classFilter");
            if(e.value == "all"){
                window.location='/exams/list/{{$exType}}'
            }else{
                var url_str = document.URL;
                let url = new URL(url_str);
                let search_params = url.searchParams;
                if(search_params.get('course_id')){
                    window.location='/exams/list/{{$exType}}?course_id=' + search_params.get('course_id') + '&class_id=' + e.value;
                }else{
                    window.location='/exams/list/{{$exType}}?class_id=' + e.value
                }

            }
        }
    
        function openEditSession(){
            
            document.getElementById("formEditSession").classList.toggle("d-none");
        }
    </script>
           

</div>



@stop