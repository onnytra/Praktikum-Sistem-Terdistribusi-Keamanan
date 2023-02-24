@extends ('temp')
@section ('judul', 'Input Lives')

@section ('konten')

<div class="column justify-content-center ms-5 me-5">
    <h1 class="text-center mt-3">Input Lives</h1>
    <hr>
</div>
@include('movie.script')
<form action="{{ route('lives.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="ms-5 me-5">
        <div class="mb-3 ">
            <label for="exampleInputEmail1" class="col-form-label-lg">Nama</label>
            <input type="text" class="form-control form-control-lg" id="nama" name="nama" value="{{ old('nama')}}">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="col-form-label-lg">Deskripsi</label>
            <textarea class="form-control" rows="3" id="deskripsi" name="deskripsi" value="{{ old('deskripsi')}}"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="col-form-label-lg">Lokasi</label>
            <textarea class="form-control" rows="3" id="lokasi" name="lokasi" value="{{ old('lokasi')}}"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="col-form-label-lg">Poster</label>
            <input type="file" id="poster" name="poster" value="{{ old('poster')}}">
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </div>
</form>
@endsection