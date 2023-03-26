<!DOCTYPE html>
<html>
<head>
    <title>Pencarian FILM</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            background-color: #212121;
            color: #fff;
            font-family: Arial, Candara;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
            font-size: 50px;
        }
        form {
            margin: 50px auto;
            max-width: 500px;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }
        input[type="text"] {
            flex-grow: 1;
            width: 100%;
            padding: 15px;
            font-size: 20px;
            border: none;
            border-radius: 5px;
            margin-right: 20px;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: #ffb6c1;
            color: #fff;
            font-size: 20px;
            border: none;
            border-radius: 5px;
            padding: 15px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #d32f2f;
        }
        .results {
            margin: 0 auto;
            max-width: 800px;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .movie {
            background-color: #f44336;
            margin: 20px;
            max-width: 200px;
            width: 100%;
            border-radius: 5px;
            overflow: hidden;
        }
        .movie img {
            max-width: 100%;
            height: auto;
        }
        .movie h3 {
            text-align: center;
            margin: 15px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <h1>Pencarian FILM</h1>
    <form method="GET" action="">
        <input type="text" name="query" placeholder="Cari film...">
        <input type="submit" value="Cari">
    </form>
    <?php
    if(isset($_GET['query'])) {
        $query = urlencode($_GET['query']);
        $api_endpoint = "https://api.themoviedb.org/3/search/movie?api_key=4d8e22f260013afe878010e16306630f&query=$query";
        $response = file_get_contents($api_endpoint);
        $movies = json_decode($response, true)['results'];
        if(count($movies) > 0) {
            echo '<div class="results">';
            foreach($movies as $movie) {
                $title = $movie['title'];
                $poster_path = $movie['poster_path'];
                $poster_url = $poster_path ? "https://image.tmdb.org/t/p/w500$poster_path" : "https://via.placeholder.com/500x750.png?text=No+poster+available";
                echo '<div class="movie">';
                echo "<img src=\"$poster_url\">";
                echo "<h3>$title</h3>";
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>No results found.</p>';
        }
    }
    ?>
</body>
</html>
