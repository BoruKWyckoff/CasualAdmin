<?php
require_once('SQLFunctions.php');
session_start();

/*if there is no Currnet Navigation set, default to the first on on the list based on order*/
if(!isset($_SESSION['CurNav']))
{ 	echo "CurNav Not Set <br>";/*this is a testing comment*/
    $sql="SELECT Nav_ID
                ,Display_Order 
                ,Nav_Title
          FROM Nav
          ORDER BY Display_Order 
                ,Nav_Title
          LIMIT 1";
    $link = connectDB();
    /*run query, assign the session variable*/
     if ($result = mysqli_query($link,$sql)){
      while ($row = mysqli_fetch_array($result))  {
          $_SESSION['CurNav'] = $row[0];
      } 
    }
    mysqli_close ( $link );
}
/*Set $CurNav variable to the value of the CurNav session variable*/
$CurNav = $_SESSION['CurNav'];


/*Simlar to CRUD, logging out the users that haven't been active in the last 10 mins*/
if(isset($_SESSION['user_id']))
{
    if ($_SESSION['timeout'] + 10 * 60 < time()) {
      /* session timed out */
      header("Location: Logout.php"); 
    } else {
      $_SESSION['timeout'] = time();
      /*For convinience, adding a button to get back to the AdminInxed.php page*/
      echo  "<a href='AdminIndex.php'><button>Admin Menu</button></a>";
    }
}
?>

<!-- The following CSS aligns the Navigation buttons to display side by side, in the 
     middle of the screen with similar color, and font as the original navigation -->
<style type="text/css">
.NavMenu div {
  float:left;
}
.NavMenu {
  float: right;
  position: relative;
  left: 00%; 
}
.NavMenu > .child {
  position: relative;
  left: 50%;
}

input[type=submit] {
  text-transform: uppercase;
  font-weight: 400;
  letter-spacing: 3px;
  margin:5px;
  margin-top: 20px;
  color: white;
}
</style>


<html lang="en">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $siteTitle; ?></title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <header>
            <h1 class="site-heading text-center text-faded d-none d-lg-block">
                <span class="site-heading-upper text-primary mb-3">A Free Bootstrap Business Theme</span>
                <span class="site-heading-lower"><?php echo $siteBrand; ?></span>
                <br>
                                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <div>
                    <a class="navbar-brand" href="index.php"><?php echo $siteShortTitle; ?></a><br>
                </div>
                <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
                <?php 
                      /*Query Navigation*/
                    	$sql="SELECT Nav_Title
                    	            ,Nav_ID
                            FROM Nav
                            ORDER BY Display_Order 
                                    ,Nav_Title";
                    	/*echo '<br>sql :'.$sql;*/
                     	$link = connectDB();
                    /*Pull in our custom CSS using div class*/ 	
                    echo "<div class='NavMenu'>";
                      echo "<div class='child'>";
                      if ($result = mysqli_query($link,$sql)){
                          /*Each row returned will get it's own div with a form contained in it.  
                            They will act as dynamic buttons sending the user to UpdateCurNav.php*/
                          while ($row = mysqli_fetch_array($result))  {
                            echo "<div>
                                    <form action='UpdateCurNav.php' method='post'>
                                      <input type='submit' class='btn' name='submit' value='{$row[0]}'>
                                      <input type='hidden' name='NewNav' value='{$row[1]}'>
                                    </form>
                                  </div>";
                          } 
                        }
                      echo "</div>" ;   
                    echo "</div>" ;   
                      /*Close database connection*/
                    	mysqli_close ( $link );
                ?>
                </nav>

            </h1>
        </header>
        <!-- Navigation-->
        <!--<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">-->
            <!--<div class="container">-->
            <!--    <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">Start Bootstrap</a>-->
            <!--    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>-->
            <!--    <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
            <!--        <ul class="navbar-nav mx-auto">-->
            <!--            <li class="nav-item px-lg-4"><a class="nav-link tzext-uppercase" href="index.html">Home</a></li>-->
            <!--            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="about.html">About</a></li>-->
            <!--            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="products.html">Products</a></li>-->
            <!--            <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="store.html">Store</a></li>-->
            <!--        </ul>-->
            <!--    </div>-->
            <!--</div>-->
        <!--</nav>-->
        <!--<section class="page-section clearfix">-->
        <!--    <div class="container">-->
        <!--        <div class="intro">-->
        <!--            <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="assets/img/intro.jpg" alt="..." />-->
        <!--            <div class="intro-text left-0 text-center bg-faded p-5 rounded">-->
        <!--                <h2 class="section-heading mb-4">-->
        <!--                    <span class="section-heading-upper">Fresh Coffee</span>-->
        <!--                    <span class="section-heading-lower">Worth Drinking</span>-->
        <!--                </h2>-->
        <!--                <p class="mb-3">Every cup of our quality artisan coffee starts with locally sourced, hand picked ingredients. Once you try it, our coffee will be a blissful addition to your everyday morning routine - we guarantee it!</p>-->
        <!--                <div class="intro-button mx-auto"><a class="btn btn-primary btn-xl" href="#!">Visit Us Today!</a></div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!--<section class="page-section cta">-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
        <!--            <div class="col-xl-9 mx-auto">-->
        <!--                <div class="cta-inner bg-faded text-center rounded">-->
        <!--                    <h2 class="section-heading mb-4">-->
        <!--                        <span class="section-heading-upper">Our Promise</span>-->
        <!--                        <span class="section-heading-lower">To You</span>-->
        <!--                    </h2>-->
        <!--                    <p class="mb-0">When you walk into our shop to start your day, we are dedicated to providing you with friendly service, a welcoming atmosphere, and above all else, excellent products made with the highest quality ingredients. If you are not satisfied, please let us know and we will do whatever we can to make things right!</p>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <div>
            <?php 
    /*Query Content for the Current Navigation*/
	$sql="SELECT ContentTitle
	            ,Content
          FROM Content
          WHERE Nav_ID = ".$CurNav."
          ORDER BY Display_Order";
   /*echo '<br>sql :'.$sql;*/
 
 	$link = connectDB();

  /*Execute the query, for each row returned, display a box with the results of the content in it.*/
  if ($result = mysqli_query($link,$sql)){
      while ($row = mysqli_fetch_array($result))  {
          echo "<div class='row'>";
          echo "  <div class='box'>";
          echo "    <div class='col-lg-12'>";
          echo "      <hr><h2 class='intro-text text-center'><strong>{$row[0]}</strong></h2><hr>";
          echo "<p>{$row[1]}</p>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
      } 
    }
    
  /*Close database connection*/
	mysqli_close ( $link );
?>  

        </div>
        
        
        <footer class="footer text-faded text-center py-5">
            <div class="container">
                <p class="m-0 small"><?php echo $siteFooter; ?></p>
                <p class="m-0 small"><?php echo $siteAddress; ?></p>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
