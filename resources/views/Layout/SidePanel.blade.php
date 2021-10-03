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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href={{ asset('css/layout.css') }}>
 
</head>
<body>
    
    <div class="">


        @if(Auth::guest())
            @yield('contentGuest')
        @else
        
            <div class="d-flex">
                <div class="{{ str_contains(url()->current(), '/messages') ? 'resize-side-panel side-panel-menu bg-dark-toska' : 'side-panel-menu bg-dark-toska'  }}">
                    <div class="profile-wrapper">
                        <div class="profile-picture">
                            <img class="img-responsive" src="https://images.pexels.com/photos/771742/pexels-photo-771742.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                        </div>

                    </div>
                    <div class="overflow-hidden">
                        <div class="text-profile">
                            <div class="text-center fw-bold fs-5">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="text-center fs-6"><a href="#" class="text-white text-decoration-none">edit profile</a></div>

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
                                Class
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
                                Announcement
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    @yield('content')
                </div>

            </div>
        @endif
        
    </div>

</body>
</html>