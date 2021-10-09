@extends('materi.index')


@section('mainContent')

        @if($ses)
            @foreach($ses as $item)
                <div>{{$item->title}}</div>
                <div>{{$item->description}}</div>
                <!-- <div>
                    <img class="w-25" src="{{ asset('storage/file/'.$item->file) }}" alt="" title=""/>
                </div> -->
            @endforeach
        @else
            <span>No Data</span>
        @endif

        <form action="/session" method="post" enctype="multipart/form-data">
            @csrf
            <label for="exampleInputEmail1" class="form-label">title</label>
            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <br>
            <label for="exampleInputEmail1" class="form-label">description</label>
            <input type="text" name="description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <br>
            <input type="file" name="file_upload" id="" class="form-control"><br>
            <input type="text" name="coId" value="{{$courseId}}" class="">
            <button type="submit" class="btn btn-dark form-control">Upload Now</button>
        </form>

@stop