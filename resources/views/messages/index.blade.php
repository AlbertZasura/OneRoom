<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Index</h1>
    @if (Auth::user())
    <form action="{{ route('logout') }}" method="POST">   
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    @else
    <form action="{{ route('login') }}" method="GET">   
        @csrf
        <button type="submit" class="btn btn-danger">Login</button>
    </form>
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
</body>
</html>