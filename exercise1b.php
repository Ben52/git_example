<?php
	//program to calculate debits and credits in an account

  $obj = new account(1000);



  $obj->debit(100, 'Walmart');
  $obj->credit(200, 'cash deposit');
  $obj->debit(500, 'Target');
  $obj->debit(100, 'Sears');
  $obj->credit(600, 'refund');
  $obj->debit(1200, 'Kmart');


 // $transactions = $obj->debit(100);
  print_r($obj);

  class account{
    
    public $starting_balance;
    public $current_balance;
     
    private $transactions = array(); 
    
    public function __construct($amount){
      $this->starting_balance = $amount;
      $this->current_balance = $amount;
    }    

    public function debit($amount, $source){
      $transaction = array();
      $transaction['type'] = 'debit';
      $transaction['amount'] = $amount;
      $transaction['source'] = $source;
      $this->transactions[] = $transaction; 
      $this->current_balance = $this->current_balance - $amount;
       // $this->transactions[]['debit'] = $amount;
	   //$this->transactions[]['source'] = $source;
    }

    public function credit($amount, $source){
          $transaction = array();
          $transaction['type'] = 'credit';
          $transaction['amount'] = $amount;
          $transaction['source'] = $source;
          $this->transactions[] = $transaction;
        $this->current_balance = $this->current_balance + $amount;
       // $this->transactions[]['credit'] = $amount;
	   //$this->transactions[]['source'] = $source;
    }

   public function process(){
    foreach($this->transactions as $transaction);{
      
      print_r($transaction);
    }
      
    
   }



  }


  








 ?>
