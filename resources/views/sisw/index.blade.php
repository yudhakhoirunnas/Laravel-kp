@extends('template')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Data Mahasiswa</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('sisw.create') }}"> tambah</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('succes'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-5 col-sm-6 mb-3">
            @foreach ($sisw as $siswa)
            <div class="card h- 100 shadow-c rounded-5 border-0">
                <img src="{{ asset('storage/'.$siswa->media) }}" class="card-img-top rounded-5" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $siswa->NamaSiswa }}</h5>
                        <h4 class="card-title">{{ $siswa->NIS }}</h4>
                        <p class="card-text">{{ $siswa->Alamat }}</p>
                            <form action="{{ route('sisw.destroy',$siswa->id) }}" method="POST">

                                <a class="btn btn-primary btn-sm" href="{{ route('sisw.edit',$siswa->id) }}">Edit</a>

                                @csrf
                                    @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                </div>
                    
                </div>   
                 @endforeach
            </div>
        </div>
    </div>


    {!! $sisw->links() !!}


@endsection