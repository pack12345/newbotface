
<?php
$_COOKIE['ckDeparture'] = $_GET['departure']; 
$_COOKIE['ckDate'] = $_GET['date']; 

echo "departure".$_GET['departure'];
echo "date".$_GET['date'];
echo "$_COOKIE".$_COOKIE['ckDeparture'];
echo "$_COOKIE".$_COOKIE['ckDate'];
