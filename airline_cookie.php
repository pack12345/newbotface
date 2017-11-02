
<?php
//$departure = $_SESSION['departure']; 
$_SESSION['ssdeparture'] = $_GET['departure']; 
$_SESSION['ssdate'] = $_GET['date']; 
// $_COOKIE['ckDeparture'] = 1; 
// $_COOKIE['ckDate'] = 2; 

echo "departure".$_GET['departure'];
echo "ssdeparture".$_SESSION['departure'];
echo "date".$_GET['date'];
echo "ssdate".$_SESSION['date'];
header('https://floating-brook-89249.herokuapp.com/airline_cookie.php?departure='.$_SESSION['ssdeparture'].'&date='.$_SESSION['ssdate']);
