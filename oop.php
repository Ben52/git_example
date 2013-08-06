<?php
     class cars {
           
          // public $doors;
          // public $color;
          // public $year;
          // public $name;
            
          public function  __construct($a, $b, $c, $d){
          $this->name = $a;
          $this->year = $b;
          $this->color = $c;
          $this->doors = $d;
          } 

	public function st(){
	echo	 $this->name . '<br/>' . $this->year . '<br/>' . $this->size . '<br/>' . $this->color . '<br/>' . '<br/>';
	}


     }


     $kiaOptima = new cars ('Kia Optima', 2004, 'Tan', 4);
     $fordExplorer = new cars ('Ford Explorer', 2013, 'Red', 6);
	     
	 $kiaOptima->st();
         $fordExplorer->st();

//	echo $kiaOptima->name . '<br/>';
//	echo $kiaOptima->size;
        
print_r($kiaOptima);
print_r($fordExplorer);


 ?>
