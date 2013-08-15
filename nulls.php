<?php
class car{

  public $make = 'kia';
  public $model = 'optima';

  public function __construct($make = NULL, $model = NULL){
   
  if($make != NULL){
    $this->make = $make;
  }

  if($model != NULL){
    $this->model = $model;
  }


}


}

class vehicle extends car{

}
$obj1 = new car('chrysler', 't&c');
$obj = new vehicle('ford', 'explorer');

print_r($obj);
print_r($obj1);



 ?>
