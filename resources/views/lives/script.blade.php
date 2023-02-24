<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
    function l_lives() {
        $.ajax({
            // url: 'http://127.0.0.1:8000/api/movies',
            url: 'http://192.168.225.112:80/api/lives',
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                $("#movielist").html("");
                console.log(result);
                let lives = result.data;
                    $.each(lives, function(i, data) {
                        $('#movielist').append(`
                    <div class="card me-4 mb-4 ms-2" style="width: 18rem;">
                        <img src="{{ asset('storage/` + data.poster + `') }}" class="card-img-top" alt="..." style="height: 400px;">
                        <div class="card-body">
                            <h5 class="card-title"> ` + data.nama + `</h5>
                            <a class="btn btn-primary l_detail" data-bs-toggle="modal" data-bs-target="#staticBackdrop" 
                            onClick="detail('${data.id_live}')">Detail</a>
                        </div>
                    </div>
                    `);
                    })   
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
            url: 'http://192.168.225.112:80/api/lives/' + id,
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
            url: 'http://192.168.225.112:80/api/lives/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                let lives = result.data;
                console.log(lives);
                $('.modal-body').html(`
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/` + lives.poster + `') }}" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group">
                                    <li class="list-group-item"><h3>` + lives.nama + `</h3></li>
                                    <li class="list-group-item">Deskripsi : ` + lives.deskripsi + `</li>
                                    <li class="list-group-item">Lokasi : ` + lives.lokasi + `</li>
                                    <li class="list-group-item">
                                    <a class="btn btn-success l_detail" data-bs-toggle="modal2" data-bs-target="#staticBackdrop" onClick="detail_u('${lives.id_live}')">Update</a>
                                    <a class="btn btn-danger l_delete" onclick="delete_movie('${lives.id_live}');">Delete</a>
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
            url: 'http://192.168.225.112:80/api/lives/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                let lives = result.data;
                console.log(lives);
                $('.modal-body').html(`
                <div class="ms-5 me-5">
                <div class="mb-3 ">
                    <label for="exampleInputEmail1" class="col-form-label-lg">Nama</label>
                    <input type="text" class="form-control form-control-lg" id="nama" name="nama" value="`+lives.nama+`">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="col-form-label-lg">Deskripsi</label>
                    <textarea class="form-control" rows="3" id="deskripsi" name="deskripsi">`+lives.deskripsi+`</textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="col-form-label-lg">Lokasi</label>
                    <textarea class="form-control" rows="3" id="lokasi" name="lokasi">`+lives.lokasi+`</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg" id="input_movie" onclick="update_movie('${lives.id_live}');">Submit</button>
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
        let nama = $('#nama').val();
        let deskripsi = $('#deskripsi').val();
        let lokasi = $('#lokasi').val();
        $.ajax({
            url: 'http://192.168.225.112:80/api/lives/' + id,
            type: 'PUT',
            dataType: 'json',
            data: {
                'nama': nama,
                'deskripsi': deskripsi,
                'lokasi': lokasi,
            },
            success: function(result) {
                console.log(result);
            },
            error: function(result) {
                console.log(result);
            }
        })
        window.location.href = "http://192.168.225.112:80/lives";
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