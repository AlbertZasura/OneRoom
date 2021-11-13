@extends('Layout.SidePanel')

@section('title', 'Materi')

@section('content')

    <h1>Materi</h1>
    <br>
    <br>

    <div class="d-flex">
        <div class="w-200px">
            <!-- <select class="form-select" aria-label="Default select example">
                @foreach( $user_class as $user_classes)
                    <option value="">{{$user_classes->name}}</option>
                @endforeach
            </select> -->
            
            @can ('viewStudent', App\Models\Course::class)
                @foreach($course as $i)
                    <div class="cursor-pointer card-box mb-2" onclick="window.location='{{route('courses.show',$i->id)}}'">
                        <div>{{$i->name}}</div>
                        <div class="text-right">{{$i->sessionClasses(Auth::user()->classes->first()->id)->count()}} Materi</div>
                    </div>
                @endforeach
            @endcan

            @can('viewTeacher', App\Models\Course::class)

                @foreach($user_class as $user_classes)
                    <div class="cursor-pointer card-box mb-2" onclick="window.location='/teacherCourse?class_id={{$user_classes->id}}'">
                        <div>{{$user_classes->name}}</div>
                        <div class="text-right">{{$user_classes->classesCourse->unique()->count()}} Pelajaran</div>
                    </div>
                @endforeach

            @endcan

            @can('viewAdmin', App\Models\Course::class)

                @foreach($user_class as $user_classes)
                    <div class="cursor-pointer card-box mb-2" onclick="window.location='/teacherCourse?class_id={{$user_classes->id}}'">
                        <div>{{$user_classes->name}}</div>
                        <div class="text-right">{{$user_classes->classesCourse->unique()->count()}} Pelajaran</div>
                    </div>
                @endforeach

            @endcan
        </div>
        <div class="ml-20 w-85">
            
            @yield('mainContent')

        </div>

    </div>
  
    

@stop