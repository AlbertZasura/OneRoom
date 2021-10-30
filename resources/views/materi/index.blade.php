@extends('Layout.SidePanel')

@section('title', 'Materi')

@section('content')

    <h1>Materi</h1>

    <div class="d-flex">
        <div class="w-200px">
            @foreach($course as $i)
                <div class="cursor-pointer card-box mb-2" onclick="window.location='{{route('courses.show',$i->id)}}'">
                    <div>{{$i->name}}</div>
                    <div class="text-right">{{$i->sessions->count()}} Materi</div>
                </div>
            @endforeach
        </div>
        <div class="ml-20 w-85">
            <h2>{{$cls->name}}</h2>
            @yield('mainContent')

        </div>

    </div>
  
    

@stop