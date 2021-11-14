<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link href="{{ asset('css/fullcalendar.css') }}" rel='stylesheet' />
    <link href="{{ asset('css/fullcalendar.print.css') }}" rel='stylesheet' media='print'/>
    <script src="https://kit.fontawesome.com/6538af5efe.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
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
            <div class="{{ str_contains(url()->current(), '/dashboard') ?  'side-panel-menu bg-hijau-tua' : 'resize-side-panel side-panel-menu bg-hijau-tua'  }}">
                <div class="profile-wrapper px-20px pt-20">
                    <div class="profile-picture">
                        @if(Auth::user()->profile_picture) 
                            <img class="w-auto h-100" src="{{ asset('storage/images/'.Auth::user()->profile_picture) }}" alt="">
                        @else
                            <img class="w-auto h-100" src="{{ asset('img/profile.png') }}" alt="">
                        @endif
                    </div>

                </div>
                <div class="overflow-hidden">
                    <div class="text-profile">
                        <div class="text-center fw-bold fs-5" style="white-space: nowrap;">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="text-center fs-6 edit-prof-wrap"><a href="/profiles" class="text-white text-decoration-none">Ganti profil</a></div>

                    </div>
                </div>
                 
                <div class="list-panel-menu mt-20">
                    <div class="d-flex a-center side-panel-hover px-20px py-1 {{Route::current()->getName() == 'home' ? 'side-panel-active' : ''}}">
                        <div class="fs-25 w-25px">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <a href="{{route('home')}}" class="btn text-white" style="width: 140px;">Halaman Utama</a>
                        </div>
                    </div>
                    <div class="d-flex a-center side-panel-hover px-20px py-1 {{Route::current()->getName() == 'admin.schedule' || Request::path() == 'schedules' || Request::is('schedules*') ? 'side-panel-active' : ''}}">
                        <div class="fs-25 w-25px">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            @can('schedulesChart', App\Models\Schedule::class )
                                <a href="/schedules" class="btn text-white">Jadwal</a>
                            @endcan
                            @can('listClass', App\Models\Schedule::class )
                                <a href="{{ route('admin.schedule') }}" class="btn text-white">Jadwal</a>
                            @endcan
                        </div>
                    </div>
                    @can('viewAny', App\Models\Assignment::class )
                        <div class="d-flex a-center side-panel-hover px-20px py-1 {{ Request::path() == 'assignments' || Request::is('assignments*') ? 'side-panel-active' : ''}}">
                            <div class="fs-25 w-25px">
                                <i class="fas fa-pencil-ruler"></i>
                            </div>
                            <div class="fs-18 ml-20">
                                <a href="/assignments" class="btn text-white">Tugas</a>
                            </div>
                        </div>
                    @endcan
                    @can('viewAny', App\Models\Exam::class)
                    <div class="d-flex a-center side-panel-hover px-20px py-1 {{ Request::path() == 'exams' || Request::is('exams*') ? 'side-panel-active' : ''}}">
                        <div class="fs-25 w-25px">
                            <i class="fas fa-paste"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <a href="{{route('exams.index')}}" class="btn text-white">Ujian</a>
                            
                        </div>
                    </div>
                    @endcan
                    
                    <div class="d-flex a-center side-panel-hover px-20px py-1 {{Route::current()->getName() == 'courses.index' || Request::is('courses*') ? 'side-panel-active' : ''}}">
                        <div class="fs-25 w-25px">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <a href="{{route('courses.index')}}" class="btn text-white">Materi</a>
                            
                        </div>
                    </div>
                    @can('viewAny', App\Models\Classes::class )
                        <div class="d-flex a-center side-panel-hover px-20px py-1 {{Route::current()->getName() == 'classes.index' || Request::is('classes*') ? 'side-panel-active' : ''}}">
                            <div class="fs-20 w-25px">
                                <i class="fas fa-chalkboard"></i>
                            </div>
                            <div class="fs-18 ml-20">
                                <a href="{{route('classes.index')}}" class="btn text-white">Kelas</a>
                            </div>
                        </div>
                    @endcan

                    <div class="d-flex a-center side-panel-hover px-20px py-1 {{Route::current()->getName() == 'absents.users' || Request::is('absent*') ? 'side-panel-active' : ''}}">
                        <div class="fs-25 w-25px">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            @can('course', App\Models\Absent::class )
                                <a href="/absent" class="btn text-white">Absen</a>
                            @endcan

                            @can('absentGrid', App\Models\Absent::class )
                                <a href="/absents" class="btn text-white">Absen</a>
                            @endcan
                            @if (Auth::user()->role=="admin")
                                <a href="/absents/users?date={{ now()->format('Y-m-d') }}" class="btn text-white">Absen</a>
                            @endif
                        </div>
                    </div>
                   
                    @can('viewAny', App\Models\User::class)
                    <div class="d-flex a-center side-panel-hover px-20px py-1 {{Route::current()->getName() == 'users.index' || Request::is('users*') ? 'side-panel-active' : ''}}">
                        <div class="fs-20 w-25px">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <a href="{{route('users.index')}}" class="btn text-white">Akun</a>
                        </div>
                    </div>
                    @endcan
                    <div class="d-flex a-center side-panel-hover px-20px py-1 {{Route::current()->getName() == 'messages.index' || Request::is('messages*') ? 'side-panel-active' : ''}}">
                        <div class="fs-20 w-25px">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <a href="{{route('messages.index')}}" class="btn text-white">Pengumuman</a>
                        </div>
                    </div>
                    
                    @can('viewAny', App\Models\User::class)
                        <div class="d-flex a-center side-panel-hover px-20px py-1 {{Route::current()->getName() == 'contents.index' ? 'side-panel-active' : ''}}">
                            <div class="fs-20 w-25px">
                                <i class="fas fa-tools"></i>
                            </div>
                            <div class="fs-18 ml-20">
                                <a href="{{route('contents.index')}}" class="btn text-white">Konten</a>
                            </div>
                        </div>
                    @endcan
                    @if (Auth::user())
                    <div class="d-flex a-center px-20px py-1">
                        <div class="fs-20 w-25px">
                            <i class="fs-20 fas fa-sign-out-alt"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <form action="/logout" method="POST">   
                                @csrf
                                <button type="submit" class="btn text-white">Keluar</button>
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