<?php
include('SQLFunctions.php');
include('session.php');

if ( !empty($_POST)) {
  // Store data from html form POST action into variables
  $tdID = $_POST['q'];

  $link = connectDB();

  /*Prepare the SQL INSERT Statement*/
  $sql = "DELETE
          FROM Content
          WHERE Content_ID = ".$tdID.";";
  /*echo $sql; */
  
  /*Attempt Delete*/
  if (mysqli_query($link, $sql)) {
      echo "<br>Delete record successfully";
  } else {
      echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
  }


/*Close database connection*/
mysqli_close ( $link );

/*Forwared User Back to Main View*/	
header("Location: EditContentMenu.php");

}

?>
