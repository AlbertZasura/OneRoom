@extends('Layout.SidePanel')

@section('title', 'Dashboard')

@section('content')

    <h1>dashboard</h1>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center ">
                    <i class="fas fa-bullhorn"></i>
                  <h4 class="ms-3">Pengumuman</h3>
                    <a href="{{ route('messages.index') }}" class="ms-auto text-decoration-none" target="_blank">View more</a>
                </div>
                <table class="table table-hover mb-0">
                    <tbody>
                        @foreach ($messages as $message)
                        <tr class='clickable-row' data-href="{{ route('messages.show',$message->id) }}">
                            <a href="{{ route('messages.show',$message->id) }}" target="_blank">
                                <th scope="row" style="width: 25%">{{ $message->created_at->format('d M Y') }}</th>
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