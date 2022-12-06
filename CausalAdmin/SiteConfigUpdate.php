<?php      
include('SQLFunctions.php');
include('session.php');

if ( !empty($_POST)) {
  // Store data from html form POST action into variables
  $tdID = $_POST['q'];
  $tdNewTextValue = $_POST['newTextValue'];

/*Display what is in the _POST*/
/*	echo '<br>Display full contents of the _POST: <br>';
	var_dump($_POST);  */

  $link = connectDB();

  /*Prepare the SQL Statement*/
  $sql = "UPDATE SiteConfig
          SET ShortTextValue = '".$tdNewTextValue."'
          WHERE SiteConfig_ID = ".$tdID.";";
/*  echo '<br><br>'.$sql; */
  
  /*Insert values into the database*/
  if (mysqli_query($link, $sql)) {
      echo "<br>Update record successfully";
  } else {
      echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
  }

/*Close database connection*/
mysqli_close ( $link );

/*Forward User Back to Main View*/	
header("Location: SiteConfigMenu.php");

}

?>
