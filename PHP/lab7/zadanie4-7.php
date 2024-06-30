<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadania PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        .section { margin-bottom: 40px; }
        .result { margin-top: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Zadania PHP</h1>

    <!-- Zadanie 4 -->
    <div class="section">
        <h2>Zadanie 4: Kalkulator Zbiorów</h2>
        <form method="post">
            <label for="set1">Wprowadź pierwszy zbiór (liczby oddzielone spacjami):</label>
            <input type="text" id="set1" name="set1" required>
            <br><br>
            <label for="set2">Wprowadź drugi zbiór (liczby oddzielone spacjami):</label>
            <input type="text" id="set2" name="set2" required>
            <br><br>
            <label for="operation">Wybierz operację:</label>
            <select id="operation" name="operation">
                <option value="union">Suma</option>
                <option value="difference">Różnica</option>
                <option value="intersection">Część wspólna</option>
            </select>
            <br><br>
            <button type="submit" name="task" value="set_calculator">Wykonaj</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["task"] == "set_calculator") {
            $set1 = explode(" ", $_POST["set1"]);
            $set2 = explode(" ", $_POST["set2"]);
            $operation = $_POST["operation"];

            $result = [];

            switch ($operation) {
                case "union":
                    $result = array_unique(array_merge($set1, $set2));
                    break;
                case "difference":
                    $result = array_diff($set1, $set2);
                    break;
                case "intersection":
                    $result = array_intersect($set1, $set2);
                    break;
                default:
                    $result = "Nieznana operacja";
            }

            echo "<div class='result'>Wynik: " . implode(" ", $result) . "</div>";
        }
        ?>
    </div>

    <!-- Zadanie 5 -->
    <div class="section">
        <h2>Zadanie 5: Kalkulator</h2>
        <form method="post">
            <label for="num1">Wprowadź pierwszą liczbę:</label>
            <input type="number" id="num1" name="num1" required>
            <br><br>
            <label for="num2">Wprowadź drugą liczbę:</label>
            <input type="number" id="num2" name="num2" required>
            <br><br>
            <label for="simple_operation">Wybierz operację prostą:</label>
            <select id="simple_operation" name="simple_operation">
                <option value="add">Dodawanie</option>
                <option value="subtract">Odejmowanie</option>
                <option value="multiply">Mnożenie</option>
                <option value="divide">Dzielenie</option>
            </select>
            <br><br>
            <label for="advanced_operation">Wybierz operację zaawansowaną:</label>
            <select id="advanced_operation" name="advanced_operation">
                <option value="cosine">Cosinus</option>
                <option value="sine">Sinus</option>
                <option value="tangent">Tangens</option>
                <option value="bin_to_dec">Binarne na dziesiętne</option>
                <option value="dec_to_bin">Dziesiętne na binarne</option>
                <option value="dec_to_hex">Dziesiętne na szesnastkowe</option>
                <option value="hex_to_dec">Szesnastkowe na dziesiętne</option>
            </select>
            <br><br>
            <button type="submit" name="task" value="calculator">Wykonaj</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["task"] == "calculator") {
            $num1 = $_POST["num1"];
            $num2 = $_POST["num2"];
            $simple_operation = $_POST["simple_operation"];
            $advanced_operation = $_POST["advanced_operation"];
            $result_simple = "";
            $result_advanced = "";

            // Simple Calculator
            switch ($simple_operation) {
                case "add":
                    $result_simple = $num1 + $num2;
                    break;
                case "subtract":
                    $result_simple = $num1 - $num2;
                    break;
                case "multiply":
                    $result_simple = $num1 * $num2;
                    break;
                case "divide":
                    if ($num2 != 0) {
                        $result_simple = $num1 / $num2;
                    } else {
                        $result_simple = "Błąd: Dzielenie przez zero";
                    }
                    break;
                default:
                    $result_simple = "Nieznana operacja";
            }

            switch ($advanced_operation) {
                case "cosine":
                    $result_advanced = cos($num1);
                    break;
                case "sine":
                    $result_advanced = sin($num1);
                    break;
                case "tangent":
                    $result_advanced = tan($num1);
                    break;
                case "bin_to_dec":
                    $result_advanced = bindec($num1);
                    break;
                case "dec_to_bin":
                    $result_advanced = decbin($num1);
                    break;
                case "dec_to_hex":
                    $result_advanced = dechex($num1);
                    break;
                case "hex_to_dec":
                    $result_advanced = hexdec($num1);
                    break;
                default:
                    $result_advanced = "Nieznana operacja";
            }

            echo "<div class='result'>Wynik prosty: $result_simple</div>";
            echo "<div class='result'>Wynik zaawansowany: $result_advanced</div>";
        }
        ?>
    </div>

    <!-- Zadanie 6 -->
    <div class="section">
        <h2>Zadanie 6: Obliczanie daty Wielkanocy</h2>
        <form method="post">
            <label for="year">Wprowadź rok:</label>
            <input type="number" id="year" name="year" required>
            <br><br>
            <button type="submit" name="task" value="easter">Oblicz</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["task"] == "easter") {
            $year = $_POST["year"];
            if ($year >= 1 && $year <= 1582) { $x = 15; $y = 6; }
            elseif ($year >= 1583 && $year <= 1699) { $x = 22; $y = 2; }
            elseif ($year >= 1700 && $year <= 1799) { $x = 23; $y = 3; }
            elseif ($year >= 1800 && $year <= 1899) { $x = 23; $y = 4; }
            elseif ($year >= 1900 && $year <= 2099) { $x = 24; $y = 5; }
            elseif ($year >= 2100 && $year <= 2199) { $x = 24; $y = 6; }
            else { echo "Nieprawidłowy rok"; exit; }

            $a = $year % 19;
            $b = $year % 4;
            $c = $year % 7;
            $d = (19 * $a + $x) % 30;
            $e = (2 * $b + 4 * $c + 6 * $d + $y) % 7;

            if ($e == 6 && $d == 29) {
                $easter = "26 kwietnia";
            } elseif ($e == 6 && $d == 28 && (11 * $x + 11) % 30 < 19) {
                $easter = "18 kwietnia";
            } elseif (($d + $e) < 10) {
                $easter = (22 + $d + $e) . " marca";
            } else {
                $easter = ($d + $e - 9) . " kwietnia";
            }

            echo "<div class='result'>Wielkanoc w roku $year przypada na: $easter</div>";
        }
        ?>
    </div>

    <!-- Zadanie 7 -->
    <div class="section">
        <h2>Zadanie 7: Gra w kamień, papier, nożyce</h2>
        <form method="post">
            <label for="player_choice">Wybierz:</label>
            <select id="player_choice" name="player_choice">
                <option value="kamień">Kamień</option>
                <option value="papier">Papier</option>
                <option value="nożyce">Nożyce</option>
            </select>
            <br><br>
            <button type="submit" name="task" value="rps_game">Zagraj</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["task"] == "rps_game") {
            $choices = ["kamień", "papier", "nożyce"];
            $player_choice = $_POST["player_choice"];
            $computer_choice = $choices[array_rand($choices)];

            if ($player_choice == $computer_choice) {
                $result = "Remis!";
            } elseif (($player_choice == "kamień" && $computer_choice == "nożyce") ||
                ($player_choice == "papier" && $computer_choice == "kamień") ||
                ($player_choice == "nożyce" && $computer_choice == "papier")) {
                $result = "Wygrałeś!";
            } else {
                $result = "Przegrałeś!";
            }

            echo "<div class='result'>Twój wybór: $player_choice<br>Wybór komputera: $computer_choice<br>$result</div>";
        }
        ?>
    </div>
</div>
</body>
</html>
