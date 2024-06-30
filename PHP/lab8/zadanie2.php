<!DOCTYPE html>
<html>
<head>
    <title>Zaawansowane operacje na ciągach znaków</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .result { margin-top: 20px; }
    </style>
</head>
<body>
<h2>Zaawansowane operacje na ciągach znaków</h2>
<form method="post">
    <label for="inputText">Wprowadź ciąg znaków:</label>
    <input type="text" id="inputText" name="inputText" required>
    <br><br>
    <label for="advancedOperation">Wybierz operację:</label>
    <select id="advancedOperation" name="advancedOperation">
        <option value="unique_words">Ekstrakcja unikalnych słów i ich częstotliwość występowania</option>
        <option value="sort_asc">Sortowanie alfabetyczne słów rosnąco</option>
        <option value="sort_desc">Sortowanie alfabetyczne słów malejąco</option>
    </select>
    <br><br>
    <button type="submit" name="submit">Wykonaj</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputText = $_POST["inputText"];
    $advancedOperation = $_POST["advancedOperation"];
    $result = "";

    if (!empty($inputText)) {
        $words = array_filter(explode(" ", $inputText));

        switch ($advancedOperation) {
            case "unique_words":
                $wordFrequency = array_count_values($words);
                foreach ($wordFrequency as $word => $count) {
                    $result .= "$word: $count<br>";
                }
                break;
            case "sort_asc":
                sort($words);
                $result = implode(" ", $words);
                break;
            case "sort_desc":
                rsort($words);
                $result = implode(" ", $words);
                break;
        }
        echo "<div class='result'>Wynik:<br>$result</div>";
    } else {
        echo "<div class='result'>Proszę wprowadzić ciąg znaków.</div>";
    }
}
?>
</body>
</html>
