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
			echo 'Welcome to the bank <br> <a href="forms.php?class=login">Login</a> <br> <a href="forms.php?class=signup">Signup</a>';
			
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
             						<INPUT type="text" name="username" id="username"><BR>
			 					<LABEL for="password">Password: </LABEL>
			 						<INPUT type="password" name="password" id="password"><BR>
    		 					<INPUT type="submit" value="Send"> <INPUT type="reset">
    		 				</P>
		 	 			</FORM>';
	}
	
	class signup extends page{
		public function get(){
			echo $this->form;
		}
		public $form = '<FORM action="forms.php?class=signup" method="post">
				<P>
					<LABEL for="firstname">First name: </LABEL>
					<INPUT type="text" name="firstname" id="firstname"><BR>
					<LABEL for="lastname">Last name: </LABEL>
					<INPUT type="text" name="lastname" id="lastname"><BR>
					<LABEL for="email">email: </LABEL>
					<INPUT type="text" name="email" id="email"><BR>
					<INPUT type="submit" value="Send"> <INPUT type="reset">
				</P>
			</FORM>';
	}









?>