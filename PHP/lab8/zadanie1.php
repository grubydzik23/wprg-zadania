<!DOCTYPE html>
<html>
<head>
    <title>Operacje na ciągach znaków</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .result { margin-top: 20px; }
    </style>
</head>
<body>
<h2>Operacje na ciągach znaków</h2>
<form method="post">
    <label for="inputString">Wprowadź ciąg znaków:</label>
    <input type="text" id="inputString" name="inputString" required>
    <br><br>
    <label for="operation">Wybierz operację:</label>
    <select id="operation" name="operation">
        <option value="reverse">Odwrócenie ciągu znaków</option>
        <option value="uppercase">Zamiana wszystkich liter na wielkie</option>
        <option value="lowercase">Zamiana wszystkich liter na małe</option>
        <option value="length">Liczenie liczby znaków</option>
        <option value="trim">Usuwanie białych znaków z początku i końca ciągu</option>
    </select>
    <br><br>
    <button type="submit" name="submit">Wykonaj</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputString = $_POST["inputString"];
    $operation = $_POST["operation"];
    $result = "";

    if (!empty($inputString)) {
        switch ($operation) {
            case "reverse":
                $result = strrev($inputString);
                break;
            case "uppercase":
                $result = strtoupper($inputString);
                break;
            case "lowercase":
                $result = strtolower($inputString);
                break;
            case "length":
                $result = strlen($inputString);
                break;
            case "trim":
                $result = trim($inputString);
                break;
        }
        echo "<div class='result'>Wynik: $result</div>";
    } else {
        echo "<div class='result'>Proszę wprowadzić ciąg znaków.</div>";
    }
}
?>
</body>
</html>
