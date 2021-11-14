@extends('Layout.SidePanel')

@section('title', 'Halaman utama | OneRoom')

@section('content')

    <h1>Dashboard</h1>
    <div class="row g-4" style="margin-right: 1%;">
        @can('schedulesChart', App\Models\Schedule::class )
            <div class="col-md-6">
                <div class="card-shadow h-100 p-4 border-radius-5px bg-white">
                    <div class="d-flex justify-content-between align-items-center monserrta-font">
                        <i class="fas fa-calendar color-hijau-tua"></i>
                        <h4 class="ms-3 mb-0 fw-bold">{{ now()->isoFormat('dddd, D MMMM Y')  }}</h4>
                        <a href="/schedules" class="ms-auto text-decoration-none color-hijau-tua">View more</a>
                    </div>
                    <div class="h-100">
                        @if (!$schedules->isEmpty())
                        <table class="table table-hover table-borderless mb-0 mt-20">
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    <tr>
                                        <th scope="row" class="text-center" style="width: 25%">{{ $schedule->class->name }}</th>
                                        <th style="width: 25%">{{ $schedule->course->name }}</th>
                                        <td class="text-end">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="card-body d-flex justify-content-center a-center h-100">
                                <h5 class="text-center">Tidak ada jadwal</h5>
                            </div>
                        @endif

                    </div>
                </div>
                <!-- <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center ">
                        <i class="fas fa-calendar"></i>
                        <h4 class="ms-3 mb-0">{{ now()->isoFormat('dddd, D MMMM Y')  }}</h4>
                        <a href="/schedules" class="ms-auto text-decoration-none">View more</a>
                    </div>
                    @if (!$schedules->isEmpty())
                    <table class="table table-hover mb-0">
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <th scope="row" class="text-center" style="width: 25%">{{ $schedule->class->name }}</th>
                                    <th style="width: 25%">{{ $schedule->course->name }}</th>
                                    <td class="text-end">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="card-body">
                            <h5 class="text-center">Tidak ada jadwal</h5>
                        </div>
                    @endif
                </div> -->
            </div>
        @endcan
        <div class="col-md-6">
            <div class=" card-shadow h-100 p-4 border-radius-5px bg-white">
                <div class="d-flex justify-content-between align-items-center monserrta-font">
                    <i class="color-hijau-tua fas fa-bullhorn"></i>
                    <h4 class="ms-3 mb-0 fw-bold">Pengumuman</h4>
                    <a href="{{ route('messages.index') }}" class="color-hijau-tua ms-auto text-decoration-none">View more</a>
                </div>
                <div class="h-100">
                    <table class="table table-hover table-borderless mb-0 mt-20">
                        <tbody>
                            @foreach ($messages as $message)
                            <tr class='clickable-row' data-href="{{ route('messages.show',$message->id) }}">
                                <a href="{{ route('messages.show',$message->id) }}" target="_blank">
                                    <td>{{ Str::limit($message->title, 50) }}</td>
                                    <td scope="row" class="text-end" style="width: 25%">{{ $message->created_at->isoFormat('D MMMM YYYY') }}</td>
                                </a>    
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center ">
                    <i class="fas fa-bullhorn"></i>
                    <h4 class="ms-3 mb-0">Pengumuman</h4>
                    <a href="{{ route('messages.index') }}" class="ms-auto text-decoration-none">View more</a>
                </div>
                <table class="table table-hover mb-0">
                    <tbody>
                        @foreach ($messages as $message)
                        <tr class='clickable-row' data-href="{{ route('messages.show',$message->id) }}">
                            <a href="{{ route('messages.show',$message->id) }}" target="_blank">
                                <th scope="row" class="text-center" style="width: 25%">{{ $message->created_at->isoFormat('D MMMM') }}</th>
                                <td>{{ Str::limit($message->title, 50) }}</td>
                            </a>    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> -->
        </div>
        @can('isTeacher')
            <div class="col-md-2">
                <div class="card-shadow h-100 p-4 border-radius-5px bg-white" style="width: 300px;">
                    <div class="d-flex justify-content-center align-items-center monserrta-font">
                        <!-- <i class="fas fa-calendar-check"></i> -->
                        <h4 class="ms-3 mb-0 card-title fw-bold">Absent Hari ini</h4>
                    </div>
                    <div class="mt-20">
                        @if ($absent=Auth::user()->check_absent_today())
                            <div class=" {{ $absent->status=="Telat" ? "text-danger" :"text-success" }}">
                                <div class="">
                                    <h1 class="text-center"><i class="fa fa-user-check"></i></h1>
                                </div>
                                <div class="text-center">
                                    <h5>{{ $absent->status }}</h5>
                                    <h5>{{ $absent->created_at->format('H:i:s') }}</h5>
                                </div>
                            </div>
                            
                        @else
                            <div class="">
                                <div class="text-danger mb-3">
                                    <h1 class="text-center"><i class="fa fa-user-times"></i></h1>
                                    <h5 class="text-center">Anda Belum Absen</h5>
                                </div>
                                <div class="text-center justify-content-center">
                                    <form action="{{ route('absents.store') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-primary btn-fill-green rounded-pill py-2 px-5" type="submit"><i class='fa fa-user-check'></i> Absent Sekarang</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endcan
    </div>
<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
@endsection