<?php
/* Configuration Settings */
define('DB_HOST', 'localhost'); /* Database Server */
define('DB_NAME', 'WEBADMIN'); /* Database Name */
define('DB_USER', 'root'); /* Database Username */
define('DB_PWD', 'manager'); /* Database Password */

$siteTitle = 'PlaceHolder_SiteTitle';
$siteFooter = 'PlaceHolder_SiteFooter';
$siteBrand = 'Placeholder_SiteBrand';
$siteAddress = 'PlaceHolder_SiteAddress';
$siteShortTitle = 'PlaceHolder_SiteShortTitle';

/* Prepare Query to pull current settings from SiteConfig */
$sql = "SELECT ConfigName
                ,ShortTextValue
            FROM SiteConfig";
            /*echo '<br>sql: '.$sql;*/
$link = connectDB();

/*Run the query, if ConfigName matches 'SiteBrand', then set $siteBrand to ShortTextValue returned in from the query*/
if ($result=mysqli_query($link,$sql)){
    while ($row = mysqli_fetch_array($result)){
        if ($row[0] == 'siteTitle')  { $siteTitle = $row[1];}
        if ($row[0] == 'siteFooter') { $siteFooter = $row[1];}
        if ($row[0] == 'siteBrand') { $siteBrand = $row[1];}
        if ($row[0] == 'siteAddress') { $siteAddress = $row[1];}
        if ($row[0] == 'siteShortTitle') { $siteShortTitle = $row[1];}
      } 

}
/*Close DB connection*/
mysqli_close($link);

?>