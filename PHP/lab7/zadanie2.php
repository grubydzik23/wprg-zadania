<?php
function convertOctalToHex($octalNumbers) {
    $hexNumbers = [];
    foreach ($octalNumbers as $octal) {
        $decimal = octdec($octal);
        $hex = dechex($decimal);
        $hexNumbers[] = "0x" . $hex;
    }
    return $hexNumbers;
}

// Example usage:
$input = "717 233";
$octalNumbers = explode(" ", $input);
$hexNumbers = convertOctalToHex($octalNumbers);
echo implode(" ", $hexNumbers);
?>
