<?php
	//program to calculate debits and credits in an account

  $obj = new account(1000);

  $obj->debit(100);
  $obj->credit(200);
  $obj->debit(500);
  print_r($obj);

  class account{
    
    public $starting_balance;
    public $current_balance;
  
    
    
    public function __construct($amount){
      $this->starting_balance = $amount;
      $this->current_balance = $amount;
    }    

    public function debit($amount){
      $this->current_balance = $this->current_balance - $amount;
    }

    public function credit($amount){
      $this->current_balance = $this->current_balance + $amount;
    }



  }


  








 ?>
