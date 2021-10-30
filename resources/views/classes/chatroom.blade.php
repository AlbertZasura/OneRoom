@extends('Layout.SidePanel')
@section('title', "$class->name")

@section('content')
    <div class="d-flex align-items-center">
        <h1 class="text-uppercase">Kelas {{$class->name}}</h1>
    </div>

@endsection
