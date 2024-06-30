<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Obliczenia</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        form { margin-bottom: 40px; }
        .result { margin-top: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Obliczenia</h1>

    <!-- Formularz obliczania wieku i czasu lokalnego -->
    <h2>Obliczanie wieku i czasu lokalnego</h2>
    <form method="post">
        <label for="birth_date">Data urodzenia (d-m-Y):</label>
        <input type="text" id="birth_date" name="birth_date" required pattern="\d{2}-\d{2}-\d{4}">
        <br><br>
        <label for="timezone">Strefa czasowa:</label>
        <input type="text" id="timezone" name="timezone" required>
        <br><br>
        <button type="submit" name="calculate_age_time">Oblicz</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["calculate_age_time"])) {
        $birth_date = DateTime::createFromFormat('d-m-Y', $_POST["birth_date"]);
        $timezone = $_POST["timezone"];

        if ($birth_date && timezone_identifiers_list(DateTimeZone::ALL_WITH_BC, $timezone)) {
            $now = new DateTime('now', new DateTimeZone($timezone));
            $age = $now->diff($birth_date)->y;

            echo "<div class='result'>";
            echo "Wiek: $age lat<br>";
            echo "Aktualny czas w strefie $timezone: " . $now->format('Y-m-d H:i:s');
            echo "</div>";
        } else {
            echo "<div class='result'>Niepoprawne dane wejściowe.</div>";
        }
    }
    ?>

    <!-- Formularz obliczania dni roboczych -->
    <h2>Obliczanie dni roboczych</h2>
    <form method="post">
        <label for="start_date">Data początkowa (d-m-Y):</label>
        <input type="text" id="start_date" name="start_date" required pattern="\d{2}-\d{2}-\d{4}">
        <br><br>
        <label for="end_date">Data końcowa (d-m-Y):</label>
        <input type="text" id="end_date" name="end_date" required pattern="\d{2}-\d{2}-\d{4}">
        <br><br>
        <button type="submit" name="calculate_workdays">Oblicz</button>
    </form>

    <?php
    function countWorkdays($start_date, $end_date) {
        $start = DateTime::createFromFormat('d-m-Y', $start_date);
        $end = DateTime::createFromFormat('d-m-Y', $end_date);
        $workdays = 0;

        while ($start <= $end) {
            if ($start->format('N') < 6) {
                $workdays++;
            }
            $start->modify('+1 day');
        }
        return $workdays;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["calculate_workdays"])) {
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];

        $start = DateTime::createFromFormat('d-m-Y', $start_date);
        $end = DateTime::createFromFormat('d-m-Y', $end_date);

        if ($start && $end && $start <= $end) {
            $workdays = countWorkdays($start_date, $end_date);
            echo "<div class='result'>";
            echo "Liczba dni roboczych między $start_date a $end_date: $workdays";
            echo "</div>";
        } else {
            echo "<div class='result'>Niepoprawne dane wejściowe lub data końcowa jest wcześniejsza niż data początkowa.</div>";
        }
    }
    ?>
</div>
</body>
</html>
