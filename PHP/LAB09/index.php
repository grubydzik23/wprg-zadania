<?php
//opendir
//readdir(identyfikator)
//scandir

//if (!($fd = opendir("./"))) {
//    exit("Nie ma takiego katalogu");
//}
//while (($file = readdir($fd)) !== false) {
//    echo $file . "\n";
//}
//
//print_r(scandir("./", 1));
//
//mkdir('kapibarowyKatalog223/kapibara', 0777, true);
//rmdir("kapibarowyKatalog223/kapibara");
//echo getcwd();
//chdir('..');
//echo getcwd();
//
//echo file_exists("kapibarowyKatalog223");


//files
$file =  fopen("kapi", 'w');


//reading files

//echo fgets($file);
//echo fgetc($file);
//echo fread($file, filesize("kapi"));
//echo readfile('kapi');
//echo file_get_contents('kapi');

//writing to files

fwrite($file, "kapibara!");
file_put_contents("bara", "kapibara!", FILE_APPEND);
file_put_contents("bara", "kapibara!", FILE_APPEND);
file_put_contents("bara", "kapibara!", FILE_APPEND);
file_put_contents("bara", "kapibara!", FILE_APPEND);
file_put_contents("bara", "kapibara!", FILE_APPEND);

fseek($file, 10, SEEK_SET);
rewind($file);
flock($file, LOCK_UN);
unlink("bara");
filesize("kapibara");
fileatime("kapibara");
filectime("kapibara");
filetype("kapibara");
fileperms("kapibara");
fileowner("kapibara");
disk_free_space();
disk_total_space();

fclose($file);

