<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6538af5efe.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    {{-- <script src="{{ asset('js/mainscript.js')}}"></script> --}}

</head>
<body>
    
    <div class="">

        @if(Auth::guest())
        <div class="container">
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
                                dashboard
                            </div>
                        </div>
                        <div class="d-flex a-center mb-10">
                            <div class="fs-25 w-25px">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <div class="fs-18 ml-20">
                                Schedule
                            </div>
                        </div>
                        <div class="d-flex a-center mb-10">
                            <div class="fs-25 w-25px">
                                <i class="fas fa-pencil-ruler"></i>
                            </div>
                            <div class="fs-18 ml-20">
                                Assignment
                            </div>
                        </div>
                        <div class="d-flex a-center mb-10">
                            <div class="fs-25 w-25px">
                                <i class="fas fa-paste"></i>
                            </div>
                            <div class="fs-18 ml-20">
                                Exam
                            </div>
                        </div>
                        <div class="d-flex a-center mb-10">
                            <div class="fs-25 w-25px">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="fs-18 ml-20">
                                Courses
                            </div>
                        </div>
                        <div class="d-flex a-center mb-10">
                            <div class="fs-20 w-25px">
                                <i class="fas fa-chalkboard"></i>
                            </div>
                            <div class="fs-18 ml-20">
                                <a href="{{route('classes.index')}}" class="text-white">Class</a>
                            </div>
                        </div>
                        <div class="d-flex a-center mb-10">
                            <div class="fs-25 w-25px">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <div class="fs-18 ml-20">
                                Absen
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
                                @csrf
                                <form action="/logout" method="POST">   
                                    <button type="submit" class="btn text-white">Logout</button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="{{ str_contains(url()->current(), '/dashboard') ?  '' : 'ml-70'  }}">
                    @yield('content')
                </div>

            </div>
        @endif
        
    </div>

</body>
</html>