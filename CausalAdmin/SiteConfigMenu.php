<?php
  include('SQLFunctions.php');
  include('session.php');
?>

<html>
<style>
  table, th, td { border: 1px solid black;
                  border-collapse: collapse; }
  table th { background-color: black;
             color: white; }    
  table tr:nth-child(even) { background-color: #eee; }
  table tr:nth-child(odd)  { background-color: #fff; }
</style>  
  <body>
      <h1>Site Config Menu</h1>

<?php 
  /*Prep query to pull SiteConfig contents*/
	$sql="SELECT A.SiteConfig_ID
	            ,A.ConfigName
              ,A.ShortTextValue
        FROM SiteConfig A
        ORDER BY A.ConfigName";

	$link = connectDB();

  /*Execute query.  Display the results just like CRUD*/
  if ($result = mysqli_query($link,$sql)){
      echo "<table>";
        //header
        echo "<tr>";
          echo "<th>Config Name</td>";
          echo "<th>Config Value</td>";
          echo "<th>Action</td>";
        echo "</tr>";
      
      //data  
      while ($row = mysqli_fetch_array($result))  {
        echo "<tr>";
          echo "<td>{$row[1]}</td>";
          /*Here we are combining the Read and Update.  The following line both displays teh current value, and allows us to update
          it and POST to SiteConfigUpdate.php which will commit the updates to the database.*/
          echo "<td><form action='SiteConfigUpdate.php' method = 'POST' onsubmit='' /> <input type='text' maxlength='100' name='newTextValue' value='".$row[2]."' size='100' required/></td>";
          echo "<td><input type='hidden' name='q' value='".$row[0]."' /><input type='Submit' value='Update'></form></td>";
        echo "</tr>";
      } 
      echo "</table>";
    }
    
  /*Close database connection*/
	mysqli_close ( $link );
?>
<!--To Simplify navigation on the site, we can add the Create form here at the bottom as well -->
<div>
  <br><br>
		<h1>New Config Item</h1>
			<form action="SiteConfigNew.php" method = "POST" onsubmit='return validateForm()' />
				<p>Config Name:  <input text="text" name="ConfigName" maxlength='50' size="50"  required/></p>
				<p>Short Text:  <input type="text" name="ShortTextValue" maxlength="100" size="100" required></p>
				<input type="submit">				
			</form>
		</div>

  </body>
</html>
