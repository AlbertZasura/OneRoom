@extends('Layout.SidePanel')

@section('title', 'Ujian')

@section('content')

    <h1>Exam</h1>

    <div class="d-flex">
        <div class="w-200px">
            @foreach($examType as $item)
           
                <div class="cursor-pointer card-box mb-2" onclick="window.location='{{route('exlist',$item->type)}}'">
                    <div>{{$item->type}}</div>
                    <div class="text-right">{{$item->total}} Ujian</div>
                </div>

            @endforeach
        </div>
        <div class="ml-20 w-85">
            @yield('mainContent')

        </div>

    </div>

@stop