@extends('Layout.SidePanel')

@section('title', "Forum {$post->title} | OneRoom")

@section('content')
    <div class="card-shadow bg-white">
        <div class="card-body">
            <h1>Forum</h1>
            <div class="card">
                <div class="d-lg-grid d-lg-flex align-items-center p-3">
                    <div class="d-flex me-auto justify-content-center">
                        <i class='fs-25 fa fa-file-signature me-2'></i>
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('course.posts.index', $course) }}">{{ $post->course->name }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('course.posts.index', $course) }}?class={{ $post->class_id }}">{{ $post->class->name }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($post->title, 50) }}
                                </li>
                            </ol>
                        </nav>
                    </div>

                    <div class="d-flex ms-auto justify-content-center">
                        <form action="{{ route('course.posts.destroy', [$course, $post]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit"
                                onclick="return confirm('Apakah Anda yakin untuk menghapus forum {{ Str::limit($post->title, 50)  }} ?')"><i
                                    class='fs-25 fa fa-trash text-danger'></i></button>
                        </form>
                        <p class="btn m-0">{{ $post->comments->count() }} Komentar</p>
                    </div>
                </div>
            </div>

            <div class="card my-4 p-md-2">
                <div class="card-header border-bottom-0 bg-white text-end">
                    <p class="card-text"><small
                            class="text-muted">{{ \Carbon\Carbon::parse($post->created_at)->isoFormat('D MMMM Y, H:mm') }}</small>
                    </p>
                </div>
                <div class="card-body row">
                    <div class="col-md-2 text-center">
                        <div class="profile-picture">
                            @if ($post->user->profile_picture)
                                <img class="img-thumbnail img-fluid"
                                    src="{{ asset('storage/images/' . $post->user->profile_picture) }}" alt="">
                            @else
                                <img class="img-fluid img-thumbnail" src="{{ asset('img/profile.png') }}" alt="">
                            @endif
                        </div>
                        <p class="card-text">{{ $post->user->name }}</p>
                    </div>
                    <div class="col-md-10">
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <p class="card-text">{{ $post->description }}</p>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 text-end">
                    <a href="#" class="btn btn-outline-green rounded-pill">Balas</a>
                </div>
            </div>
            @foreach ($comments as $key => $comment)
                <div class="card my-4 p-md-2">
                    <div class="card-header border-bottom-0 bg-white text-end">
                        <p class="card-text"><small
                                class="text-muted">{{ \Carbon\Carbon::parse($comment->created_at)->isoFormat('D MMMM Y, H:mm') }}</small>
                        </p>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-2 text-center">
                            <div class="profile-picture">
                                @if ($comment->user->profile_picture)
                                    <img class="img-thumbnail img-fluid"
                                        src="{{ asset('storage/images/' . $comment->user->profile_picture) }}" alt="">
                                @else
                                    <img class="img-fluid img-thumbnail" src="{{ asset('img/profile.png') }}" alt="">
                                @endif
                            </div>
                            <p class="card-text">{{ $comment->user->name }}</p>
                        </div>
                        <div class="col-md-10">
                            <p class="card-text">{{ $comment->description }}</p>
                            <p class="card-text">{{ $comment->attachment }}</p>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 text-end">
                        <div class="align-item-center">
                            <form action="{{ route('post.comments.destroy', [$post, $comment]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit"
                                    onclick="return confirm('Apakah Anda yakin untuk menghapus komentar ini?')"><i
                                        class='fs-25 fa fa-trash text-danger'></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            <form action="{{ route('post.comments.store', $post) }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="description" class="col-form-label"><b>Deskripsi</b></label>
                        <textarea class="form-control @error('description')is-invalid @enderror" style="height:150px"
                            id="description" name="description" placeholder="Komentar" required></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="attachment"><b>Attachment</b> (optional)</label>
                        <input type="file" name="attachment" class="form-control @error('attachment')is-invalid @enderror"
                            id="attachment">
                        @error('attachment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-green rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-fill-green rounded-pill">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@stop
