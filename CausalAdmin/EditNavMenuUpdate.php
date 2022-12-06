<?php      
include('SQLFunctions.php');
include('session.php');

if ( !empty($_POST)) {
  // Store data from html form POST action into variables
  $tdID = $_POST['q'];
  $tdTitle = $_POST['NavTitle'];
  $tdOrd  = $_POST['DispOrd'];

/*Display what is in the _POST*/
	/*echo '<br>Display full contents of the _POST: <br>';
	var_dump($_POST);  */

  $link = connectDB();

  /*Prepare the SQL INSERT Statement*/
  $sql = "UPDATE Nav
          SET Nav_Title = '".$tdTitle."'
             ,Display_Order = ".$tdOrd."
          WHERE Nav_ID = ".$tdID;
  echo $sql; 
  
  /*Insert values into the database*/
  if (mysqli_query($link, $sql)) {
      /*echo "<br>Update record successfully";*/
  } else {
      echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
  }

/*Close database connection*/
mysqli_close ( $link );

/*Forward User Back to Main View*/	
header("Location: EditNavMenu.php");
}
?>
