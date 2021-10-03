@extends('Layout.SidePanel')

@section('title', 'Messages Center')

@section('content')
    <h1>Index</h1>
    @if (Auth::user())
    <form action="/logout" method="POST">   
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    @else
    <a class="btn btn-info" href="/login">Login</a>  
    @endif
    
    @foreach ($messages as $key => $message )
        <p class="card-text"> </p>
        <p class="card-text">{{ $key+1 }}. {{ $message->title }}</p>
        <p class="card-text"> {{ $message->content }}</p>
        <form action="{{ route('messages.destroy',$message->id) }}" method="POST">   
            @csrf
            @method('DELETE')      
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a class="btn btn-info" href="{{ route('messages.show',$message->id) }}">Show</a>    
        <a class="btn btn-primary" href="{{ route('messages.edit',$message->id) }}">Edit</a>
    @endforeach
@stop
