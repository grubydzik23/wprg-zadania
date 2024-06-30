<?php

//$zmienna = "kapibara";
//$n = 3;
//
//echo '$zmienna';
//echo "$zmienna";
//
//echo "this is the ${n}th capybara named \nGort";
//
//
//$elo =  "    elo elo    ";
//echo print_r($zmienna);
//echo print($zmienna);
//
//strlen($zmienna);
//
//echo trim("\n" . $elo, " ");

//$html = htmlentities("üsdasdasdasd");
//$html = htmlspecialchars("üsdasdasdasd<><>&");
//echo $html;
//
//echo strip_tags("<b>Kapibara</b>");
//
//echo 3 == "3";
//echo 3 === "3";

$str1 = "kapibarakapibara";
$str2 = "kapxxxxa";

//echo $str1 < $str2;
//echo strcmp($str1, $str2);

//echo similar_text($str1, $str2);
//echo levenshtein($str1,$str2);
//
//echo substr($str1, 2,4);
//echo substr_count($str1, "ka");
//echo substr_replace($str1, "mati", 0, 4);
//echo strrev($str1);
//
//echo str_repeat("kapibara", 3);
//
//$tablica = explode(",","kapibar1,kapibar2,kapibar3");
//print_r($tablica);
//$znaki = implode(';',$tablica);
//echo $znaki;

$token = strtok("kapibar1,kapibar2,kapibar3", ",");

while ($token !== false) {
    echo $token;
    $token = strtok(",");
}

$position = strpos("kapibar1,kapibar2,kapibar3", "1");
echo $position;

$substring = substr("kapibar1,kapibar2,kapibar3", $position,10);
echo $substring;

echo strstr("kapibar1,kapibar2,kapibar3","1");