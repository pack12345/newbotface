<?php
$access_token = 'Mb1MfpF5t/adwXJenkK5jMkKvZOcGCOaiLIZzFI2ZcV059EKV4eC0FV4Euf8FPg4XqQcDwoB+7bTMVxxtoeJgAlqAxJfbXcnpzxLX8eiHTIaA6snZz8ZU6i8q9drPExofgFrjUrDH/TuDT/OYenjDgdB04t89/1O/w1cDnyilFU=';

$url = 'http://Administrator:8070/VoxeoCXP/DialogMapping?VSN';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
