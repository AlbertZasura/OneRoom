@extends('exams.index')


@section('mainContent')

<div class="w-25">
    <!-- <form action=""> -->
        <select class="form-select form-select-lg mb-3" id="courseFilter" onchange="window.location='{{route('exlist',$exType)}}'" aria-label=".form-select-lg example">\
            @foreach($course as $it)
                <option value="{{$it->id}}">{{$it->name}}</option>
            @endforeach
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
        <tr>
            <td onclick="window.location='{{route('examsubmitlist',$i->id)}}'">{{$i->title}}</td>
            <td onclick="window.location='{{route('examsubmitlist',$i->id)}}'">
                <div>Dari {{date('d-m-Y', strtotime($i->start_date))}} {{date('H:i', strtotime($i->start_date))}}</div>
                <div>Sampai {{date('d-m-Y', strtotime($i->end_date))}} {{date('H:i', strtotime($i->end_date))}}</div>
            </td>
            <td class="fs-25">
                <i class="fas fa-download mr-10 cursor-pointer" onclick="window.location='{{route('downloadexams', $i->id)}}'"></i>
                <i class="fas fa-plus mr-10 cursor-pointer"></i>
                <i class="fas fa-upload cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal{{$i->id}}"></i>
                
                <div class="modal fade" id="exampleModal{{$i->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$i->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel{{$i->id}}">Unggah {{$i->type}} {{$i->title}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <form action="/exams/submitExam?e={{$i->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="modal-body">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <label for="note86" class="col-form-label">Notes</label>
                                        </div>
                                        <div class="col-auto">
                                            <input type="text"  name="notes" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="file" name="file_upload" class="form-control" id="inputGroupFile01">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
       


@stop