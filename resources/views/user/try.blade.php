<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>laravel</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/6/2Q4d7z5e5f5e5f5e5f5e5f5e5f5e5f5e5f" crossorigin="anonymous">
    </head>
    <body>
        
   
@foreach ($doctor as $doctors)
                        <div class="col-md-3 single-pf">
                            <div class="team-item position-relative rounded overflow-hidden wow fadeInUp" data-wow-delay="0.1s">
                                <div class="overflow-hidden">
                                    <img class="img-fluid" src="../assets/img/imagemedecin5 (1).jfif" alt="Doctor Image">
                                </div>
                                <div class="team-text bg-light text-center p-4">
                                    <h5>Dr ATTOU Abdelkader</h5>
                                    <p class="text-primary">DERMATOLOGIE</p>
                                </div>
                            </div>
                            @endforeach
                            </body>
                            </html>