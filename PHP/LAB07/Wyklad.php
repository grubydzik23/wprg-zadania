<?php

$array = [];
$array = [2,3,4,5];
$array = [2,true,"elo"];

print_r($array);

$array2['kapibara'] = 'studenciara';
$array2['marchewka'] = true;
print_r($array2);

$array3[2] = "costam";

$tablica = array('kapibara', 'kapibaraaa', 'kapibaraaaaaaaa');
print_r($tablica);
$tablica[] = 'wiecejkapibar';
print_r($tablica);

$array2[] = 'kapibara';

print_r($array2);
/* =================== */

$range = range(2,5, 2);
print_r($range);


$range2 = array_pad($range,10, 0);

print_r($range2);

$tablicaDwuwymiarowa[0] = $range;
$tablicaDwuwymiarowa[1] = $range2;

print_r($tablicaDwuwymiarowa);

list($zmienna1, $zmienna2) = $range;

print_r($zmienna1);
print_r($zmienna2);


$czank = array_chunk($range2, 3);

print_r($czank);

$slice = array_slice($range2, 0, 3);
print_r($slice);

print_r(array_keys($array2));
print_r(array_values($range2));

array_splice($range2, 2, 3, [2,3]);

print_r($range2);

extract($array2);
print $kapibara;

$zmienna = 'elo';

print_r(compact('kapibara', 'marchewka', 'zmienna'));

foreach ($array2 as $item) {
     print_r($item);

}
print_r("\n");
print_r($range2);
array_walk($range2, 'parzysta');

function parzysta($value, $key) {
//    print_r( $value % 2 == 0);
    echo $value * 3;
}

in_array();
array_search();

sort();
asort();
ksort();

array_flip();
array_sum();
array_merge();
array_diff();

array_filter();



