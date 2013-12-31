<?php
  $info = array('first_name' => '', 'middle_name' => '', 'last_name' => '');

  $info['address'] = '85 Melville';
  $info1 = array();

  $info['first_name'] = 'Binyomin';
  $info['last_name'] = 'Greenes';

  $info1[] = $info;

  $info['first_name'] = 'Esther';
  $info['middle_name'] = '' ;
  $info1[] = $info;
 
 $info['first_name'] = 'Matisyahu';
 $info['middle_name'] = 'Pinchos';
  $info1[] = $info;

print_r($info);
print_r($info1);
 
//echo $info1[1][ 'last_name', 'first_name'];

 ?>
