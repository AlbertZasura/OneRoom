@extends('Layout.SidePanel')

@section('title', 'Materi')

@section('content')

    <h1>Materi</h1>

    <h2>Example Upload File</h2>


    <form action="/session" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file_upload" id="" class="form-control"><br>
        <button type="submit" class="btn btn-dark form-control">Upload Now</button>
    </form>
    
    <img src="{{ asset('storage/images/Hgb2xI0fntPRl8QjpUz37vTaGD3izmNTmr1VcbhL.jpg') }}" alt="" title=""/>

    <!-- <button id="open-popup">show pop up</button>

    <x-pop-up>
        <h1>pop up insert content</h1>
        <div class="d-flex justify-content-end">
            <button id="action-closes-popup">Cancel</button>
            <button id="action-submit-popup">Submit</button>

        </div>
    </x-pop-up> -->

@stop