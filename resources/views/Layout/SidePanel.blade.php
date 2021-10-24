<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/fullcalendar.css') }}" rel='stylesheet' />
    <link href="{{ asset('css/fullcalendar.print.css') }}" rel='stylesheet' media='print'/>
    <script src="https://kit.fontawesome.com/6538af5efe.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-1.10.2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery-ui.custom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/fullcalendar.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('js/mainscript.js')}}"></script> --}}

</head>
<body>
    
    @if(Auth::guest())
        <div class="container">
            @include('sweetalert::alert')
            @yield('contentGuest')
        </div>
    @else
        <div class="d-flex">
            <div class="{{ str_contains(url()->current(), '/dashboard') ?  'side-panel-menu bg-dark-toska' : 'resize-side-panel side-panel-menu bg-dark-toska'  }}">
                <div class="profile-wrapper">
                    <div class="profile-picture">
                        <img class="img-responsive" src="https://images.pexels.com/photos/771742/pexels-photo-771742.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                    </div>

                </div>
                <div class="overflow-hidden">
                    <div class="text-profile">
                        <div class="text-center fw-bold fs-5" style="white-space: nowrap;">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="text-center fs-6 edit-prof-wrap"><a href="#" class="text-white text-decoration-none">edit profile</a></div>

                    </div>

                </div>
                <div class="list-panel-menu mt-20">
                    <div class="d-flex a-center mb-10">
                        <div class="fs-25 w-25px">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <a href="{{route('home')}}" class="btn text-white">Dashboard</a>
                        </div>
                    </div>
                    <div class="d-flex a-center mb-10">
                        <div class="fs-25 w-25px">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            @can('schedulesChart', App\Models\Schedule::class )
                                <a href="/schedules" class="btn text-white">Jadwal</a>
                            @endcan
                            @can('listClass', App\Models\Schedule::class )
                                <a href="/schedules/all" class="btn text-white">Jadwal</a>
                            @endcan
                        </div>
                    </div>
                    @can('viewAny', App\Models\Assignment::class )
                        <div class="d-flex a-center mb-10">
                            <div class="fs-25 w-25px">
                                <i class="fas fa-pencil-ruler"></i>
                            </div>
                            <div class="fs-18 ml-20">
                                <a href="/assignments" class="btn text-white">Tugas</a>
                            </div>
                        </div>
                    @endcan
                    <div class="d-flex a-center mb-10">
                        <div class="fs-25 w-25px">
                            <i class="fas fa-paste"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <a href="{{route('exams.index')}}" class="btn text-white">Exam</a>
                            
                        </div>
                    </div>
                    <div class="d-flex a-center mb-10">
                        <div class="fs-25 w-25px">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <a href="{{route('courses.index')}}" class="btn text-white">Courses</a>
                            
                        </div>
                    </div>
                    <div class="d-flex a-center mb-10">
                        <div class="fs-20 w-25px">
                            <i class="fas fa-chalkboard"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <a href="{{route('classes.index')}}" class="btn text-white">Class</a>
                        </div>
                    </div>
                    <div class="d-flex a-center mb-10">
                        <div class="fs-25 w-25px">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <a href="#" class="btn text-white">Absen</a>
                            
                        </div>
                    </div>
                    <div class="d-flex a-center mb-10">
                        <div class="fs-20 w-25px">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <a href="{{route('messages.index')}}" class="btn text-white">Announcement</a>
                        </div>
                    </div>
                    @if (Auth::user())
                    <div class="d-flex a-center mb-10">
                        <div class="fs-20 w-25px">
                            <i class="fs-20 fas fa-sign-out-alt"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <form action="/logout" method="POST">   
                                @csrf
                                <button type="submit" class="btn text-white">Logout</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="{{ str_contains(url()->current(), '/dashboard') ?  'w-100' : 'ml-70 w-100'  }}">
                @include('components.notifications')
                @include('sweetalert::alert')
                @yield('content')
            </div>

        </div>
    @endif
</body>
</html>