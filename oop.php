<?php
     class cars {
           
           public $doors;
           public $color;
           public $year;
           public $name;
            
          public function  __construct($doors, $color, $year, $name){
          $this->doors = $doors;
          $this->color = $color;
          $this->year = $year;
          $this->name = $name;
          } 
     }


     $kiaOptima = new cars (4, 'tan', 2004, 'Kia Optima');
    $fordExplorer = new cars (2, 'red', 2013, 'Ford Explorer');
    
print_r($kiaOptima);
print_r($fordExplorer);


 ?>
