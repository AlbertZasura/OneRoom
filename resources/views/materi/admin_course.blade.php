@extends('Layout.SidePanel')

@section('title', 'Materi')

@section('content')

<div class="container">

    <h1>Materi</h1>

    
    <div class="row">
        <div class="col">
            <div class="text-center fw-bold fs-20 mb-3">Mata Pelajaran</div>
            
            <div class="box-course-create scroll-y custom-scroll-y" style="height: 600px;">
                <div>
                <button type="button" class="btn w-100 border-2px btn-add-course" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus mr-10"></i> <span>Tambah Mata Palajaran</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="course/createCourse" method="POST">
                                @csrf
                                    <div class="modal-body">
                                        <div>
                                            <label class="col-form-label">Nama Mata Pelajaran</label>
                                            <input type="text" name="name" class="form-control" >
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
                </div>
                </div>
                @foreach($course as $courses)
                <label onclick="selectedCourse()" class="radio-course cursor-pointer text-center border-bottom-gray hover-gray">
                    <input type="radio" name="radiocourse" value="{{$courses->id}}"/>
                    <div class="py-2">{{$courses->name}}</div>
                </label>
                    <!-- <div class="option-course cursor-pointer text-center border-bottom-gray py-2 hover-gray" onclick="selectedCourse( {{$courses}} )">{{$courses->name}}</div> -->
                @endforeach
            </div>
        </div>
    
        <div class="col">
            <div class="text-center fw-bold fs-20 mb-3">Guru</div>
            <div class="box-course-create scroll-y custom-scroll-y" style="height: 600px;">
                @foreach($teacher as $teachers)
                    <label onclick="selectedTeacher()" class="radio-course cursor-pointer text-center border-bottom-gray hover-gray">
                        <input type="radio" name="radioteacher" value="{{$teachers->id}}"/>
                        <div class="py-2">{{$teachers->name}}</div>
                    </label>
                    <!-- <div class="option-teacher cursor-pointer text-center border-bottom-gray py-2 hover-gray" onclick="selectedTeacher( {{$teachers}} )">{{$teachers->name}}</div> -->
                @endforeach
            </div>
        </div>
    
        <div class="col">
            <div class="text-center fw-bold fs-20 mb-3">Kelas</div>
            <div class="box-course-create scroll-y custom-scroll-y" style="height: 600px;">
            @isset($selectedTeacher)
                <div>Pilih Kelas Yang akan di ajar oleh <strong>{{$selectedTeacher->name}}</strong> dengan mata pelajaran <strong>{{$selectedCourse->name}}</strong></div>
            @endisset
            @if($class)
                @foreach($class as $classes)
                    <label onclick="selectedClass()" class="radio-course cursor-pointer text-center border-bottom-gray hover-gray">
                        <input type="radio" name="radioclass" value="{{$classes->id}}"/>
                        <div class="py-2">{{$classes->name}}</div>
                    </label>
                    <!-- <div class="option-class cursor-pointer text-center border-bottom-gray py-2 hover-gray" onclick="selectedClass( {{$classes}} )">{{$classes->name}}</div> -->
                @endforeach
            @else
                <div>Kelas Tidak Tersedia atau guru belum ditentukan penempatan kelasnya</div>
            @endif
            </div>
        </div>
    
    </div>

    <div class="d-flex justify-content-end mt-20" onclick="save()">
        <button class="btn save-btn-1"> Save </button>
    </div>

    

</div>

<script>

    var courseValue = '';
    var teacherValue = '';
    var classValue = '';

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
                console.log("teacherValue ", teacherValue)
                console.log("courseValue ", courseValue)
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
                console.log("teacherValue ", teacherValue)
                console.log("courseValue ", courseValue)
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