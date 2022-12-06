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
      <h1>Edit Content Menu</h1>

<?php 

  /*Prepare sql to pull everything from the contents table*/
	$sql="SELECT B.Nav_Title
	            ,A.Display_Order
	            ,A.ContentTitle
	            ,A.Content
	            ,A.Content_ID
        FROM Content A
            ,Nav B
        WHERE A.Nav_ID = B.Nav_ID            
        ORDER BY B.Nav_Title
                ,A.Display_Order 
                ,A.ContentTitle";
	/*echo '<br>sql :'.$sql;*/
 
 /*Open the database connection based on config.php file settings*/
	$link = connectDB();

  /*execute the query, display the results in a table*/
  if ($result = mysqli_query($link,$sql)){
      echo "<table>";
        //header
        echo "<tr>";
          echo "<th>Navigation Title</td>";
          echo "<th>Order</td>";
          echo "<th>Title</td>";
          echo "<th>Content</td>";
          echo "<th>Action</td>";
        echo "</tr>";
      
      //data  
      while ($row = mysqli_fetch_array($result))  {
        echo "<tr>";
          echo "<td>{$row[0]}</td>";
          echo "<td><form action='EditContentMenuUpdate.php' method = 'post' onsubmit='' /> <input type='hidden' name='q' value='".$row[4]."' />
                          <input type='number' name='Ord' min='1' max='10' value='{$row[1]}' required></td>";
          echo "<td><input type='text' name='Title' value='{$row[2]}' width='100' maxlength='100' required></td>";
          echo "<td><textarea cols='50' rows='15' name='Content' maxlength='4000' required>{$row[3]}</textarea>
                    </td>";
          echo "<td><input type='Submit' value='Update'></form>";
          echo "<form action='EditContentMenuDelete.php' method = 'POST' onsubmit='' /> <input type='hidden' name='q' value='".$row[4]."' /><input type='Submit' value='Delete'></form></td>";
        echo "</tr>";
      } 
      echo "</table>";
    }

  /*Query Nav_IDs and Titles to populate the dropdown for a new Content Item*/
	$sql="SELECT B.Nav_ID
	            ,B.Nav_Title
        FROM Nav B
        ORDER BY B.Display_Order
                ,B.Nav_Title";
/*	echo '<br>sql :'.$sql;*/
?>
  <div>
    <br><br>
    <h1>New Content Item</h1>
			<form action="EditContentMenuNew.php" method = "POST" onsubmit='' />
			  <p>Navigation:  
			  <!-- Select is an html drop down input.  We query the database to populate it with dynamic content. -->
			    <select name="NavID" required>
          <?php if ($result = mysqli_query($link,$sql)){
                  while ($row = mysqli_fetch_array($result)) {
                    echo  "<option value='{$row[0]}'>{$row[1]}</option>";
                  }
                }
          ?>
        </select></p>
				<p>Content Title:  <input text="text" name="Title" maxlength='100' width='100' required/></p>
				<p>Order:   <input type="number" name="Ord" min="1" max="10" required></p>
				<p>Content:<br> <textarea cols="120" rows="15" name="Content" maxlength='4000'  required></textarea></p>
				<input type="submit">					
			</form>
		</div>
  </body>
</html>
<?php
  /*Close database connection*/
	mysqli_close ( $link );
?>
