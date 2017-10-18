<?php
$access_token = 'IHf9TGAiHOH3XZdKNdrz+NBHzcPr2y+f2rpdiDj7b2okT11aW2a7eknIfMCVkkIekN82nmiUonCyubOwPxCD0WN6ObtI8miTVkemgWQN8M27m8kCdxcbE6Q/rGRExajPhaWfpzyrO8xTyGyIrE/TGgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
