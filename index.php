<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        date_default_timezone_set("America/New_York");
        $obj = new program();
        
        class program{
            public function __construct() {
                session_start();
                if(isset($_REQUEST['class'])){
                    $class = $_REQUEST['class'];
                    $obj = new $class;
                }else{
                    $obj = new homepage;
                }
            }
        }
        
        class page{
            public $menu = '<a href="index.php?class=login">Login</a>
                            <br><a href="index.php?class=signup">Signup</a>';
            
            public function __construct() {
                if($_SERVER['REQUEST_METHOD'] == 'GET'){
                    $this->get();
                }else{
                    $this->post();   
                }
            }
            
            public function get(){
                echo '<a href="index.php?class=homepage">Homepage</a>';
                echo '<a href="index.php?class=login">Login</a>';
                echo '<a href="index.php?class=signup">Signup</a>';
            }
            
            public function post(){
                print_r($_POST);
            }
        }
        
        class homepage extends page {
            public function get() {
                echo '<body><h3>Welcome to the bank!</h3></body> <br>
                      <a href="index.php?class=login">Login<br></a> <br> 
                      <a href="index.php?class=signup">Signup</a>';
            }
        }
        
        class login extends page {
            public $form = '<FORM action = "index.php?class=login" method="post">
                                <fieldset>
                                    <LABEL for = "username">Username:</LABEL>
                                        <INPUT type="text" name="username" id="username" required="required"><br>
                                    <LABEL for = "password">Password:</LABEL>
                                        <INPUT type="password" name="password" id="password" required="required"><br>
                                        <INPUT type="submit" value="Send">
                                        <INPUT type="reset">
                                </fieldset>
                            </FORM>';
            
            public function get(){
                echo $this->form;
            }
            
            public function post() {
                $_SESSION['username'] = $_POST['username'];
                $obj = new validation();
            }
        }
        
        class signup extends page {
            public $form = '<FORM action = index.php?class=signup method="post">
                                <fieldset>
                                    <LABEL for = "first_name">First name:</LABEL>
                                        <INPUT type="text" name="first_name" id="first_name" required="required"><BR>
                                    <LABEL for = "last_name">Last name:</LABEL>
                                        <INPUT type="text" name="last_name" id="last_name" required="required"><BR>
                                    <LABEL for = "username">Choose a username:</LABEL>
                                        <INPUT type="text" name="username" id="username" required="required"><BR>
                                    <LABEL for = "password">Choose a password:</LABEL>
                                        <INPUT type="password" name="password" id="password" required="required"><BR>
                                    <LABEL for = "password_confirmation">Confirm your password:</LABEL>
                                        <INPUT type="password" name="password_confirmation" id="password_confirmation" required="required"><BR>
                                        <INPUT type="submit" value="Send">
                                        <INPUT type="reset">
                                </fieldset>
                            </FORM>';
            public function get(){
                echo $this->form;
            }
            
            public function post() {
                $this->passwdconf();
                $handle = fopen('users.csv', 'a+');
                $record = fgetcsv($handle, 0, ',');
                if($record[0]!="First Name" && $record[1]!="Last Name" && $record[2]!="Username" && $record[3]!="Password" && $record[4]!="Account Number"){
                    fputcsv($handle, array('First Name', 'Last Name', 'Username', 'Password', 'Account Number'));    
                }
                fclose($handle);
                /*$row = 1;
                if(($handle=  fopen('users.csv', 'r'))!=FALSE){
                    while(($record =  fgetcsv($handle, 0, ','))!=FALSE){
                        if($row==1){
                            $keys = $record;
                            $row++;
                        }else{
                            $records[] =  array_combine($keys, $record);
                        }
                    }
                }
                fclose($handle);*/
                
                $account_num = mt_rand(1111111, 9999999);
                $user_info = array();
                $user_info[] = $_POST['first_name'];
                $user_info[] = $_POST['last_name'];
                $user_info[] = $_POST['username'];
                $user_info[] = $_POST['password'];
                $user_info[] = $account_num;
                $handle = fopen('users.csv', 'a+');
                fputcsv($handle, $user_info);
                echo 'Welcome, ' . $_POST['first_name'] . '. Your account number is ' . $account_num . '.<br><br>';
                echo '<a href="index.php?class=transaction">Enter transactions</a><br><a href="index.php?class=signout">Signout</a>';
                fclose($handle);
                
                
                
            }
            function passwdconf(){
                if($_POST['password']!==$_POST['password_confirmation']){
                    echo 'Passwords don\'t match! <br> <a href="index.php?class=signup">Go back to signup</a>' ;
                    die();
                    
                }
            }
        }
        
        class validation{
            public function __construct() {
                $row = 1;
                if(($handle=fopen('users.csv', 'r'))!=FALSE){
                    while (($record = fgetcsv($handle, 0, ','))!=FALSE){
                        if($row==1){
                            $keys = $record;
                            $row++;
                        }else{
                            $records[] = array_combine($keys, $record);
                        }
                    }
                function makePrimaryKey($key_name, $records){
                    foreach ($records as $record) {
                        $index_name = $record[$key_name];
                        unset($record[$key_name]);
                        $new_records[$index_name] = $record; 
                    }
                    return($new_records);
                }
                $sorted_records = makePrimaryKey('Username', $records);
                fclose($handle);
                print_r($sorted_records);
                }
                
                $username_posted = $_POST['username'];
                $password_posted = $_POST['password'];
                if(array_key_exists($username_posted, $sorted_records) && $password_posted==$sorted_records[$username_posted]['Password']){
                    echo 'Welcome, ' . $sorted_records[$username_posted]['First Name'] . '!<BR><BR><a href="index.php?class=transaction">Enter transactions</a><BR><BR><a href="index.php?class=signout">Signout</a>';
                }elseif (!array_key_exists($username_posted, $sorted_records)) {
                    echo 'We could not find you in our records. Please sign up <a href="index.php?class=signup">here</a>'; 
                }elseif($password_posted !== $sorted_records[$username_posted]['Password']){
                    echo 'Username and password don\'t match. Please try again<BR><BR> <a href="index.php?class=login">Login</a>';
                }
            }
        
        }
        
        class transaction{
            public $old_bal;
            public $new_bal;
            public $form= '<FORM action="index.php?class=transaction" method="post">
                                <fieldset>
                                    <LABEL for="amount">Amount:</LABEL>
                                        <INPUT type="number" name="amount" id="amount"><BR>
                                    <LABEL for="source">Source:</LABEL>
                                        <INPUT type="text" name="source" id="source"><BR>
                                        <INPUT type="radio" name="type" value="debit">Debit<BR>
                                        <INPUT type="radio" name="type" value="credit">Credit<BR>
                                        <INPUT type="submit" vaule="Send"><INPUT type="reset">
                                </fieldset>
                            </FORM>';
            public function __construct() {
                if($_SERVER['REQUEST_METHOD']=='GET'){
                    $this->get();
                }else{
                    $this->post();
                }
            }
            public function get(){
                echo $this->form . '<BR><BR><a href="index.php?class=signout">Signout</a>';
            }
            public function post(){
                if($_POST['type']=='debit'){
                    echo $this->form . '<BR><BR>You have spent $' . $_POST['amount'] . ' at ' . $_POST['source'] .'.<BR<BR>';
                }else{
                    echo $this->form . '<BR><BR>You have been credited $' . $_POST['amount'] . ' from ' . $_POST['source'] . '.';
                }
                $obj  = new calculation;
                echo '<BR><BR><a href="index.php?class=signout">Signout</a>';
            }
        }
        
        class calculation{
            public function __construct() {
                /*if(($handle=fopen($_SESSION['username'] . '.csv', 'a+'))!=FALSE){
                    while(($record=fgetcsv($handle, 0, ','))!=FALSE){
                        $data[]=$record;
                        print_r($data);
                    }
                    fclose($handle);
                }*/
             $this->transaction_data();
            }
            public function set_old_bal($old_bal){
                
            }


            public function transaction_data(){
                $data = array($this->old_bal, $this->new_bal, $_POST['amount'], $_POST['source'], $_POST['type'], date('m-d-Y \a\t g:i:s a'));
                print_r($data);
                $handle = fopen($_SESSION['username'] . '.csv', 'a+');
                fputcsv($handle, $data);
            }
            
            
        }
        
        class signout{
            public function __construct() {
                session_destroy();
                header("location:index.php");
            }
        }
        ?>
    </body>
</html>
