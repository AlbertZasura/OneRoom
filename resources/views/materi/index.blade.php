@extends('Layout.SidePanel')

@section('title', 'Materi')

@section('content')

    <h1>Materi</h1>




    <div class="d-flex">
        <div class="w-25">
            @foreach($course as $i)
                <a href="{{route('courses.show',$i->id)}}">
                    <div>{{$i->name}}</div>
                    <div>{{$i->sessions->count()}}</div>
                </a>
            @endforeach
            <div></div>
        </div>
        <div class="w-75">

        @yield('mainContent')

        
        </div>

    </div>

    


@stop