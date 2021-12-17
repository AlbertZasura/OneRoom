@extends('posts.course')

@section('title ', 'Forum | OneRoom')

@section('show')
    <div class="card-shadow bg-white rounded-3">
        <div class="show-on-mobile">
            <div class="d-flex a-center mobile-mb-20">
                <i class="fas fa-arrow-left mr-10 fs-20" onclick="window.history.go(-1); return false;"></i>
                <h1 class="mobile-mb-0">Forum</h1>
            </div>
        </div>
        <div class="card-body">

            @php($selectedClasses = $classes->first())
            @can('isTeacher')
                <form action="{{ route('course.posts.index', $course) }}" class="row mb-3">
                    <div class="col-md-6">
                        <select class="form-select" name="class" id="filterClass" oninput="filterByClass()">
                            @foreach ($classes as $key => $class)
                                @if (request()->get('class'))
                                    @php(request()->get('class') == $class->id ? ($selectedClasses = $class) : 'null')
                                    <option {{ request()->get('class') == $class->id ? 'selected' : '' }}
                                        value="{{ $class->id }}">
                                        {{ $class->name }}</option>
                                @else
                                    <option {{ $key === 0 ? 'selected' : '' }} value="{{ $class->id }}">
                                        {{ $class->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-fill-green">
                            <i class='fa fa-search'></i> Cari
                        </button>
                    </div>
                </form>
            @endcan
            <a data-bs-toggle="modal" data-bs-target="#createPosts" class="btn btn-outline-green mb-3 ">
                <i class='fa fa-plus '></i> Tambah Forum
            </a>
            @include('posts._create')


            @if (!$posts->isEmpty())
                <div class="table-responsive-lg">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="30%">Topik</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>
                                        <p class="card-title me-auto">{{ Str::limit($post->title, 50) }}</p>
                                    </td>
                                    <td>
                                        <p class="card-title me-auto">{{ $post->user->name }}</p>
                                    </td>
                                    <td>
                                        <h6 class="card-title ms-auto">
                                            {{ \Carbon\Carbon::parse($post->created_at)->isoFormat('dddd, D MMMM Y H:mm') }}
                                        </h6>
                                    </td>
                                    <td>
                                        <div class="d-flex a-center">
                                            @can('delete', $post)
                                                <form action="{{ route('course.posts.destroy', [$course, $post]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn" type="submit"
                                                        onclick="return confirm('Apakah Anda yakin untuk menghapus forum {{ $post->title }}?')"><i
                                                            class='fs-25 fa fa-trash text-danger'></i></button>
                                                </form>
                                            @endcan
                                            <a href="{{ route('course.posts.show', [$course, $post]) }}"
                                                class="m-1 btn">
                                                {{ $post->comments->count() }} komentar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h3 class="text-center">Tidak ada Forum</h3>
            @endif
        </div>
    </div>
@stop
