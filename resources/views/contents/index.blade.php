
@extends('Layout.SidePanel')

@section('title', 'Konten | OneRoom')

@section('content')
    <div class="card-shadow m-5 bg-white border-radius-8px">
        <div class="card-body">
            <h1>Konten</h1>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Isi</th>
                        <th scope="col">Perubahan Terakhir</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($contents as $key=>$content )
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $content->name }}</td>
                                <td>{{ $content->value }}</td>
                                <td>{{ $content->updated_at }}</td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#editContents{{ $content->id }}" class="btn btn-fill-green rounded-pill">
                                        Ubah
                                    </a>
                                    @include('contents._edit')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            
    </div>   
@endsection
