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
                    <div class="option-course cursor-pointer text-center border-bottom-gray py-2 hover-gray" onclick="selectedCourse( {{$courses}} )">{{$courses->name}}</div>
                @endforeach
            </div>
        </div>
    
        <div class="col">
            <div class="text-center fw-bold fs-20 mb-3">Guru</div>
            <div class="box-course-create scroll-y custom-scroll-y" style="height: 600px;">
                @foreach($teacher as $teachers)
                    <div class="option-teacher cursor-pointer text-center border-bottom-gray py-2 hover-gray" onclick="selectedTeacher( {{$teachers}} )">{{$teachers->name}}</div>
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
                    <div class="option-class cursor-pointer text-center border-bottom-gray py-2 hover-gray" onclick="selectedClass( {{$classes}} )">{{$classes->name}}</div>
                @endforeach
            @else
                <div>Kelas Tidak Tersedia atau guru belum ditentukan penempatan kelasnya</div>
            @endif
            </div>
        </div>
    
    </div>

</div>

<script>

    var courseValue = '';
    var teacherValue = '';
    var classValue = '';

$(document).ready(
function()
    {
        $(".option-course").click(function(event)
        {
            // function selectedCourse(objCourse){
            //     console.log(objCourse);
            // }
            console.log(courseValue)
            $(this).addClass("active").siblings().removeClass("active");
        }
        );

        $(".option-teacher").click(function(event)
        {
            console.log(teacherValue)
            $(this).addClass("active").siblings().removeClass("active");
        }
        );

        $(".option-class").click(function(event)
        {
            console.log(classValue)
            if($(this).hasClass("active")){
                $(this).removeClass("active")
            }else{
                $(this).addClass("active")
            }
        }
        );

        // if(courseValue && teacherValue){

            // $.ajax({
            //     url: 'courses?selectClass=1',
            //     method: 'post',
            //     success: function () {
            //         console.log("done");
            //         //do something
            //     },error: function(xhr, ajaxOptions, thrownError){
            //             console.log(xhr.status+" ,"+" "+ajaxOptions+", "+thrownError);
            //         }
            //     }
            // }); 
            
        // }


    });


    function selectedCourse(objCourse){
        courseValue = objCourse
        if(courseValue && teacherValue){

            window.location = 'courses?selectClass=1&selectTeacherId=' + teacherValue.id + '&selectCourseId=' + courseValue.id;
            

        }
    }

    function selectedTeacher(objTeacher){
        teacherValue = objTeacher
        if(courseValue && teacherValue){

            window.location = 'courses?selectClass=1&selectTeacherId=' + teacherValue.id + '&selectCourseId=' + courseValue.id;

            // $.ajax({
            //     url: 'courses?selectClass=1',
            //     method: 'get',
            //     success: function (_response) {
            //         $class = _response;
            //         console.log("done ", _response);
            //     }
            // }); 
            
        }
    }

    function selectedClass(objClass){
        classValue = objClass
    }

    // $.ajax({
    //         url: 'fetch-data',
    //         method: 'post',
    //         success: function () {
    //             console.log("done");
    //             //do something
    //         },error: function(xhr, ajaxOptions, thrownError){
    //                 console.log(xhr.status+" ,"+" "+ajaxOptions+", "+thrownError);
    //             }
    //         }
    //     }); 


</script>

  
    

@stop