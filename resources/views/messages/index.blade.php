
@extends('Layout.SidePanel')

@section('content')
    <h1>Pengumuman</h1>
    @if (Auth::user())
    <form action="/logout" method="POST">   
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    @else
    <a class="btn btn-info" href="/login">Login</a>  
    @endif
    
    @foreach ($messages as $key => $message )
        <table style="width:200%">
            <tr>
                <th style="width:25%"></th>
                <th style="width:25%"></th>
                <th style="width:25%"></th>
                <th style="width:25%"></th>
            </tr>
            <tr>
                <td>
                    <a class="card-text">{{ $message->created_at->format('H:i') }}</a> 
                </td>
                <td>
                    <a class="card-text">{{ $message->title }}</a>
                </td>
                <td>
                <a class="card-text">{{ Auth::user()->name }}</a>
                </td>
                <td>
                <a class="card-text">{{ $message->created_at->format('d M Y') }}</a>
                </td>
            </tr>
            <br>
            <br>
        </table>     
        <form action="{{ route('messages.destroy',$message->id) }}" method="POST">   
            @csrf
            @method('DELETE')      
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a class="btn btn-info" href="{{ route('messages.show',$message->id) }}">Show</a>    
        <a class="btn btn-primary" href="{{ route('messages.edit',$message->id) }}">Edit</a>
    @endforeach
@stop
