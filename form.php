<?php

 // echo 'Request method: ' .  $_SERVER['REQUEST_METHOD'];

session_start();

 if(!isset($_SESSION['count'])){
   $_SESSION['count'] = 0;
} else {
  $_SESSION['count']++;
}

echo $_SESSION['count'] . '<br>';

$form = ' 
<FORM action="form.php" method="post">
    <fieldset>
    <LABEL for="firstname">First name: </LABEL>
              <INPUT type="text" name="firstname" id="firstname"><BR>
    <LABEL for="lastname">Last name: </LABEL>
              <INPUT type="text" name="lastname" id="lastname"><BR>
    <LABEL for="email">email: </LABEL>
              <INPUT type="text" name="email" id="email"><BR>
    <INPUT type="radio" name="sex" value="Male"> Male<BR>
    <INPUT type="radio" name="sex" value="Female"> Female<BR>
    <INPUT type="submit" value="Send"> <INPUT type="reset">
    </fieldset>
 </FORM>';

  if($_SERVER['REQUEST_METHOD'] == 'GET'){
        echo $form;
  } else {
    echo 'thanks for your submission';

    foreach($_POST as $key => $value) {
           echo $key . ': ' . $value . '<br>';
     }
    }







?>
