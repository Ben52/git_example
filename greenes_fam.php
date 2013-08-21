<?php
$page = 0;
$handle = fopen("Greenes_Fam.csv", "r");

while(($data = fgetcsv($handle, 0, ",")) !== FALSE){
  if($page == 0){
   $field_names = $data;
   $page = $page + 1;
  }else{
    $data = array_combine($field_names, $data);
    $records[] = $data;
  }


}

print_r($records);



 ?>
