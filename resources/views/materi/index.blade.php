@extends('Layout.SidePanel')

@section('title', 'Materi | OneRoom')

@section('content')

    <h1 class="show-on-dekstop">Materi</h1>

    <div class="d-flex mobile-overflow-hidden">
        <div id="cardMenu" class="mobile-card-menu mobile-w-100 w-200px">
            <!-- <select class="form-select" aria-label="Default select example">
                @foreach( $user_class as $user_classes)
                    <option value="">{{$user_classes->name}}</option>
                @endforeach
            </select> -->
            
            @can ('viewStudent', App\Models\Course::class)
                @foreach($course as $i)
                    <div class="cursor-pointer card-shadow card-box mb-2 {{ isset($courseId) ? $courseId == $i->id ? 'active' : ''  : '' }}" onclick="window.location='{{route('courses.show',$i->id)}}'; openCardMenu()">
                        <div>{{$i->name}}</div>
                        <div class="text-right">{{$i->sessionClasses(Auth::user()->classes->first()->id)->count()}} Materi</div>
                    </div>
                @endforeach
            @endcan

            @can('viewTeacher', App\Models\Course::class)   
                @foreach($user_class as $user_classes)
                    <div class="cursor-pointer card-shadow card-box mb-2 {{ request()->input('class_id') != '' ? request()->input('class_id') == $user_classes->id ? 'active' : ''  : '' }}" onclick="window.location='/teacherCourse?class_id={{$user_classes->id}}'; openCardMenu()">
                        <div>{{$user_classes->name}}</div>
                        <div class="text-right">{{$user_classes->classesCourse->unique()->count()}} Pelajaran</div>
                    </div>
                @endforeach

            @endcan

            @can('viewAdmin', App\Models\Course::class)

                @foreach($user_class as $user_classes)
                    <div class="cursor-pointer card-shadow card-box mb-2" onclick="window.location='/teacherCourse?class_id={{$user_classes->id}}'">
                        <div>{{$user_classes->name}}</div>
                        <div class="text-right">{{$user_classes->classesCourse->unique()->count()}} Pelajaran</div>
                    </div>
                @endforeach

            @endcan
        </div>
        <div id="cardMenu2" class="mobile-ml-0 mobile-card-menu2 mobile-w-100 ml-20 w-85">
        
            @yield('mainContent')

        </div>

    </div>

    <script>
        @if(Request::is('courses/*') || Request::is('teacherCourse*'))
            $(document).ready(function(){
                $("#cardMenu").animate({right: '100%'})
                $("#cardMenu2").animate({left: '0'})
            });
        @endif
    </script>
   
@stop