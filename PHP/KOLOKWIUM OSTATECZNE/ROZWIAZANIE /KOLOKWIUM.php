<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Baza Danych Filmów</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            margin-bottom: 60px;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            cursor: pointer;
            background-color: #f9f9f9;
        }
        th:hover {
            background-color: #f1f1f1;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .form-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
            width: 50%;
        }
        form label {
            display: block;
            margin-top: 10px;
        }
        form input {
            width: calc(100% - 20px);
            padding: 8px;
            margin-top: 5px;
        }
        form button {
            margin-top: 10px;
            padding: 10px;
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background-color: #45a049;
        }
        .actions button {
            background-color: #1E90FF;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .actions button:hover {
            background-color: #00BFFF;
        }
        .sort-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .sort-buttons button {
            background-color: green;
            color: white;
            border: none;
            padding: 10px;
            margin: 0 5px;
            cursor: pointer;
        }
        .sort-buttons button:hover {
            background-color: #45a049;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
<header>
    <h1>Baza Danych Filmów</h1>
</header>
<div class="container">
    <?php
    class Movie {
        public $id;
        public $title;
        public $director;
        public $releaseYear;
        public $genre;
        public $rating;

        public function __construct($id, $title, $director, $releaseYear, $genre, $rating) {
            $this->id = $id;
            $this->title = $title;
            $this->director = $director;
            $this->releaseYear = $releaseYear;
            $this->genre = $genre;
            $this->rating = $rating;
        }
    }

    function loadMoviesFromCSV($filename) {
        $movies = [];

        if (!file_exists($filename) || !is_readable($filename)) {
            throw new Exception("File not found or not readable.");
        }

        $header = null;
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    if (count($row) != 6) {
                        throw new Exception("Invalid data format.");
                    }
                    $movies[] = new Movie($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
                }
            }
            fclose($handle);
        } else {
            throw new Exception("Unable to open file.");
        }

        return $movies;
    }

    try {
        $movies = loadMoviesFromCSV('movies.csv');
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }
    ?>
    <div class="sort-buttons">
        <button onclick="sortTable(3, true)">Sortuj Rok Wydania (Rosnąco)</button>
        <button onclick="sortTable(3, false)">Sortuj Rok Wydania (Malejąco)</button>
        <button onclick="sortTable(5, true)">Sortuj Ocena (Rosnąco)</button>
        <button onclick="sortTable(5, false)">Sortuj Ocena (Malejąco)</button>
    </div>
    <div id="movieTableContainer"></div>
    <div class="form-container">
        <form id="movieForm" onsubmit="addMovie(event)">
            <h2>Dodaj Film</h2>
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" required>
            <label for="title">Tytuł:</label>
            <input type="text" id="title" name="title" required>
            <label for="director">Reżyser:</label>
            <input type="text" id="director" name="director" required>
            <label for="releaseYear">Rok Wydania:</label>
            <input type="text" id="releaseYear" name="releaseYear" required>
            <label for="genre">Gatunek:</label>
            <input type="text" id="genre" name="genre" required>
            <label for="rating">Ocena:</label>
            <input type="text" id="rating" name="rating" required>
            <button type="submit">Dodaj</button>
        </form>
    </div>
</div>
<footer>
    © 2024 Baza Danych Filmów
</footer>

<script>
    let movies = <?php echo json_encode($movies); ?>;

    function generateTable(movies) {
        let table = '<table><thead><tr>';
        table += '<th>ID</th>';
        table += '<th>Tytuł</th>';
        table += '<th>Reżyser</th>';
        table += '<th>Rok Wydania</th>';
        table += '<th>Gatunek</th>';
        table += '<th>Ocena</th>';
        table += '<th>Akcje</th>';
        table += '</tr></thead><tbody>';

        movies.forEach(movie => {
            table += `<tr>
                            <td>${movie.id}</td>
                            <td>${movie.title}</td>
                            <td>${movie.director}</td>
                            <td>${movie.releaseYear}</td>
                            <td>${movie.genre}</td>
                            <td>${movie.rating}</td>
                            <td class="actions"><button onclick="editMovie(${movie.id})">Edytuj</button></td>
                          </tr>`;
        });
        table += '</tbody></table>';
        document.getElementById('movieTableContainer').innerHTML = table;
    }

    function sortTable(n, ascending) {
        movies.sort((a, b) => {
            let aVal = Object.values(a)[n];
            let bVal = Object.values(b)[n];
            if (aVal < bVal) return ascending ? -1 : 1;
            if (aVal > bVal) return ascending ? 1 : -1;
            return 0;
        });
        generateTable(movies);
    }

    function addMovie(event) {
        event.preventDefault();
        const form = event.target;
        const newMovie = {
            id: form.id.value,
            title: form.title.value,
            director: form.director.value,
            releaseYear: form.releaseYear.value,
            genre: form.genre.value,
            rating: form.rating.value
        };

        if (movies.some(movie => movie.id == newMovie.id)) {
            alert("Film o tym ID już istnieje.");
            return;
        }

        movies.push(newMovie);
        generateTable(movies);
        form.reset();
    }

    function editMovie(id) {
        const movieIndex = movies.findIndex(movie => movie.id == id);
        if (movieIndex !== -1) {
            const form = document.getElementById('movieForm');
            form.id.value = movies[movieIndex].id;
            form.title.value = movies[movieIndex].title;
            form.director.value = movies[movieIndex].director;
            form.releaseYear.value = movies[movieIndex].releaseYear;
            form.genre.value = movies[movieIndex].genre;
            form.rating.value = movies[movieIndex].rating;
            form.querySelector('button[type="submit"]').textContent = "Aktualizuj";
            form.onsubmit = function(event) {
                event.preventDefault();
                movies[movieIndex].title = form.title.value;
                movies[movieIndex].director = form.director.value;
                movies[movieIndex].releaseYear = form.releaseYear.value;
                movies[movieIndex].genre = form.genre.value;
                movies[movieIndex].rating = form.rating.value;
                form.reset();
                form.querySelector('button[type="submit"]').textContent = "Dodaj";
                form.onsubmit = addMovie;

                generateTable(movies);
            };
        }
    }
    generateTable(movies);
</script>
</body>
</html>