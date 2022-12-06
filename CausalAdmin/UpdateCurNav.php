<?php
session_start();

/*Display what is in the _POST*/
/*	echo '<br>Display full contents of the _POST: <br>';
	var_dump($_POST);  */

if ( !empty($_POST)) {
  // Store data from html form POST action into variables
  $NewNav = $_POST['NewNav'];
  $_SESSION['CurNav'] = $NewNav;
  
echo "New Nav: ".$NewNav;

/*Forward User Back to Main View*/	
header("Location: index.php");
}
