@extends('Layout.SidePanel')

@section('title', 'Ujian | OneRoom')

@section('content')

    <h1>Ujian</h1>

    <div class="d-flex">
        <div class="w-200px">
            @foreach($examType as $item)
            
                <div class="cursor-pointer card-shadow card-box mb-2 {{ isset($exType) ? $exType == $item->type ? 'active' : ''  : '' }}" onclick="window.location='{{route('exlist',$item->type)}}'">
                    <div>{{$item->type}}</div>
                    <div class="text-right">{{$item->total}} Ujian</div>
                </div>

            @endforeach
        </div>
        @yield('mainContent')

    </div>

@stop