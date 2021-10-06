@extends('Layout.SidePanel')

@section('title', 'Dashboard')

@section('content')

    <h1>dashboard</h1>

    <button id="open-popup">show pop up</button>

    <x-pop-up>
        <h1>pop up insert content</h1>
        <div class="d-flex justify-content-end">
            <button id="action-closes-popup">Cancel</button>
            <button id="action-submit-popup">Submit</button>

        </div>
    </x-pop-up>

@stop