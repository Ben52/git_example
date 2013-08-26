<?php 
$obj = new homepage;
class homepage{
	public $form = 
			'<body><h3>Sign in here: </h3>
			<FORM action="bankprojecttest.php" method="post">
    		   <P>
    		 <LABEL for="username">Username: </LABEL>
             <INPUT type="text" name="username" id="username"><BR>
			 <LABEL for="password">Password: </LABEL>
			 <INPUT type="password" name="password" id="password"><BR>
    		 <INPUT type="submit" value="Send"> <INPUT type="reset">
    		 </P>
		 	 </FORM>
			<h3> If you are a new user, click <a href="bankprojecttest.php?class=signup">here </a></h3></body>';
	public function __construct(){
		if($_SERVER['REQUEST_METHOD']=='GET'){
			echo $this->form;
		}else{
			print_r($_POST);
			
		}
			
  	}
	
	
}

class signup{
	public $form = 
			'<FORM action="http://mywebclass.org" method="post">
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
	public function __construct(){
		if($_SERVER['REQUEST_METHOD']=='GET'){
			echo $this->form;
		}else{
			$users = fopen("users.csv", "a");
		}
		
	}
	
	
}










?>