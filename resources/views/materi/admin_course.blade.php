@extends('Layout.SidePanel')

@section('title', 'Materi')

@section('content')

<div class="container">

    <h1>Materi</h1>
    
    <div class="row">
        <div class="col">
            <div class="text-center fw-bold fs-20 mb-3">Mata Pelajaran</div>
            
            <div class="box-course-create scroll-y custom-scroll-y" style="height: 600px;">
                <div>
                <button type="button" class="btn w-100 border-2px btn-add-course" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus mr-10"></i> <span>Tambah Mata Palajaran</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                @csrf
                                    <div class="modal-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <label for="score86" class="col-form-label">Nama Mata Pelajaran</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="number"  name="score" class="form-control" >
                                            </div>
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
                </div>
                </div>
                @foreach($course as $courses)
                    <div class="cursor-pointer text-center border-bottom-gray py-2 hover-gray">{{$courses->name}}</div>
                @endforeach
            </div>
        </div>
    
        <div class="col">
            <div class="text-center fw-bold fs-20 mb-3">Guru</div>
            <div class="box-course-create scroll-y custom-scroll-y" style="height: 600px;">
                @foreach($teacher as $teachers)
                    <div class="cursor-pointer text-center border-bottom-gray py-2 hover-gray">{{$teachers->name}}</div>
                @endforeach
            </div>
        </div>
    
        <div class="col">
            <div class="text-center fw-bold fs-20 mb-3">Kelas</div>
            <div class="box-course-create scroll-y custom-scroll-y" style="height: 600px;">
                @foreach($class as $classes)
                    <div class="cursor-pointer text-center border-bottom-gray py-2 hover-gray">{{$classes->name}}</div>
                @endforeach
            </div>
        </div>
    
    </div>

</div>

  
    

@stop