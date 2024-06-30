<?php
function licz_spolgloski($string) {
    $spolgloski = array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z');
    $licz = 0;
    foreach (str_split($string) as $char) {
        if (in_array(strtolower($char), $spolgloski)) {
            $licz++;
        }
    }
    return $licz;
}

$input_string = readline("Wprowadź dowolny ciąg znaków: ");
echo "Liczba spółgłosek w podanym ciągu to: " . licz_spolgloski($input_string);
?>