@extends('Layout.SidePanel')

@section('title', 'Dashboard')

@section('content')

    <h1>dashboard</h1>

    <button id="open-popup">show pop up</button>

    <x-pop-up>
        <h1>pop up insert content</h1>
    </x-pop-up>

@stop