<?php 
$obj = new program();
	class program{
		public function __construct(){
			session_start();
			if(isset($_REQUEST['class'])){
				$class = $_REQUEST['class'];
				$obj = new $class();
			}else{
				$obj = new homepage();
			}
		}
	}
	
	class page{
		public static $menu = '<a href="forms.php?class=login">Login<br></a> <br> 
					<a href="forms.php?class=signup">Signup</a>';
		public function __construct(){
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				$this->get();
			}else{
				try {
				     $this->post();
				} catch (Exception $e) {
					print_r($e);
					echo 'Caught exception: ' . $e->getMessage() . "<br>" . "\n";
					 
					
				} 
				
			}
		}
		public function get(){
			echo '<a href="forms.php?class=homepage">Homepage</a>';
			echo '<a href="forms.php?class=login">Login</a>';
			echo '<a href="forms.php?class=signup">Signup</a>';
		}
		public function post(){
			print_r($_POST);
		}
	}
	
	class homepage extends page{
		public function get(){
			echo '<body><h3>Welcome to the bank!</h3></body> <br>
				 <a href="forms.php?class=login">Login<br></a> <br> 
					<a href="forms.php?class=signup">Signup</a>';
			
		}
	}
	
	class login extends page{

		public $form =
		 				'<FORM action="forms.php?class=login" method="post">
    		   				<fieldset>
    		 					<LABEL for="username">Username: </LABEL>
             						<INPUT type="text" name="username" id="username" required="required"><BR>
			 					<LABEL for="password">Password: </LABEL>
			 						<INPUT type="password" name="password" id="password" required="required"><BR>
    		 					<INPUT type="submit" value="Send"> <INPUT type="reset">
    		 				</fieldset>
		 	 			</FORM>';
		public function get(){
			echo $this->form;
		}
		
		public function post(){
			$_SESSION['username'] = $_POST['username'];
			$obj = new validation();
		}
	}
	
	class signup extends page{
		
		
		public 	$form = 
					 '<FORM action="forms.php?class=signup" method="post">
						<fieldset>
							<LABEL for="firstname">First name: </LABEL>
								<INPUT type="text" name="firstname" id="firstname" required="required"><BR>
							<LABEL for="lastname">Last name: </LABEL>
								<INPUT type="text" name="lastname" id="lastname" required="required"><BR>
							<LABEL for="username">Choose a username: </LABEL>
								<INPUT type="text" name="username" id="username" required="required"><BR>
							<LABEL for="password">Choose a password: </LABEL>
								<INPUT type="password" name="password" id="password" required="required"><BR>
							<LABEL for="passwordconfirmation">Confirm your password: </LABEL> 
								<INPUT type="password" name="passwordconfirmation" id="passwordconfirmation" required="required"><BR>
							<INPUT type="submit" value="Send"> <INPUT type="reset">
						</fieldset>
						</FORM>';
		public function get(){
			echo $this->form;
		}
			

		public function post(){
			$handle = fopen('users.csv', 'r+');
			$record = fgetcsv($handle, 0, ',');
			if($record[0]!=="First Name" && $record[1]!=="Last Name" && $record[2]!=="Username" && $record[3]!= "Password" && $record[4] !== "Account Number"){
				fputcsv($handle, array('First Name', 'Last Name', 'Username', 'Password', 'Account Number'));
				print_r($record);
				fclose($handle);
			}
			if($_POST['password'] !== $_POST['passwordconfirmation']){
				throw new Exception('Passwords don\'t match');
			}
			$row=1;
			if(($handle = fopen('users.csv', 'r'))!==FALSE){
				while(($record = fgetcsv($handle, 0, ','))!==FALSE){
					if($row==1){
						$keys=$record;
						$row++;
					}else{
						$records[] = array_combine($keys, $record);
					}
				}
				function makePrimaryKey($key_name, $records){
					foreach($records as $record){
						$index_name = $record[$key_name];
						unset($record[$key_name]);
						$new_records[$index_name] = $record;
					}
					return($new_records);
				}
				$sorted_records = makePrimaryKey('Username', $records);
				fclose($handle);	
			}
			if(array_key_exists($_POST['username'], $sorted_records)){
				echo "Sorry, that Username is already taken!<br>" . page::$menu;
			}else{
				$accountNum = rand(1000000000, 9999999999);
				$userinfo = array();
				$userinfo[]=$_POST['firstname'];
				$userinfo[]=$_POST['lastname'];
				$userinfo[]=$_POST['username'];
				$userinfo[]=$_POST['password'];
				$userinfo[]=$accountNum;
				$handle = fopen('users.csv', 'a+');
				fputcsv($handle, $userinfo);
				echo "Welcome, " . $_POST['firstname'] . " " . $_POST['lastname'] . "! " . "Your account number is " . $accountNum . ".<br>"; 
				echo '<br><br> <a href="forms.php?class=transaction">Enter Transactions</a>';
				echo '<br><br> <a href="forms.php?class=signout">Signout</a>';
				fclose($handle);
			} 
						    
						
		}
	}
	
	
class validation{
	public function __construct(){
		$row=1;
		if(($handle = fopen('users.csv', 'r'))!==FALSE){
			while(($record = fgetcsv($handle, 0, ','))!==FALSE){
				if($row==1){
					$keys=$record;
					$row++;
				}else{
					$records[] = array_combine($keys, $record);
				}
			}
			function makePrimaryKey($key_name, $records){
				foreach($records as $record){
					$index_name = $record[$key_name];
					unset($record[$key_name]);
					$new_records[$index_name] = $record;
				}
				return($new_records);
			}
			$sorted_records = makePrimaryKey('Username', $records);
			fclose($handle);
		}
	$username_posted = $_POST['username'];
	$password_posted = $_POST['password'];
	if(array_key_exists($username_posted, $sorted_records) && $password_posted == $sorted_records[$username_posted]['Password']){
		echo 'Welcome, ' . $sorted_records[$username_posted]['First Name'] . '!' . '<br><br><a href="forms.php?class=transaction">Enter transactions</a>';
		echo '<br><br> <a href="forms.php?class=signout">Signout</a>';
		
		}elseif(!array_key_exists($username_posted, $sorted_records)){
			echo 'We could not find you in our records. Sign up ' . '<a href="forms.php?class=signup">here.</a>';
		}elseif($password_posted !== $sorted_records[$username_posted]['Password']){
			echo 'Username and passord don\'t match. Please try again<br><br>' . '<a href="forms.php?class=login">Login</a>';
		}	
	}
}

class transaction {
	public  $form = '<br>
              <FORM action="forms.php?class=transaction" method="post">
                <fieldset>
                  <LABEL for="amount">Amount: </LABEL>
                    <INPUT type="text" name="amount" id="amount"><BR>
                  <LABEL for="source">Source: </LABEL>
                    <INPUT type="text" name="source" id="source"><BR>
                    <INPUT type="radio" name="type" value="debit"> Debit<BR>
                    <INPUT type="radio" name="type" value="credit"> Credit<BR>
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
		echo '<br><br> <a href="forms.php?class=signout">Signout</a>';
	}
	public function post(){
		if($_POST['type']=='debit'){
			echo  $this->form . '<br><br>You have spent $' . $_POST['amount'] . ' at ' . $_POST['source'] . ".<br><br>";
		}else{
			echo  $this->form . '<br><br>You have credited $' . $_POST['amount'] . ' to your account from ' . $_POST['source'] . '.<br><br>';
		}
		$obj = new calculation();
		echo '<br><br> <a href="forms.php?class=signout">Signout</a>';
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
		$handle = fopen($_SESSION['username'] . '.csv', 'a+');
		$data = array();
		$data['amount'] = $_POST['amount'];
		$data['source'] = $_POST['source'];
		$data['type'] = $_POST['type'];
		$data['balance'] = $new_bal;
		$data['time'] = date('m-d-Y \a\t g:i:s a');
		fputcsv($handle, $data);
		$transaction = fgetcsv($handle, 0, ',');
		//print_r($transaction);
		fclose($handle);
		//print_r($data);
			
	}
	public function credit(){
		$this->new_bal = $this->old_bal + $_POST['amount'];
	}
	public function debit(){
		$this->new_bal = $this->old_bal - $_POST['amount'];
	}
	public function message(){
		echo 'Your previous balance was $' . $this->old_bal . '. Your new balance is $' . $this->new_bal . '.';
	}
	public function set_old_balance(){
		if(($handle = fopen($_SESSION['username'] . '.csv', 'a+'))!==FALSE){
			while(($record = fgetcsv($handle, 0, ','))!==FALSE){
				$data[] = $record;
			}
			fclose($handle);
		}
		if(isset($data)){
			$array_length = count($data);
			$this->old_bal = $data[$array_length - 1][3];
			//print_r($data);
		}else{
			$this->old_bal = 0;
		}
	}

}
	class signout{
		public function __construct(){
			session_destroy();
			header('Location: forms.php');
			
		}
	}
	
		
		
		
	









?>