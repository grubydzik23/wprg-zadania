<?php
function insertDollar($array, $n) {
    if ($n < 0 || $n >= count($array)) {
        return "BŁĄD";
    }

    array_splice($array, $n, 0, '$');
    return $array;
}

$input = "1 2 3 4 5 3";
$parts = explode(" ", $input);
$n = array_pop($parts);
if (!is_numeric($n) || $n < 0 || $n >= count($parts)) {
    echo "BŁĄD";
} else {
    $result = insertDollar($parts, $n);
    echo implode(" ", $result);
}
?>
