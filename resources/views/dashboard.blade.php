@extends('Layout.SidePanel')

@section('title', 'Dashboard')

@section('content')

    <h1>Dashboard</h1>
    <div class="row g-4">
        @can('schedulesChart', App\Models\Schedule::class )
            <div class="col-md-6">
                <div class="card h-100">
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
                </div>
            </div>
        @endcan
        <div class="col-md-6">
            <div class="card h-100">
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
            </div>
        </div>
        @can('listUser', App\Models\Absent::class )
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-header d-flex justify-content-center align-items-center ">
                        <i class="fas fa-calendar-check"></i>
                        <h4 class="ms-3 mb-0 card-title">Absent Hari ini</h4>
                    </div>
                    <div class="card-body">
                        @if (Auth::user()->check_absent_today())
                            <div class="row text-success">
                                <div class="col-md-6">
                                    <h1><i class="fa fa-user-check"></i></h1>
                                </div>
                                <div class="col-md-6 text-start">
                                    <h5>{{ Auth::user()->check_absent_today()->status }}</h5>
                                    <h5>{{ Auth::user()->check_absent_today()->created_at->format('H:i:s') }}</h5>
                                </div>
                            </div>
                            
                        @else
                            <div class="text-danger mb-3">
                                <h1><i class="fa fa-user-times"></i></h1>
                                <h5>Anda Belum Absen</h5>
                            </div>
                            <form action="{{ route('absents.store') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-primary" type="submit"><i class='fa fa-user-check'></i> Absent Sekarang</button>
                        </form>
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