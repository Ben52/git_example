<?php 
  $a = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
  $c[]  = $a;
  foreach($a as $b){
  echo $b . '<br>';
  }
  
 function sqr($num){
 $numsqr = $num * $num;
 echo $numsqr;
 }

$a = 9;

<<<<<<< HEAD
$num = $a;
 

 
=======
 if($a = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0)){
  echo '$a is an array';
}else{
  echo '$a is not an array';
}

print_r($c);
$result = count($a);
print_r($result);
echo $c;
>>>>>>> 6ae6c49bbfa0790bef18d1fd9a2f7dcb405cd99c


    
?>
