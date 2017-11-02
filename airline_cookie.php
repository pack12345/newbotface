
<?php
//$departure = $_SESSION['departure']; 
//$_SESSION['departure'] = $_GET['departure']; 
// $sDeparture = ; 
// $sDate = $_GET['date']; 
// $_COOKIE['ckDeparture'] = 1; 
// $_COOKIE['ckDate'] = 2; 
setcookie('departure',$_GET['departure'],time()+3600, "/");
setcookie('date',$_GET['date'],time()+3600, "/");

error_log('--$_GET error : '.$_GET['departure']);
error_log('--$_GET error : '.$_GET['date']);
error_log('--$sDeparture error : '.$_COOKIE['departure']);
error_log('--$sDate error : '.$_COOKIE['date']);
