<?php
     class cars {
           
           public $size;
           public $color;
           public $year;
           public $name;
            
          public function  __construct($a, $b, $c, $d){
          $this->size = $a;
          $this->color = $b;
          $this->year = $c;
          $this->name = $d;
          } 

	public function st(){
	echo	 $this->name . '<br/>' . $this->year . '<br/>' . $this->size . '<br/>' . $this->color . '<br/>' . '<br/>';
	}


     }


     $kiaOptima = new cars (4, 'tan', 2004, 'Kia Optima');
     $fordExplorer = new cars (2, 'red', 2013, 'Ford Explorer');
	     
	 $kiaOptima->st();
         $fordExplorer->st();

//	echo $kiaOptima->name . '<br/>';
//	echo $kiaOptima->size;
        
//print_r($kiaOptima);
//print_r($fordExplorer);


 ?>
