@extends('Layout.SidePanel')

@section('title', 'Dashboard')

@section('content')

    <h1>Dashboard</h1>
    <div class="row">
        @can('schedulesChart', App\Models\Schedule::class )
            <div class="col-md-6 mb-1">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center ">
                        <i class="fas fa-calendar"></i>
                        <h4 class="ms-3 mb-0">{{ now()->isoFormat('dddd, D MMMM Y')  }}</h4>
                        <a href="/schedules" class="ms-auto text-decoration-none">View more</a>
                    </div>
                    <table class="table table-hover mb-0">
                        <tbody>
                            @if (!$schedules->isEmpty())
                                @foreach ($schedules as $schedule)
                                    <tr>
                                        <th scope="row" class="text-center" style="width: 25%">{{ $schedule->class->name }}</th>
                                        <th style="width: 25%">{{ $schedule->course->name }}</th>
                                        <td class="text-end">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <td class="text-center">Tidak ada jadwal</td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @endcan
        <div class="col-md-6 mb-1">
            <div class="card">
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
    </div>
<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
@endsection