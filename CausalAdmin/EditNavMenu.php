
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
      <h1>Navigation Menu</h1>
      <br><br>

<?php 
  $user_id = $_SESSION['user_id'];

  /*Query contents of source table*/
	$sql="SELECT Display_Order
              ,Nav_Title
              ,Nav_ID
        FROM Nav
        ORDER BY Display_Order 
                ,Nav_Title";
	/*echo '<br>sql :'.$sql;*/
 
 /*Open the database connection based on config.php file settings*/
	$link = connectDB();

  if ($result = mysqli_query($link,$sql)){
      echo "<table>";
        //header
        echo "<tr>";
          echo "<th>Order</td>";
          echo "<th>Title</td>";
          echo "<th>Action</td>";
        echo "</tr>";
      
      //data  
      while ($row = mysqli_fetch_array($result))  {
        echo "<tr>";
          echo "<td><form action='EditNavMenuUpdate.php' method = 'post' onsubmit='' />
                    <input type='number' name='DispOrd'min='1' max='10' value={$row[0]}></td>";
          echo "<td><input text='text' name='NavTitle' value='{$row[1]}' maxlength='50' width='50' required/></td>";
          echo "<td> <input type='hidden' name='q' value='".$row[2]."' /><input type='Submit' value='Update'></form>";
          echo "<form action='EditNavMenuDelete.php' method = '_GET' onsubmit='' /> <input type='hidden' name='q' value='".$row[2]."' /><input type='Submit' value='Delete'></form></td>";
        echo "</tr>";
      } 
      echo "</table>";
    }
    
  /*Close database connection*/
	mysqli_close ( $link );
?>
  <div>
    <br><br>
    <h1>New Navigation Item</h1>
			<form action="EditNavMenuNew.php" method = "POST" onsubmit='' />
				<p>Navigation Title:  <input text="text" name="NavTitle" maxlength='50' width='50' required/></p>
				<p>Display Order:  <input type="number" name="DispOrd" min="1" max="10"></p>
				<input type="submit">				
			</form>
		</div>
  </body>
</html>
