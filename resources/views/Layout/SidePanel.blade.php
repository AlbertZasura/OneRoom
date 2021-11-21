<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('img/Logo-OneRoom.png') }}" type="image/png">
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
        <div class="show-on-mobile position-fixed w-100" style="z-index: 1;">
            <div class="d-flex justify-content-between a-center px-2 py-3 bg-hijau-tua text-white">
                <div class="d-flex a-center">
                    <img class="mr-10" src="{{ asset('img/Logo-OneRoom.png') }}" alt="logo_oneRoom" style="width:20px; height: 20px; filter: brightness(0) invert(1);"> 
                    <span>OneRoom</span>
                </div>
                <i class="fas fa-bars mr-10" style="margin-top: 1px;" onclick="showMenuMobile()"></i>
            </div>
        </div>
        <div id="overlay" class="overlay-side-menu show-on-mobile" style="z-index: 1;"></div>
        <div class="d-flex">
            <div id="sidePanel" class="{{ str_contains(url()->current(), '/dashboard') ?  'side-panel-menu bg-hijau-tua' : 'resize-side-panel side-panel-menu bg-hijau-tua'  }}">
                <div class="position-relative show-on-mobile"><i class="pos-absolute fas fa-times fs-25" style="right: 11px; top: 12px;" onclick="hideMenuMobile()"></i></div>
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
                        @can('isVerify')
                            <div class="text-center fs-6 edit-prof-wrap"><a href="/profiles" class="text-white text-decoration-none">Ganti profil</a></div>
                        @endcan
                    </div>
                </div>
                <div class="list-panel-menu mt-20">
                    @can('isVerify')
                        <div class="d-flex a-center side-panel-hover px-20px py-1 {{Route::current()->getName() == 'home' ? 'side-panel-active' : ''}}">
                            <div class="fs-25 w-25px">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="fs-18 ml-20">
                                <a href="{{route('home')}}" class="btn text-white mobile-w-100 mobile-min-w-149" style="width: 149px;">Halaman Utama</a>
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
                           
                    @endcan
                    <div class="d-flex a-center px-20px py-1">
                        <div class="fs-20 w-25px">
                            <i class="fs-20 fas fa-sign-out-alt"></i>
                        </div>
                        <div class="fs-18 ml-20">
                            <form action="/logout" method="POST">   
                                @csrf
                                <button type="submit" class="btn text-white" onclick="return confirm('Apakah Anda yakin untuk keluar?')">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mobile-ml-0 container mobile-mt-70 {{ str_contains(url()->current(), '/dashboard') ?  'w-100' : 'ml-70 w-100'  }}">
                @include('components.notifications')
                @include('sweetalert::alert')
                @yield('content')
            </div>

        </div>
    @endif

    <script>

        function showMenuMobile(){
            $('#sidePanel').animate({width: '100%'}, 0.5);
            $('#overlay').animate({width: '100%'}, 0.2);
        }
        function hideMenuMobile(){
            $('#sidePanel').animate({width: '0'}, 0.1);
            $('#overlay').delay(160).animate({width: '0'});
        }

        function setCookie(name,value,days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "")  + expires + "; path=/";
        }
        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }
        function eraseCookie(name) {   
            document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }

        function closeCardMenu(){
            setCookie('isOpenMenu','false',1);
        }

        function openCardMenu(){
            setCookie('isOpenMenu','true',0);
            // setCookie('windowLocation',window.location.href,1)
        }

        $(document).ready(function(){
            let cookie = getCookie('isOpenMenu');
            var x = location.hash;
            console.log('cookie ', cookie)
            if(cookie == 'true'){
                $("#cardMenu").animate({right: '100%'})
                $("#cardMenu2").animate({left: '0'})
                openCardMenu();
            }
        });

        $(document).ready(function(){
            var location = getCookie('windowLocation')
            console.log("location = ", location);
            console.log("window.location.href = ", window.location.href);
            if(location != window.location.href){
                setCookie('isOpenMenu','false',1);
                setCookie('windowLocation',window.location.href,1)
            }
        });

    </script>
</body>
</html>