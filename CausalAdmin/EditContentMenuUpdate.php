<?php      
include('SQLFunctions.php');
include('session.php');

if ( !empty($_POST)) {
  // Store data from html form POST action into variables
  $tdID = $_POST['q'];
  $tdOrd = $_POST['Ord'];
  $tdTitle = $_POST['Title'];
  $tdContent = $_POST['Content'];

/*Display what is in the _POST*/
/*	echo '<br>Display full contents of the _POST: <br>';
	var_dump($_POST);  */

  $link = connectDB();

  /*Prepare the SQL INSERT Statement*/
  $sql = "UPDATE Content
          SET Display_order = ".$tdOrd."
             ,ContentTitle  = '".$tdTitle."'
             ,Content       = '".$tdContent."'
          WHERE Content_ID = ".$tdID;
/*  echo '<br><br>'.$sql; */
  
  /*Insert values into the database*/
  if (mysqli_query($link, $sql)) {
      echo "<br>Update record successfully";
  } else {
      echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
  }

/*Close database connection*/
mysqli_close ( $link );

/*Forwarded User Back to Main View*/	
header("Location: EditContentMenu.php");

}
?>
