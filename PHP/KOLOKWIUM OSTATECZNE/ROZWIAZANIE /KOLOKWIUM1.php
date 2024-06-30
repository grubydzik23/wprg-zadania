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
        .actions {
            text-align: center;
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

    function generateTable($movies) {
        echo '<table><thead><tr>';
        echo '<th>ID</th>';
        echo '<th>Tytuł</th>';
        echo '<th>Reżyser</th>';
        echo '<th>Rok Wydania</th>';
        echo '<th>Gatunek</th>';
        echo '<th>Ocena</th>';
        echo '<th>Akcje</th>';
        echo '</tr></thead><tbody>';
        foreach ($movies as $movie) {
            echo "<tr>
                    <td>{$movie->id}</td>
                    <td>{$movie->title}</td>
                    <td>{$movie->director}</td>
                    <td>{$movie->releaseYear}</td>
                    <td>{$movie->genre}</td>
                    <td>{$movie->rating}</td>
                    <td class='actions'>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='edit_id' value='{$movie->id}'>
                            <button type='submit'>Edytuj</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo '</tbody></table>';
    }

    function saveMoviesToCSV($filename, $movies) {
        $handle = fopen($filename, 'w');
        foreach ($movies as $movie) {
            fputcsv($handle, [$movie->id, $movie->title, $movie->director, $movie->releaseYear, $movie->genre, $movie->rating]);
        }
        fclose($handle);
    }

    try {
        $movies = loadMoviesFromCSV('movies.csv');
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $director = $_POST['director'];
            $releaseYear = $_POST['releaseYear'];
            $genre = $_POST['genre'];
            $rating = $_POST['rating'];
            $edited = false;
            foreach ($movies as $movie) {
                if ($movie->id == $id) {
                    $movie->title = $title;
                    $movie->director = $director;
                    $movie->releaseYear = $releaseYear;
                    $movie->genre = $genre;
                    $movie->rating = $rating;
                    $edited = true;
                    break;
                }
            }

            if (!$edited) {
                $movies[] = new Movie($id, $title, $director, $releaseYear, $genre, $rating);
            }

            saveMoviesToCSV('movies.csv', $movies);
        } elseif (isset($_POST['edit_id'])) {
            $edit_id = $_POST['edit_id'];
            $edit_movie = null;
            foreach ($movies as $movie) {
                if ($movie->id == $edit_id) {
                    $edit_movie = $movie;
                    break;
                }
            }
        }
    }

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        $order = $_GET['order'] === 'asc' ? SORT_ASC : SORT_DESC;

        array_multisort(array_column($movies, $sort), $order, $movies);
    }
    ?>

    <div class="sort-buttons">
        <button onclick="window.location.href='?sort=releaseYear&order=asc'">Sortuj Rok Wydania (Rosnąco)</button>
        <button onclick="window.location.href='?sort=releaseYear&order=desc'">Sortuj Rok Wydania (Malejąco)</button>
        <button onclick="window.location.href='?sort=rating&order=asc'">Sortuj Ocena (Rosnąco)</button>
        <button onclick="window.location.href='?sort=rating&order=desc'">Sortuj Ocena (Malejąco)</button>
    </div>
    <div id="movieTableContainer">
        <?php generateTable($movies); ?>
    </div>
    <div class="form-container">
        <form method="POST">
            <h2><?php echo isset($edit_movie) ? 'Edytuj Film' : 'Dodaj Film'; ?></h2>
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" value="<?php echo isset($edit_movie) ? $edit_movie->id : ''; ?>" required>
            <label for="title">Tytuł:</label>
            <input type="text" name="title" id="title" value="<?php echo isset($edit_movie) ? $edit_movie->title : ''; ?>" required>
            <label for="director">Reżyser:</label>
            <input type="text" name="director" id="director" value="<?php echo isset($edit_movie) ? $edit_movie->director : ''; ?>" required>
            <label for="releaseYear">Rok Wydania:</label>
            <input type="number" name="releaseYear" id="releaseYear" value="<?php echo isset($edit_movie) ? $edit_movie->releaseYear : ''; ?>" required>
            <label for="genre">Gatunek:</label>
            <input type="text" name="genre" id="genre" value="<?php echo isset($edit_movie) ? $edit_movie->genre : ''; ?>" required>
            <label for="rating">Ocena:</label>
            <input type="number" name="rating" id="rating" value="<?php echo isset($edit_movie) ? $edit_movie->rating : ''; ?>" step="0.1" required>
            <button type="submit"><?php echo isset($edit_movie) ? 'Zapisz zmiany' : 'Dodaj Film'; ?></button>
        </form>
    </div>
</div>
<footer>
    <p>&copy; 2024 Twoja Baza Danych Filmów</p>
</footer>
</body>
</html>
