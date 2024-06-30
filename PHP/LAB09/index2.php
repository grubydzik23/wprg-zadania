<?php

echo date("Y-m-d H:i:s");

print_r(getdate(mktime(0,0,0, 5, 10, 2024)));

print_r(getdate(strtotime("18 march 1876")));

 checkdate(13, 2, 1999);