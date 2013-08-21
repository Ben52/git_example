<?php 
     class person{

  private $name;
  public $age;
  public $height;
  public $weight;
  public $location;
  public $gender;
  public $relatives;

  public function __construct(){
    return 'This is a random test of OOP';
    
  }
  public function setName($name){
    $this->name = $name;
 
  }
  public function getName(){
    return $this->name;
  }


}

$obj = new person;
$obj->setName('Binyomin');
echo $obj->getName();
echo $obj->__CONSTRUCT();
print_r($obj);


?>
