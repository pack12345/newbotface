<?php
error_log('facebook hook ');
 
   $access_token = 'EAAcCIIH2scoBAIraN46Dv06N41dlZC5E5gkKcwZBuU0mXS6wK71pnThMs97An0ZAnNCauHv0qv8TZBVaHyur9JjWUvrem5EkXpE867SlQbuSKdic9lfM5zZA3xz956pfahV24mHDIHKhSsBLUAEZA17OXg2vZBaQ5nGBcRxZBdpAOgZDZD';
   $verify_token = 'airline_bot';
   $hub_verify_token = null;

   if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
   }
   if ($hub_verify_token === $verify_token) {
    echo $challenge;
   }
 
 
 ?>
