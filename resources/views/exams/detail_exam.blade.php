@extends('Layout.SidePanel')

@section('title', 'Materi')

@section('content')

    <h1>Exam</h1>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Waktu Pengumpulan</th>
                <th scope="col">Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userList as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>
                    <div>{{date('d-m-Y', strtotime($item->created_at))}} {{date('H:i', strtotime($item->update_at))}}</div>
                </td>
                <td>@mdo</td>
            </tr>
            @endforeach
        </tbody>
        </table>

@stop