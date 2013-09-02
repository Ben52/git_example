<?php 
$obj = new program();
	class program{
		public function __construct(){
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
    		   				<P>
    		 					<LABEL for="username">Username: </LABEL>
             						<INPUT type="text" name="username" id="username" required="required"><BR>
			 					<LABEL for="password">Password: </LABEL>
			 						<INPUT type="password" name="password" id="password" required="required"><BR>
    		 					<INPUT type="submit" value="Send"> <INPUT type="reset">
    		 				</P>
		 	 			</FORM>';
		public function get(){
			echo $this->form;
		}
		
		public function post(){
			$obj = new validation();
		}
	}
	
	class signup extends page{
		
		
		public 	$form = 
					 '<FORM action="forms.php?class=signup" method="post">
						<P>
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
						</P>
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
				echo "Welcome, " . $_POST['firstname'] . " " . $_POST['lastname'] . "! " . "Your account number is " . $accountNum . ".<br>" . page::$menu;
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
		echo 'Welcome, ' . $sorted_records[$username_posted]['First Name'] . '!<br><br>' . page::$menu;
		}elseif(!array_key_exists($username_posted, $sorted_records)){
			echo 'We could not find you in our records. Sign up ' . '<a href="forms.php?class=signup">here.</a>';
		}elseif($password_posted !== $sorted_records[$username_posted]['Password']){
			echo 'Username and passord don\'t match. Please try again<br><br>' . '<a href="forms.php?class=login">Login</a>';
		}	
	}
}
	
	
		
		
		
	









?>