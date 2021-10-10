@extends('exams.index')


@section('mainContent')

<div class="w-25">
    <!-- <form action=""> -->
        <select class="form-select form-select-lg mb-3" id="courseFilter" onchange="window.location='{{route('exlist',$exType)}}'" aria-label=".form-select-lg example">\
            @foreach($course as $it)
                <option value="{{$it->id}}">{{$it->name}}</option>
            @endforeach
            <input type="text" value="{{$exType}}" name="examtype">
        </select>
    <!-- </form> -->
</div>


<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">nama ujian</th>
            <th scope="col">waktu ujian</th>
            <th scope="col">action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($exam as $i)
        <tr onclick="window.location='{{route('examsubmitlist',$i->id)}}'">
            <td>{{$i->title}}</td>
            <td>
                <div>Dari {{date('d-m-Y', strtotime($i->start_date))}} {{date('H:i', strtotime($i->start_date))}}</div>
                <div>Sampai {{date('d-m-Y', strtotime($i->end_date))}} {{date('H:i', strtotime($i->end_date))}}</div>
            </td>
            <td>@mdo</td>
        </tr>
        @endforeach
    </tbody>
</table>
       


@stop