<?php
include('SQLFunctions.php');
include('session.php');

if ( !empty($_GET)) {
  // Store data from html form POST action into variables
  $tdID = $_GET['q'];

  $link = connectDB();

  /*Prepare the SQL INSERT Statement*/
  $sql = "DELETE
          FROM Nav
          WHERE Nav_ID = ".$tdID.";";
  /*echo $sql; */
  
  /*Attempt Delete*/
  if (mysqli_query($link, $sql)) {
      echo "<br>Delete record successfully";
  } else {
      echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
  }

/*Close database connection*/
mysqli_close ( $link );

/*Forward User Back to Main View*/	
header("Location: EditNavMenu.php");

}
?>
