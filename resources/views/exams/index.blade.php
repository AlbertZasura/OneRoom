@extends('Layout.SidePanel')

@section('title', 'Ujian | OneRoom')

@section('content')

    <h1 class="show-on-dekstop">Ujian</h1>

    @can('viewStudent', App\Models\Exam::class)

        @if(count($examType) == 0)
            <div class="container">
                <div class="card-shadow bg-white border-radius-8px ">
                    <div class="d-flex justify-content-center pt-20">
                        <img src="{{ asset('img/Logo-OneRoom.png') }}" alt="">
                    </div>
                    <div class="fs-20 p-4 text-center">
                        Tidak Ada Ujian Yang tersedia
                    </div> 
                </div>
            </div>
        @endif
    @endcan

    <div class="d-flex mobile-overflow-hidden mobile-w-100">
        <div id="cardMenu" class="mobile-card-menu mobile-w-100 w-200px">
            @can('viewStudent', App\Models\Exam::class)
                @foreach($examType as $item)
                
                    <div class="cursor-pointer card-shadow card-box mb-2 {{ isset($exType) ? $exType == $item->type ? 'active' : ''  : '' }}" onclick="window.location='{{route('exlist',$item->type)}}'">
                        <div class="text-capitalize">{{$item->type}}</div>
                        <div class="text-right">{{$item->total}} Ujian</div>
                    </div>

                @endforeach
            @endcan
            @can('viewTeacher', App\Models\Exam::class)
                <div class="cursor-pointer card-shadow card-box mb-2 {{ $exType != '' ? $exType == 'ujian akhir semester' ? 'active' : ''  : '' }}" onclick="window.location='{{route('exlist','ujian akhir semester')}}'">
                    <div class="text-capitalize">ujian akhir semester</div>
                    <div class="text-right">{{App\Models\Exam::where('type','like','ujian akhir semester')->count()}} Ujian</div>
                </div>

                <div class="cursor-pointer card-shadow card-box mb-2 {{ $exType != '' ? $exType == 'ujian tengah semester' ? 'active' : ''  : '' }}" onclick="window.location='{{route('exlist','ujian tengah semester')}}'">
                    <div class="text-capitalize">ujian tengah semester</div>
                    <div class="text-right">{{App\Models\Exam::where('type','like','ujian tengah semester')->count()}} Ujian</div>
                </div>

                <div class="cursor-pointer card-shadow card-box mb-2 {{ $exType != '' ? $exType == 'ulangan' ? 'active' : ''  : '' }}" onclick="window.location='{{route('exlist','ulangan')}}'">
                    <div class="text-capitalize">ulangan</div>
                    <div class="text-right">{{App\Models\Exam::where('type','like','ulangan')->count()}} Ujian</div>
                </div>

                
            @endcan
        </div>
        @yield('mainContent')

    </div>

    <script>
        @if(Request::is('exams/*'))
            $(document).ready(function(){
                $("#cardMenu").animate({right: '100%'})
                $("#cardMenu2").animate({left: '0'})
            });
        @endif
    </script>


@stop