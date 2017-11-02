
<?php
//$departure = $_SESSION['departure']; 
$_SESSION['ssdeparture'] = $_GET['departure']; 
$_SESSION['ssdate'] = $_GET['date']; 
// $_COOKIE['ckDeparture'] = 1; 
// $_COOKIE['ckDate'] = 2; 

echo "departure".$_GET['departure'];
echo "ssdeparture".$_SESSION['departure'];
echo "departure1".$_GET['date'];
echo "ssdeparture1".$_SESSION['date'];
