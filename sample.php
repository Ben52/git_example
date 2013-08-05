<?php
      Class Foods{
            Public $edible = yes;
            Public $type;
            Public $color;
            Public $taste;
            
            Public function __construct($type, $color, $taste){
                    $this->type = $type;
                    $this->color = $color;
                    $this->taste = $taste;
                    }


}

$apple = new Foods;

            



 ?>
