<?php 
$obj = new transaction();
class transaction {
	public $form = '<br>
              <FORM action="transactions.php?class=transactions" method="post">
                <fieldset>
                  <LABEL for="amount">Amount: </LABEL>
                    <INPUT type="number" name="amount" id="amount"><BR>
                  <LABEL for="source">Source: </LABEL>
                    <INPUT type="text" name="source" id="source"><BR>
                    <INPUT type="radio" name="type" value="debit"> Debit<BR>
                    <INPUT type="radio" name="type" value="credit"> Credit<BR>
                    <INPUT type="checkbox" name="moretranstype" value="yes"> More Trans<BR>
                    <INPUT type="submit" value="Send"> <INPUT type="reset">
                </fieldset>
              </FORM>';
	public function __construct(){
		if($_SERVER['REQUEST_METHOD']=='GET'){
			$this->get();
		}else{
			$this->post();
		}
	}
	public function get(){
		echo $this->form;
	}
	public function post(){
		if($_POST['type']=='debit'){
			echo 'You have spent $' . $_POST['amount'] . ' at ' . $_POST['source'] . ".<br><br>" . $this->form; 
		}else{
			echo 'You have credited $' . $_POST['amount'] . ' to your account from ' . $_POST['source'] . '.<br><br>' . $this->form; 
		}
		$obj = new calculation();
	}
	
}


	class calculation{
		public $old_bal;
		public $new_bal;
		public function __construct($old_bal = null, $new_bal = null){
			$this->set_old_balance();
			if($_POST['type'] == 'credit'){
				$this->credit();
			}elseif($_POST['type'] == 'debit'){
				$this->debit();
			}
			$this->message();
			$old_bal = $this->old_bal;
			$new_bal = $this->new_bal;
			$handle = fopen('transactions1.csv', 'a+');
			$data = array();
			$data['amount'] = $_POST['amount'];
			$data['source'] = $_POST['source'];
			$data['type'] = $_POST['type'];
			$data['balance'] = $new_bal;
			fputcsv($handle, $data);
			$transaction = fgetcsv($handle, 0, ',');
			print_r($transaction);
			fclose($handle);
			print_r($data);
			
		}
		public function credit(){
				$this->new_bal = $this->old_bal + $_POST['amount'];
		}
		public function debit(){
			$this->new_bal = $this->old_bal - $_POST['amount'];
		}
		public function message(){
			echo 'Your old balance was ' . $this->old_bal . '. Your new balance is ' . $this->new_bal . '.'; 
		}
		public function set_old_balance(){
			if(($handle = fopen('transactions1.csv', 'a+'))!==FALSE){
				while(($record = fgetcsv($handle, 0, ','))!==FALSE){
					$data[] = $record;
				}
				fclose($handle);
			}
			if(isset($data)){
			$array_length = count($data);
			$this->old_bal = $data[$array_length - 1][3];
			print_r($data);
			}else{
				$this->old_bal = 0;
			}
			}
		
	}


















?>