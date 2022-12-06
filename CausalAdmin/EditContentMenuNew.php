<?php
include('SQLFunctions.php');
include('session.php');

if ( !empty($_POST)) {
  // Store data from html form POST action into variables
  $tdNavID = $_POST['NavID'];
  $tdTitle  = $_POST['Title'];
  $tdOrd = $_POST['Ord'];
  $tdContent = $_POST['Content'];

/*Display what is in the _POST*/
/*	echo '<br>Display full contents of the _POST: <br>';
	var_dump($_POST);  */

/*Open the database connection based on config.php file settings*/
	$link = connectDB();
	  
  /*Prepare the SQL INSERT Statement*/
  $sql = "INSERT INTO Content 
          (Nav_ID, ContentTitle, Content, BeginDisplay, EndDisplay, Enabled, Display_Order) 
          VALUES (".$tdNavID.",'".$tdTitle."','".$tdContent."','1900-01-01','2299-12-31',1,".$tdOrd.");";
  /*echo '<br>Sql: '.$sql;*/
  /*Insert values into the database*/
  if (mysqli_query($link, $sql)) {
      /*echo "<br>New record created successfully";*/
  } else {
      echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
  }

/*Close database connection*/
mysqli_close ( $link );

/*Forward User Back to Main View*/	
header("Location: EditContentMenu.php");
}

?>
