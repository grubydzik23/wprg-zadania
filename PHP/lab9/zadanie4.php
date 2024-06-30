<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Opinie użytkowników</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        form { margin-bottom: 20px; }
        .opinion { padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px; }
        .opinion-date { font-size: 12px; color: #777; }
        button { margin-top: 10px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Opinie użytkowników</h1>

    <!-- Formularz do dodawania nowych opinii -->
    <h2>Dodaj opinię</h2>
    <form method="post">
        <label for="opinion">Twoja opinia:</label>
        <textarea id="opinion" name="opinion" required></textarea>
        <br><br>
        <button type="submit" name="add_opinion">Wyślij</button>
    </form>

    <?php
    $file = 'opinions.txt';

    // Funkcja do zapisywania opinii do pliku
    function saveOpinions($opinions) {
        global $file;
        file_put_contents($file, json_encode($opinions));
    }

    // Funkcja do ładowania opinii z pliku
    function loadOpinions() {
        global $file;
        if (file_exists($file)) {
            $opinions = json_decode(file_get_contents($file), true);
            if ($opinions) {
                return $opinions;
            }
        }
        return [];
    }

    // Dodawanie nowej opinii
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_opinion"])) {
        $opinion = htmlspecialchars($_POST["opinion"]);
        $opinions = loadOpinions();
        $opinions[] = ['text' => $opinion, 'date' => date('Y-m-d H:i:s')];
        saveOpinions($opinions);
    }

    // Usuwanie opinii
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_opinion"])) {
        $index = $_POST["delete_opinion"];
        $opinions = loadOpinions();
        array_splice($opinions, $index, 1);
        saveOpinions($opinions);
    }

    // Resetowanie wszystkich opinii
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset_opinions"])) {
        saveOpinions([]);
    }

    // Wyświetlanie opinii
    $opinions = loadOpinions();
    if (!empty($opinions)) {
        echo "<h2>Wszystkie opinie</h2>";
        foreach ($opinions as $index => $opinion) {
            echo "<div class='opinion'>";
            echo "<p>" . htmlspecialchars($opinion['text']) . "</p>";
            echo "<p class='opinion-date'>Data: " . $opinion['date'] . "</p>";
            echo "<form method='post' style='display:inline;'>
                        <button type='submit' name='delete_opinion' value='$index'>Usuń</button>
                      </form>";
            echo "</div>";
        }
    } else {
        echo "<p>Brak opinii do wyświetlenia.</p>";
    }
    ?>

    <!-- Formularz do resetowania opinii -->
    <form method="post">
        <button type="submit" name="reset_opinions">Resetuj wszystkie opinie</button>
    </form>
</div>
</body>
</html>
