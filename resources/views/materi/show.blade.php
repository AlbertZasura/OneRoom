@extends('materi.index')


@section('mainContent')

        @if($ses)
            @foreach($ses as $item)
                
                <!-- <div>
                    <img class="w-25" src="{{ asset('storage/file/'.$item->file) }}" alt="" title=""/>
                </div> -->
                <div class="mb-10">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{$item->id}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$item->id}}" aria-expanded="false" aria-controls="collapseTwo">
                                <span class="text-navi fw-bolder">{{$item->title}}</span>
                            </button>
                        </h2>
                        <div id="collapse{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$item->id}}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div>{{$item->description}}</div>
                                <div onclick="window.location='{{route('uploaded',$item->id)}}'" class="cursor-pointer d-flex a-center text-navi view-session">
                                    <i class="fas fa-scroll mr-10"></i> <span>Lihat Materi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @can('view', $course->first())
                <div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" >
                            <button class="accordion-button collapsed accordion-button-none" type="button" onclick="openEditSession()" >
                                <span class="text-navi fw-bolder d-flex" style="height: 20px;"><i class="far fa-plus-square" style="margin-top: 3px; margin-right: 10px;"></i> <p>Tambah Materi</p></span>
                            </button>
                        </h2>
                    </div>

                </div>
                <div class="d-none" id="formEditSession">
                    <form action="/session" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="exampleInputEmail1" class="form-label">title</label>
                        <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <br>
                        <label for="exampleInputEmail1" class="form-label">description</label>
                        <input type="text" name="description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <br>
                        <input type="file" name="file_upload" id="" class="form-control"><br>
                        <input type="text" name="coId" value="{{$courseId}}" class="d-none">
                        <button type="submit" class="btn btn-dark form-control">Upload Now</button>
                    </form>
        
                </div>
            @endcan
        @else
            <span>No Data</span>
        @endif

        <script>
            function openEditSession(){
                document.getElementById("formEditSession").classList.toggle("d-none");
            }
        </script>

@stop