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
		public function __construct(){
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				$this->get();
			}else{
				$this->post();
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
				 <a href="forms.php?class=login">Login</a> <br> 
					<a href="forms.php?class=signup">Signup</a>';
			
		}
	}
	
	class login extends page{
		public function get(){
			echo $this->form;
		}
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
		public function post(){
			echo 'Thank you for logging in, ' . "$_POST[username]" . "." . ' Have a wonderful day!<br><br><br>';
			echo '<a href="forms.php">Click here to retun to the Homepage</a>';
		}
	}
	
	class signup extends page{
		public function get(){
			echo $this->form;
		}

		public $form = '<FORM action="forms.php?class=signup" method="post">
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
		
		public function post(){
			if($_POST['password'] == $_POST['passwordconfirmation']){
				$userinfo = array();
				$userinfo[]=$_POST['firstname'];
				$userinfo[]=$_POST['lastname'];
				$userinfo[]=$_POST['username'];
				$userinfo[]=$_POST['password'];
			$handle = fopen('users.csv', 'a+');
			fputcsv($handle, $userinfo);
			echo "Welcome, " . $_POST['firstname'] . " " . $_POST['lastname'] . "!";
			}else{
				//header('Location: ./forms.php?class=signup');
				echo 'Sorry, your passwords don\'t match!' . $this->form;
			}
			
		
		}
	}









?>