<?php
include('SQLFunctions.php');
include('session.php');

/*Display what is in the _POST*/
/*echo '<br>Display full contents of the _POST: <br>';
	var_dump($_POST);  */

if ( !empty($_POST)) {
  // Store data from html form POST action into variables
  $tdConfigName = $_POST['ConfigName'];
  $tdShortTextValue = $_POST['ShortTextValue'];

/*Open the database connection based on config.php file settings*/
	$link = connectDB();
	  
  /*Prepare the SQL INSERT Statement*/
  $sql = "INSERT INTO SiteConfig (ConfigName, BEGDT, ENDDT, ShortTextValue ) 
          VALUES ('".$tdConfigName."', '1900-01-01','2299-12-31','".$tdShortTextValue."');";
  echo "<br>".$sql;          
  /*Insert values into the database*/
  if (mysqli_query($link, $sql)) {
  /*    echo "<br>New record created successfully";*/
  } else {
      echo  "<br>Error: " . $sql . "<br>" . mysqli_error($link);
  }

/*Close database connection*/
mysqli_close ( $link );

/*Forward User Back to Main View*/	
header("Location: SiteConfigMenu.php");
}

?>
