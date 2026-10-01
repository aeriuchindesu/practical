<?php
// On InfinityFree, your host usually looks like: ://infinityfree.com
$host = "your_infinityfree_mysql_host"; 
$user = "your_infinityfree_mysql_user"; 
$pass = "your_infinityfree_mysql_password"; 
$db_name = "your_infinityfree_database_name"; 

$conn = mysqli_connect($host, $user, $pass, $db_name);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
