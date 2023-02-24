@extends ('temp')
@section ('judul', 'Input Movie')

@section ('konten')

<div class="column justify-content-center ms-5 me-5">
    <h1 class="text-center mt-3">Input Movie</h1>
    <hr>
</div>
@include('movie.script')
<form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="ms-5 me-5">
        <div class="mb-3 ">
            <label for="exampleInputEmail1" class="col-form-label-lg">Judul</label>
            <input type="text" class="form-control form-control-lg" id="judul" name="judul" value="{{ old('judul')}}">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="col-form-label-lg">Tanggal</label>
            <input type="date" class="form-control form-control-lg" id="tanggal" name="tanggal" value="{{ old('tanggal')}}">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="col-form-label-lg">Genre</label>
            <select class="form-select form-select-lg" id="genre" name="genre">
                <option selected>Choose...</option>
                <option value="animation">Animation</option>
                <option value="comedy">Comedy</option>
                <option value="adventure">Adventure</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="col-form-label-lg">Sinopsis</label>
            <textarea class="form-control" rows="3" id="sinopsis" name="sinopsis" value="{{ old('sinopsis')}}"></textarea>
        </div>
        <div class="mb-3 ">
            <label for="exampleInputEmail1" class="col-form-label-lg">Available On</label>
            <select class="form-select form-select-lg" id="id_live" name="id_live">
                @foreach ($live as $data)   
                <option value="{{ $data->id_live }}">{{ $data->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="col-form-label-lg">Poster</label>
            <input type="file" id="poster" name="poster" value="{{ old('poster')}}">
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </div>
</form>
@endsection