<!DOCTYPE html>
<html>
<head>
    <title>Analiza i przetwarzanie tekstu za pomocą wyrażeń regularnych</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .result { margin-top: 20px; }
    </style>
</head>
<body>
<h2>Analiza i przetwarzanie tekstu za pomocą wyrażeń regularnych</h2>
<form method="post">
    <label for="text">Wprowadź tekst:</label>
    <input type="text" id="text" name="text" required>
    <br><br>
    <label for="pattern">Wprowadź wzorzec regex:</label>
    <input type="text" id="pattern" name="pattern" required>
    <br><br>
    <label for="regexOperation">Wybierz operację:</label>
    <select id="regexOperation" name="regexOperation">
        <option value="match">Znajdowanie wszystkich wystąpień wzorca</option>
        <option value="match_positions">Znajdowanie i wyświetlanie pozycji wystąpień wzorca</option>
        <option value="replace">Zamiana wyrażeń pasujących do wzorca</option>
        <option value="validate">Sprawdzanie czy tekst pasuje do wzorca</option>
    </select>
    <br><br>
    <div id="replaceTextDiv" style="display: none;">
        <label for="replaceText">Wprowadź tekst zamiany:</label>
        <input type="text" id="replaceText" name="replaceText">
        <br><br>
    </div>
    <button type="submit" name="submit">Wykonaj</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST["text"];
    $pattern = $_POST["pattern"];
    $regexOperation = $_POST["regexOperation"];
    $result = "";

    if (!empty($text) && !empty($pattern)) {
        switch ($regexOperation) {
            case "match":
                if (preg_match_all("/$pattern/", $text, $matches)) {
                    $result = implode(", ", $matches[0]);
                } else {
                    $result = "Brak dopasowań.";
                }
                break;
            case "match_positions":
                if (preg_match_all("/$pattern/", $text, $matches, PREG_OFFSET_CAPTURE)) {
                    foreach ($matches[0] as $match) {
                        $result .= "Dopasowanie: '$match[0]' na pozycji: $match[1]<br>";
                    }
                } else {
                    $result = "Brak dopasowań.";
                }
                break;
            case "replace":
                $replaceText = $_POST["replaceText"];
                if (!empty($replaceText)) {
                    $result = preg_replace("/$pattern/", $replaceText, $text);
                } else {
                    $result = "Proszę wprowadzić tekst zamiany.";
                }
                break;
            case "validate":
                if (preg_match("/$pattern/", $text)) {
                    $result = "Tekst pasuje do wzorca.";
                } else {
                    $result = "Tekst nie pasuje do wzorca.";
                }
                break;
        }
        echo "<div class='result'>Wynik:<br>$result</div>";
    } else {
        echo "<div class='result'>Proszę wprowadzić tekst i wzorzec regex.</div>";
    }
}
?>

<script>
    document.getElementById('regexOperation').addEventListener('change', function () {
        var replaceTextDiv = document.getElementById('replaceTextDiv');
        if (this.value === 'replace') {
            replaceTextDiv.style.display = 'block';
        } else {
            replaceTextDiv.style.display = 'none';
        }
    });
</script>
</body>
</html>
