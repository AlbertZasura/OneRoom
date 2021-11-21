@extends('Layout.SidePanel')

@section('title', 'Materi | OneRoom')

@section('content')
<h1>Mapping</h1>
<br>

<div class="container">

    <!-- <h1>Mapping Mata Pelajaran</h1> -->

    <div class="row">
        <div class="col mobile-col-none mobile-w-100">
            <div class="text-center fw-bold fs-20 mb-3">Mata Pelajaran</div>
            
            <div class="box-course-create scroll-y custom-scroll-y" style="height: 600px;">
                <div>
                <button type="button" class="btn w-100 border-2px btn-add-course" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus mr-10"></i> <span>Tambah Mata Pelajaran</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          
                            <div class="modal-body">
                                <div class="d-flex justify-content-between a-center px-2">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="course/createCourse" method="POST">
                                @csrf
                                    <div class="modal-body">
                                        <div>
                                            <label class="col-form-label">Nama Mata Pelajaran</label>
                                            <input type="text" name="name" class="form-control form-input-color" >
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-green rounded-pill px-20px" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-fill-green rounded-pill px-20px">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                @foreach($course as $courses)
                    <div class="d-flex a-center">
                        <form action="{{ route('courses.destroy',[$courses]) }}" method="POST">   
                            @csrf
                            @method('DELETE')     
                            <button class="btn show-alert" type="submit"><i class="far fa-trash-alt text-danger mr-10 cursor-pointer"></i></button>
                        </form>
                        <div class="w-100">
                            <label onclick="selectedCourse()" class="radio-course cursor-pointer text-center border-bottom-gray hover-gray">
                                <input type="radio" name="radiocourse" value="{{$courses->id}}" {{ isset($selectedCourse) ? $selectedCourse->id == $courses->id ? 'checked' : '' : ''}}/>
                                <div class="py-2">{{$courses->name}}</div>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    
        <div class="col mobile-col-none mobile-w-100">
            <div class="text-center fw-bold fs-20 mb-3">Guru</div>
            <div class="box-course-create scroll-y custom-scroll-y" style="height: 600px;">
                @foreach($teacher as $teachers)
                    <label onclick="selectedTeacher()" class="radio-course cursor-pointer text-center border-bottom-gray hover-gray">
                        <input type="radio" name="radioteacher" value="{{$teachers->id}}" {{ isset($selectedTeacher) ? $selectedTeacher->id == $teachers->id ? 'checked' : '' : ''}} />
                        <div class="py-2">{{$teachers->name}}</div>
                    </label>
                @endforeach
            </div>
        </div>
    
        <div class="col mobile-col-none mobile-w-100">
            <div class="text-center fw-bold fs-20 mb-3">Kelas</div>
            <div class="box-course-create scroll-y custom-scroll-y" style="height: 600px;">

            @if(request()->input('selectTeacherId') && request()->input('selectCourseId'))
                @if(count($class) == 0)
                    <div class="text-danger">Kelas Tidak ditemukan, mohon untuk bisa menempatkan guru di dalam kelas terlebih dahulu</div>
                @else
                    @isset($selectedTeacher)
                        <div>Pilih Kelas Yang akan di ajar oleh <strong class="text-blue">{{$selectedTeacher->name}}</strong> dengan mata pelajaran <strong class="text-blue">{{$selectedCourse->name}}</strong></div>
                    @endisset
                @endif

            @endif

            

            @php ($flag = 0)
            
            @if($class)
                @foreach($class as $classes)
                    @if(count($exist_class) > 0)
                        @foreach($exist_class as $key => $ex_cls)
                            @if($ex_cls->pivot->course_id == $selectedCourse->id)
                                    @if($ex_cls->id == $classes->id)
                                        <div class="d-flex a-center">
                                            <button class="btn" onclick="deleteClassBtn( {{$classes->id}}, {{$selectedTeacher->id}} )"><i class="far fa-trash-alt text-danger mr-10 cursor-pointer"></i></button>
                                            <div class="w-100">
                                                <label onclick="selectedClass()" class="radio-course cursor-pointer text-center border-bottom-gray hover-gray bg-success text-white">
                                                    <input type="radio" name="radioclass" value="{{$classes->id}}"/>
                                                    <div class="py-2">{{$classes->name}}</div>
                                                </label>
                                                
                                            </div>
                                        </div>
                                        @php ($flag = 0)
                                        @break
                                    @else
                                        @php ($flag = 1)
                                    
                                    @endif
                                @else
                                    @php ($flag = 1)
                                @endif
                            @endforeach

                        
                        @if($flag == 1)
                            <label onclick="selectedClass()" class="radio-course cursor-pointer text-center border-bottom-gray hover-gray">
                                <input type="radio" name="radioclass" value="{{$classes->id}}"/>
                                <div class="py-2">{{$classes->name}}</div>
                            </label>
                            @php ($flag = 0)
                        @endif()
                    @else
                    <div></div>
                        <label onclick="selectedClass()" class="radio-course cursor-pointer text-center border-bottom-gray hover-gray">
                            <input type="radio" name="radioclass" value="{{$classes->id}}"/>
                            <div class="py-2">{{$classes->name}}</div>
                        </label>
                    @endif
                @endforeach
            @else
                <div></div>
            @endif
            </div>
        </div>
    
    </div>

    <div class="d-flex justify-content-end mt-20" onclick="save()">
        <button class="btn btn-fill-green rounded-pill px-4"> Simpan </button>
    </div>

    

</div>



<script>

    var courseValue = '';
    var teacherValue = '';
    var classValue = '';

    $(document).ready(function(){
        var url_str = document.URL;
        let url = new URL(url_str);
        let search_params = url.searchParams;
        if(search_params.get('selectTeacherId') && search_params.get('selectCourseId')){
            teacherValue = search_params.get('selectTeacherId');
            courseValue = search_params.get('selectCourseId');

        }
    });


    $('.show-alert').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          Swal.fire({
                title: `Hapus Mata Pelajaran`,
                text: "Apakah Anda Yakin ingin menghapus mata pelajaran ini?",
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
      });

      function deleteClassBtn(id,user){
        Swal.fire({
                title: `Hapus Kelas`,
                text: "Apakah Anda Yakin ingin menghapus Kelas ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
          })
          .then((result) => {
            if (result.isConfirmed) {
                window.location = 'course/delete/teacherClass?class_id=' + id + '&user_id=' + user;
            }
          });
        
      }
    
      
    function save(){
        var url_str = document.URL;
        let url = new URL(url_str);
        let search_params = url.searchParams;
        var teacherId = search_params.get('selectTeacherId');
        var courseId = search_params.get('selectCourseId');
        window.location = 'course/assign?selectTeacherId=' + teacherId + '&selectCourseId=' + courseId +'&selectedClass=' + classValue;
    }


    function selectedCourse(){
        var radiocourse = document.getElementsByName('radiocourse');

        for (var i = 0, length = radiocourse.length; i < length; i++) {
            if (radiocourse[i].checked) {
                courseValue = radiocourse[i].value
                break;
            }
        }

        
        if(courseValue && teacherValue){

            window.location = 'courses?selectClass=1&selectTeacherId=' + teacherValue + '&selectCourseId=' + courseValue;
            // window.location = 'courses?selectClass=1&selectTeacherId=' + teacherValue.id + '&selectCourseId=' + courseValue.id;
            

        }
    }

    function selectedTeacher(){
        var radioteacher = document.getElementsByName('radioteacher');

        for (var i = 0, length = radioteacher.length; i < length; i++) {
            if (radioteacher[i].checked) {
                teacherValue = radioteacher[i].value
                if(courseValue && teacherValue){

                    // window.location = 'courses?selectClass=1&selectTeacherId=' + teacherValue.id + '&selectCourseId=' + courseValue.id;
                    window.location = 'courses?selectClass=1&selectTeacherId=' + teacherValue + '&selectCourseId=' + courseValue;


                }
                break;
            }
        }
        
    }

    function selectedClass(){
        var radioclass = document.getElementsByName('radioclass');
        
        for (var i = 0, length = radioclass.length; i < length; i++) {
            if (radioclass[i].checked) {
                classValue = radioclass[i].value
                console.log("radioclass ", classValue)
                break;
            }
        }
       
    }




</script>

  
    

@stop