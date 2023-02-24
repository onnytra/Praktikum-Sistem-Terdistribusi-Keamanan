$('#tes').on('click', function () {
    $("#movie-list").html("");
    $.ajax({
        url: 'http://127.0.0.1:8000/api/movies',
        type: 'GET',
        dataType: 'json',
        // data: {
        //     'apikey': '2121c6c',
        //     's': $('#title').val()
        // },
        success: function (result) {
            console.log(result);
            // let movies = result.Search;
            // if (result.Response == "True") {
            //     $.each(movies, function (i, data) {
            //         $('#movie-list').append(`
            //             <div class="card me-4 mb-3 ms-4" style="width: 18rem;">
            //                 <img src="`+ data.Poster + `" class="card-img-top" alt="..." style="height: 400px;">
            //                 <div class="card-body">
            //                     <h5 class="card-title"> `+ data.Title + `</h5>
            //                     <p class="card-text fw-light">`+ data.Year + `</p>
            //                     <p class="card-text"></p>
            //                     <a class="btn btn-primary detail" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-idfilm=`+ data.imdbID + `>Detail</a>
            //                     <a class="btn btn-secondary trailer" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" data-title="` + data.Title + `">Trailer</a>
            //                 </div>
            //             </div>
            //             `);
            //     })
            // } else {
            //     $('#movie-list').html(`
            //         <div class="col">
            //             <h1 class="text-center"> Movie Not Found </h1>
            //         </div>
            //     `);
            // }
        }
    })
})
$('#search').on('click', function () {
    $("#movie-list").html("");
    $.ajax({
        url: 'http://www.omdbapi.com',
        type: 'GET',
        dataType: 'json',
        data: {
            'apikey': '2121c6c',
            's': $('#title').val()
        },
        success: function (result) {
            let movies = result.Search;
            if (result.Response == "True") {
                $.each(movies, function (i, data) {
                    $('#movie-list').append(`
                        <div class="card me-4 mb-3 ms-4" style="width: 18rem;">
                            <img src="`+ data.Poster + `" class="card-img-top" alt="..." style="height: 400px;">
                            <div class="card-body">
                                <h5 class="card-title"> `+ data.Title + `</h5>
                                <p class="card-text fw-light">`+ data.Year + `</p>
                                <p class="card-text"></p>
                                <a class="btn btn-primary detail" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-idfilm=`+ data.imdbID + `>Detail</a>
                                <a class="btn btn-secondary trailer" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" data-title="` + data.Title + `">Trailer</a>
                            </div>
                        </div>
                        `);
                })
            } else {
                $('#movie-list').html(`
                    <div class="col">
                        <h1 class="text-center"> Movie Not Found </h1>
                    </div>
                `);
            }
        }
    })
})
$('#movie-list').on('click', '.detail', function () {
    $(".modal-body").html("");
    $.ajax({
        url: 'http://www.omdbapi.com',
        type: 'GET',
        dataType: 'json',
        data: {
            'apikey': '2121c6c',
            'i': $(this).data('idfilm')
        },
        success: function (movie) {
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
        error: function (error) {
            console.log(error);
        }
    })
})
$('#movie-list').on('click', '.trailer', function () {
    $(".modal-body2").html("");
    $.ajax({
        url: 'https://www.googleapis.com/youtube/v3/search',
        type: 'GET',
        dataType: 'json',
        data: {
            'part': 'snippet',
            'key': 'AIzaSyCF4qcCoESONOVF-8RDPpb5JoIRhfe2IuA',
            'q': 'trailer ' + $(this).data('title'),
            'maxResults': 1,
            'type': 'video'
        },
        success: function (trailer) {
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
        error: function (error) {
            console.log(error);
        }
    })
})
// $(".modal").on("hidden.bs.modal", function(){
//     $(".modal-body").html("");
//     $(".modal-body2").html("");
//     console.log("modal closed");
// });