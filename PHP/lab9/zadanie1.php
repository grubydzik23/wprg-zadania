<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Sprawdzanie rozmiaru pliku/katalogu</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        .result { margin-top: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Sprawdzanie rozmiaru pliku/katalogu</h1>
    <form method="post">
        <label for="path">Wprowadź nazwę pliku lub katalogu:</label>
        <input type="text" id="path" name="path" required>
        <br><br>
        <button type="submit" name="submit">Wyślij</button>
    </form>

    <?php
    function getDirectorySize($dir) {
        $size = 0;
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file) {
            $size += $file->getSize();
        }
        return $size;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["path"])) {
        $path = $_POST["path"];

        if (file_exists($path)) {
            if (is_file($path)) {
                $size = filesize($path);
            } elseif (is_dir($path)) {
                $size = getDirectorySize($path);
            } else {
                $size = 0;
            }

            $size_in_bytes = $size;
            $size_in_megabytes = $size / (1024 * 1024);
            $size_in_gigabytes = $size / (1024 * 1024 * 1024);

            echo "<div class='result'>
                        <p>Rozmiar w bajtach: $size_in_bytes B</p>
                        <p>Rozmiar w megabajtach: " . number_format($size_in_megabytes, 2) . " MB</p>
                        <p>Rozmiar w gigabajtach: " . number_format($size_in_gigabytes, 2) . " GB</p>
                      </div>";
        } else {
            echo "<div class='result'>Plik lub katalog o nazwie '$path' nie istnieje.</div>";
        }
    }
    ?>
</div>
</body>
</html>
