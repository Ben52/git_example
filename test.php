<?php

$handle = fopen("test.txt", "r+");

$dataString = "This is a test of the fwrite() function";

fwrite($handle, $dataString);


print_r($handle);










  ?>
