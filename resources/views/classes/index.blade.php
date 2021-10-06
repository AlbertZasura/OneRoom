
@extends('Layout.SidePanel')

@section('title', 'Messages Center')

@section('content')
    <h1>Class</h1>
    
    @foreach ($classes as $key => $class )
        <table class="table table-hover" style="width:250%">
            <tbody>
                <tr class='clickable-row' data-href="{{ route('messages.show',$class->id) }}">
                    <td>
                        <p>{{ $class->name }}</p> 
                    </td>
                    <td>
                        <p>{{ $class->title }}</p> 
                    </td>
                </tr>
            </tbody>
        </table>
    @endforeach
@stop
