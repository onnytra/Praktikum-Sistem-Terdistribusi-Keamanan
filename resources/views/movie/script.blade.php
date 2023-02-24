<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
    function l_movie() {
        $.ajax({
            // url: 'http://127.0.0.1:8000/api/movies',
            url: 'http://192.168.225.112:80/api/movies',
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                $("#movielist").html("");
                console.log(result);
                let movies = result.data;
                if (result.success == "True") {
                    $.each(movies, function(i, data) {
                        $('#movielist').append(`
                    <div class="card me-4 mb-4 ms-2" style="width: 18rem;">
                        <img src="{{ asset('storage/` + data.poster + `') }}" class="card-img-top" alt="..." style="height: 400px;">
                        <div class="card-body">
                            <h5 class="card-title"> ` + data.judul + `</h5>
                            <p class="card-text fw-light">` + data.genre + `</p>
                            <a class="btn btn-primary l_detail" data-bs-toggle="modal" data-bs-target="#staticBackdrop" 
                            onClick="detail('${data.id}')">Detail</a>
                            <a class="btn btn-secondary l_trailer" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" 
                            onClick="youtube('${data.judul}')">Trailer</a>
                        </div>
                    </div>
                    `);
                    })
                }
            }
        })
    }
    // $('#input_movie').on('submit',function(){
    // console.log('test');
    function input_movie() {
        console.log('test');
        var name = document.getElementById('poster').files[0]
        var data = new FormData();

        // var poster = document.get_included_files('poster').files[0];
        console.log(poster);
        data.append('poster', name);
        console.log(data);
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //     url: 'http://127.0.0.1:8000/api/movies',
        //     processData: false,
        //     contentType: false,
        //     type: 'POST',
        //     dataType: 'json',
        //     data: {
        //         'judul': $('#judul').val(),
        //         'tanggal': $('#tanggal').val(),
        //         'genre': $('#genre').val(),
        //         'sinopsis': $('#sinopsis').val(),
        //         'poster': data,
        //     },
        //     success: function(result) {
        //         console.log("masuk");
        //         console.log(result);
        //     },
        //     error: function(result) {
        //         console.log(result);
        //     }
        // })
        // window.location.href = "http://127.0.0.1:8000/";
    }
    // });
    function delete_movie(id) {
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        $.ajax({
            // url: 'http://127.0.0.1:8000/api/movies/' + id,
            url: 'http://192.168.225.112:80/api/movies/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function(result) {
                console.log("DELETE SUCCESS");
            },
            error: function(result) {
                console.log(result);
            }
        })
        window.location.reload();
    }

    function search() {
        $("#movielist").html("");
        $.ajax({
            url: 'http://www.omdbapi.com',
            type: 'GET',
            dataType: 'json',
            data: {
                'apikey': '2121c6c',
                's': $('#title').val()
            },
            success: function(result) {
                console.log(result);
                let movies = result.Search;
                if (result.Response == "True") {
                    $.each(movies, function(i, data) {
                        $('#movielist').append(`
                        <div class="card me-4 mb-4 ms-2" style="width: 18rem;">
                            <img src="` + data.Poster + `" class="card-img-top" alt="..." style="height: 400px;">
                            <div class="card-body">
                                <h5 class="card-title">` + data.Title + `</h5>
                                <p class="card-text fw-light">` + data.Year + `</p>
                                <p class="card-text"></p>
                                <a class="btn btn-primary detail" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onClick="detail_search('${data.imdbID}')">Detail</a>
                                <a class="btn btn-secondary trailer" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onClick="youtube('${data.Title}')" data-title="` + data.Title + `">Trailer</a>
                            </div>
                        </div>
                        `);
                    })
                } else {
                    $('#movielist').html(`
                    <div class="col">
                        <h1 class="text-center"> Movie Not Found </h1>
                    </div>
                `);
                }
            }
        })
    }

    function detail_search(id) {
        $(".modal-body").html("");
        $.ajax({
            url: 'http://www.omdbapi.com',
            type: 'GET',
            dataType: 'json',
            data: {
                'apikey': '2121c6c',
                'i': id,
            },
            success: function(movie) {
                $('.modal-body').html(`
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="`+ movie.Poster + `" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group">
                                    <li class="list-group-item"><h3>`+ movie.Title + `</h3></li>
                                    <li class="list-group-item">Released : `+ movie.Released + `</li>
                                    <li class="list-group-item">Genre : `+ movie.Genre + `</li>
                                    <li class="list-group-item">Director : `+ movie.Director + `</li>
                                    <li class="list-group-item">Actors : `+ movie.Actors + `</li>
                                    <li class="list-group-item">Plot : `+ movie.Plot + `</li>
                                    <li class="list-group-item">Awards : `+ movie.Awards + `</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                `);
            },
            error: function(error) {
                console.log(error);
            }
        })
    }

    function detail(id) {
        $(".modal-body").html("");
        $.ajax({
            url: 'http://192.168.225.112:80/api/movies/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                let movie = result.data;
                $('.modal-body').html(`
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/` + movie.poster + `') }}" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group">
                                    <li class="list-group-item"><h3>` + movie.judul + `</h3></li>
                                    <li class="list-group-item">Released : ` + movie.tanggal + `</li>
                                    <li class="list-group-item">Genre : ` + movie.genre + `</li>
                                    <li class="list-group-item">Sinopsis : ` + movie.sinopsis + `</li>
                                    <li class="list-group-item">Available On : 
                                <img src="{{ asset('storage/` + movie.poster_live + `') }}" class="img-fluid"></li>
                                    <li class="list-group-item">
                                    <a class="btn btn-success l_detail" data-bs-toggle="modal2" data-bs-target="#staticBackdrop" onClick="detail_u('${movie.id}')">Update</a>
                                    <a class="btn btn-danger l_delete" onclick="delete_movie('${movie.id}');">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                `);
            },
            error: function(result) {
                console.log(result);
            }
        })
    }

    function detail_u(id) {
        $(".modal-body").html("");
        $.ajax({
            url: 'http://192.168.225.112:80/api/movies/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                let movie = result.data;
                console.log(movie);
                $('.modal-body').html(`
                <div class="mb-3 ">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <label for="exampleInputEmail1" class="col-form-label-lg">Judul</label>
                    <input type="text" class="form-control form-control-lg" id="judul" value="` + movie.judul + `">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="col-form-label-lg">Tanggal</label>
                    <input type="date" class="form-control form-control-lg" id="tanggal" value="` + movie.tanggal + `">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="col-form-label-lg">Genre</label>
                    <select class="form-select form-select-lg" id="genre">
                        <option selected>Choose...</option>
                        <option value="animation">Animation</option>
                        <option value="comedy">Comedy</option>
                        <option value="adventure">Adventure</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="col-form-label-lg">Sinopsis</label>
                    <textarea class="form-control" rows="5" id="sinopsis">` + movie.sinopsis + `</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg" id="input_movie" onclick="update_movie('${movie.id}');">Submit</button>
                `);
            },
            error: function(result) {
                console.log(result);
            }
        })
    }

    function update_movie(id) {
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        console.log(id);
        let judul = $('#judul').val();
        let tanggal = $('#tanggal').val();
        let genre = $('#genre').val();
        let sinopsis = $('#sinopsis').val();
        $.ajax({
            url: 'http://192.168.225.112:80/api/movies/' + id,
            type: 'PUT',
            dataType: 'json',
            data: {
                'judul': judul,
                'tanggal': tanggal,
                'genre': genre,
                'sinopsis': sinopsis,
            },
            success: function(result) {
                console.log(result);
            },
            error: function(result) {
                console.log(result);
            }
        })
        window.location.href = "http://192.168.225.112:80/";
    }

    function youtube(title) {
        $(".modal-body2").html("");
        $.ajax({
            url: 'https://www.googleapis.com/youtube/v3/search',
            type: 'GET',
            dataType: 'json',
            data: {
                'part': 'snippet',
                'key': 'AIzaSyCF4qcCoESONOVF-8RDPpb5JoIRhfe2IuA',
                'q': 'trailer ' + title,
                'maxResults': 1,
                'type': 'video'
            },
            success: function(trailer) {
                console.log(trailer);
                console.log(trailer.items[0].id.videoId);
                $('.modal-body2').html(`
                <div class="container-fluid">
                        <div class="row">
                        <div class="col" align="center">
                        <iframe width="800" height="500" src="https://www.youtube.com/embed/${trailer.items[0].id.videoId}"
                        title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; 
                        encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        </div>
                    </div>
                `);
            },
            error: function(error) {
                console.log(error);
            }
        })
    }
</script>