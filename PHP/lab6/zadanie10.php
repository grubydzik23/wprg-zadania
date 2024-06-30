<?php
function sprawdzHaslo($haslo) {
    if (strlen($haslo) < 8) {
        return false;
    }
    if (!ctype_alnum($haslo)) {
        return false;
    }
    $digitCount = 0;
    for ($i = 0; $i < strlen($haslo); $i++) {
        if (ctype_digit($haslo[$i])) {
            $digitCount++;
        }
    }
    return $digitCount >= 2;
}

// Przykład użycia
$haslo = "abc12345";
if (sprawdzHaslo($haslo)) {
    echo "Hasło jest prawidłowe";
} else {
    echo "Hasło jest nieprawidłowe";
}
?>
