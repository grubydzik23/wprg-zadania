<?php
echo "<table>";
echo "<tr><td>a</td><td>b</td><td>pow(a, b)</td></tr>";
for ($x = 1; $x <= 10; $x++) {
    $pow_result = pow($x, $x+1);
    echo "<tr><td>$x</td><td>" . ($x+1) . "</td><td>$pow_result</td></tr>";
}
echo "</table>";