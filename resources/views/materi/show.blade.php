@extends('materi.index')
@section('title', 'Materi | OneRoom')
@section('mainContent')

@can('viewTeacher', App\Models\Course::class)
<div class=" card-shadow bg-white p-3 border-radius-8px">
    <div class="show-on-mobile">
        <div class="d-flex a-center mobile-mb-20">
            <i class="fas fa-arrow-left mr-10 fs-20" onclick="window.history.go(-1); return false; closeCardMenu()"></i>
            <h1 class="mobile-mb-0">Materi</h1>
        </div>
    </div>
        <select id="courseSelect" class="form-select mb-3" aria-label="Default select example" onchange="chooseSession(); openCardMenu()">
            @foreach($course_teacher as $course_teachers)
            
                @if( $course_teachers->pivot->user_id == Auth::id())
                    <option value="{{$course_teachers->id}}" {{ isset($selected_course) ? $selected_course->id == $course_teachers->id ? 'selected' : '' : ''}} >{{$course_teachers->name}}</option>
                @endif
            @endforeach
        </select>

        @if($ses->count() == 0)
            <div class="text-center mt-20 mb-10 pb-20">
                <h3>Tidak ada materi yang tersedia.</h3>
            </div>
        @endif
        
        @if(isset($ses))
            <div class="scroll-y custom-scroll-y" style="max-height: 444px;">
                @foreach($ses as $item)
                    <div class="mb-10">
                        <div class="accordion-item">
                            <h2 class="accordion-header d-flex a-center" id="heading{{$item->id}}">
                                <i onclick="deleteSessionBtn( {{$item->id}} ) ; openCardMenu()" class="ml-20 fs-20 far fa-trash-alt text-danger mr-10 cursor-pointer"></i>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$item->id}}" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="color-hijau-tua fw-bolder">{{$item->title}}</span>
                                </button>
                            </h2>
                            <div id="collapse{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$item->id}}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>{{$item->description}}</p>
                                    <p class="color-hijau-tua m-0"><i class="fas fa-scroll mr-10"></i> <span>Unduh Materi</span></p>
                                    <a href="{{route('uploaded',$item->id)}}" target="_blank"><small>{{ $item->file }}</small></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <span>No Data</span>
        @endif
                <div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" >
                            <button class="accordion-button collapsed accordion-button-none" type="button" onclick="openEditSession(); openCardMenu()" >
                                <span class="color-hijau-tua fw-bolder d-flex" style="height: 20px;"><i class="far fa-plus-square" style="margin-top: 3px; margin-right: 10px;"></i> <p>Tambah Materi</p></span>
                            </button>
                        </h2>
                    </div>
    
                </div>
                <div class="d-none" id="formEditSession">
                    <form class="py-4" action="/session/insert?class_id={{$seletedClass->id}}&course_id={{isset($selected_course) ? $selected_course->id : $course_teacher->first()->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="exampleInputEmail1" class="form-label">Nama Materi</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control form-input-color" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        <br>
                        <label for="exampleInputEmail1" class="form-label">Deskripsi Materi</label>
                        <input type="text" name="description" value="{{ old('description') }}" class="form-control form-input-color" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        <br>
                        <input type="file" name="file_upload" id="" class="form-control " required><br>
                        <button type="submit" class="btn bg-hijau-tua text-white rounded-pill form-control mt-20">Unggah Materi</button>
                    </form>
    
                </div>
    
                <script>
                    function deleteSessionBtn(id,user){
                        Swal.fire({
                                title: `Hapus Materi`,
                                text: "Apakah Anda Yakin ingin menghapus Materi Pelajarn ini?",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonText: 'Ya',
                                cancelButtonText: 'Tidak',
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                window.location = '/session/delete/' + id ;
                            }
                        });
                    
                    }
                </script>
        
        
    </div>
@endcan


@can ('viewStudent', App\Models\Course::class)

<div class="card-shadow bg-white p-3 border-radius-8px">
    <div class="show-on-mobile">
        <div class="d-flex a-center mobile-mb-20">
            <i class="fas fa-arrow-left mr-10 fs-20" onclick="window.history.go(-1); return false; closeCardMenu()"></i>
            <h1 class="mobile-mb-0">Materi</h1>
        </div>
    </div>
    <div class="d-flex">
        <h2>{{$cls->first()->name}}</h2>
        <h2 class="mx-3">{{$selectedCourse->name}}</h2>
    </div>

    @if($ses->count() == 0)
        <div class="text-center mt-20 mb-10 pb-20">
            <h3>Tidak ada materi yang tersedia.</h3>
        </div>
    @endif
    
    @if(isset($ses))
    
        @foreach($ses as $item)
            
            <div class="mb-10">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{$item->id}}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$item->id}}" aria-expanded="false" aria-controls="collapseTwo">
                            <span class="color-hijau-tua fw-bolder">{{$item->title}}</span>
                        </button>
                    </h2>
                    <div id="collapse{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$item->id}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div>{{$item->description}}</div>
                            <div onclick="window.location='{{route('uploaded',$item->id)}}'; openCardMenu()" class="cursor-pointer d-flex a-center color-hijau-tua view-session">
                                <i class="fas fa-scroll mr-10"></i> <span>Lihat Materi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @can('view', $course->first())
            <div>
                <div class="accordion-item">
                    <h2 class="accordion-header" >
                        <button class="accordion-button collapsed accordion-button-none" type="button" onclick="openEditSession(); openCardMenu()" >
                            <span class="color-hijau-tua fw-bolder d-flex" style="height: 20px;"><i class="far fa-plus-square" style="margin-top: 3px; margin-right: 10px;"></i> <p>Tambah Materi</p></span>
                        </button>
                    </h2>
                </div>
    
            </div>
            <div class="d-none" id="formEditSession">
                <form action="/session" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="exampleInputEmail1" class="form-label">title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <br>
                    <label for="exampleInputEmail1"  class="form-label">description</label>
                    <input type="text" name="description" value="{{ old('description') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <br>
                    <input type="file" name="file_upload" id="" class="form-control" required><br>
                    <input type="text" name="coId" value="{{$courseId}}" class="d-none">
                    <button type="submit" onclick="; closeCardMenu()" class="btn btn-dark form-control">Upload Now</button>
                </form>
    
            </div>
        @endcan
    @else
        <span>Tidak ada Materi yang tersedia</span>
    @endif
</div>


@endcan


@can('viewAdmin', App\Models\Course::class)

    @foreach($ses as $item)
            
        <div class="mb-10">
            <div class="accordion-item">
                <h2 class="accordion-header d-flex a-center" id="heading{{$item->id}}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$item->id}}" aria-expanded="false" aria-controls="collapseTwo">
                        <span class="color-hijau-tua fw-bolder">{{$item->title}}</span>
                    </button>
                </h2>
                <div id="collapse{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$item->id}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div>{{$item->description}}</div>
                        <div onclick="window.location='{{route('uploaded',$item->id)}}'; openCardMenu()" class="cursor-pointer d-flex a-center color-hijau-tua view-session">
                            <i class="fas fa-scroll mr-10"></i> <span>Lihat Materi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endcan


    <script>

        function chooseSession(){
            var url_str = document.URL;
            let url = new URL(url_str);
            let search_params = url.searchParams;
            var class_id = search_params.get('class_id');
            var course = document.getElementById("courseSelect").value;
            
            window.location = '/teacherFilterCourse?class_id=' + class_id + '&course_id=' + course;
        }

        function openEditSession(){
            document.getElementById("formEditSession").classList.toggle("d-none");
        }
    </script>

@stop