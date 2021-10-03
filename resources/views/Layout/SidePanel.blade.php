<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6538af5efe.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .w-50{
            width: 50%;
        }
        .d-flex{
            display: flex;
        }
        .a-center{
            align-items: center;
        }
        .bg-dark-toska{
            background: #278EA5;
        }
        .side-panel-menu{
            width: 254px;
            padding: 20px 20px;
            color: #fff;
            height: 100%;
        }
        .img-responsive{
            width: 100%;
            height: auto;
        }
        .profile-picture{
            width: 150px;
            height: 150px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 50%;
        }
        .text-center{
            text-align: center;

        }
        .text-white{
            color: #fff;
        }
        .text-decoration-none{
            text-decoration: none;
        }
        .fs-25{
            font-size: 25px;
        }
        .fs-20{
            font-size: 20px;
        }
        .fs-18{
            font-size: 18px;
        }
        .ml-20{
            margin-left: 20px;
        }
        .mt-20{
            margin-top: 20px;
        }
        .w-25px{
            width: 25px;
        }
        .mb-10{
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    
    <div class="container">
        @if(Auth::guest())
            @yield('contentGuest')
        @else
        
            <div class="d-flex">
                <div class="side-panel-menu bg-dark-toska">
                    <div class="profile-picture">
                        <img class="img-responsive" src="https://images.pexels.com/photos/771742/pexels-photo-771742.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                    </div>
                    <div class="text-center fw-bold fs-5">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="text-center fs-6"><a href="#" class="text-white text-decoration-none">edit profile</a></div>
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