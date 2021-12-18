
@extends('classes.index')

@section('title', "Kelas {$class->name} | OneRoom")

@section('show')
    <div class="card-shadow bg-white rounded-3">
        <div class="show-on-mobile">
            <div class="d-flex a-center px-20px pt-20">
                <i class="fas fa-arrow-left mr-10 fs-20" onclick="window.history.go(-1); return false;"></i>
                <h1 class="mobile-mb-0">Kelas</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center">
                @can('delete', $class )
                    <form action="{{ route('classes.destroy',$class) }}" method="POST">   
                        @csrf
                        @method('DELETE')      
                        <button class="btn" type="submit" onclick="return confirm('Apakah Anda yakin untuk menghapus kelas ini?')"><i class='fs-25 fa fa-trash text-danger'></i></button>
                    </form>
                @endcan
                <h1 class="text-uppercase">{{$class->name}}</h1>
                {{-- @can('update',$class )
                    <a href="{{ route('classes.edit',$class->id) }}" class="btn"><i class='fs-25 fa fa-pencil text-primary'></i></a>
                @endcan --}}
            </div>
            @can('user_list', App\Models\Classes::class )
                <a href="/classes/{{$class->id}}/assign_user" class="btn btn-outline-green">
                    <i class='fa fa-plus '></i> Tambah Anggota
                </a>
            @endcan
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            @can('assign_user', App\Models\Classes::class )
                                <th>Aksi</th>
                            @endcan
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user )
                            <tr>
                                <th>
                                    <p>{{ $key+1 }}.</p> 
                                </th>
                                <td>
                                    <p>{{ $user->name }}</p> 
                                </td>
                                <td>
                                    <p>
                                        {{ $user->humanizeRole() }}
                                        {{ $user->course($class->id)->pluck('name')->implode(', ') }}
                                    </p> 
                                </td>
                                @can('assign_user', App\Models\Classes::class )
                                    <td>
                                        <form action="/classes/{{$class->id}}/assign_user/{{$user->id}}?type=detach" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-green rounded-pill" onclick="return confirm('Apakah Anda yakin untuk mengeluarkan {{ $user->name }} dari kelas?')">Keluarkan</button>
                                        </form>
                                    </td>
                                @endcan
                                <td>
                                    <button class="btn btn-outline-green rounded-pill d-flex a-center" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}">
                                        <i class="fab fa-whatsapp mr-10 fs-25"></i> {{ $user->phone }}
                                    </button>
                                    
                                    <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$user->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div>
                                                        <label class="col-form-label">Kirim Pesan Ke {{ $user->name }} melalui whatsapp</label>
                                                        <input id="message{{$user->id}}" type="text" class="form-control form-input-color" >
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-green rounded-pill px-20px" data-bs-dismiss="modal">Batal</button>
                                                    <button onclick="sendMessage( '{{$user->phone}}', {{$user->id}} )" class="btn btn-fill-green rounded-pill px-20px">Kirim</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>

    <script>
        function sendMessage(phone, id){
            phone = phone.replace(/\s/g, '');
            var msg = document.getElementById('message'+id).value;
            if(phone.startsWith('0')){
                phone = 62 + phone.slice(1);
            }

            var link = "https://api.whatsapp.com/send?phone="+ phone +"&text=" + msg;

            window.open(link, '_blank');
            
        }
    </script>
@endsection
