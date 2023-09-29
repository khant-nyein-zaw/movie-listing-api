<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie Details</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-3">Movie details</h2>
        <div class="card">
            <div class="card-header">Title: {{ $movie['title'] }}</div>
            <div class="card-body">
                <div class="card-title">
                    Author: {{ $movie['author'] }}
                </div>
                <p class="card-text">
                    Summary: {{ $movie['summary'] }}
                </p>
                <p>Genres: {{ $movie['genres'] }}</p>
                <p>Tags: {{ $movie['tags'] }}</p>
                <p>IMDB rating: {{ $movie['imdb_rating'] }}</p>
            </div>
        </div>
    </div>
</body>

</html>
