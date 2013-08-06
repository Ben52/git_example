<?php
   //an example of a regular array
  $myarray = array('steve', 'joe', 'stan');
  $myarray[] = 'asher';


   print_r($myarray);

// an example of an associative array
   $associative_array = array('name1' => 'joe', 'name2' => 'stan');
   $associative_array['myobject'] = new myclass();
   print_r($associative_array);


//an example of a count array function, it counts the values in the array
   echo count($myarray);



  class myclass{}
 ?>
