<?php

$log = array();
    
    if($_GET['userid'] != ""){
        
		  $nickname = $_GET['userid'];#htmlentities(strip_tags($_GET['userid']));
			# $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
			  $message = $_GET['text'];#htmlentities(strip_tags($_GET['text']);
		# if(($message) != "\n"){
        	
		#	 if(preg_match($reg_exUrl, $message, $url)) {
       		#	$message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
		#		} 
			 if(!file_exists('Agent.txt')){
				 fwrite(fopen('Agent.txt', 'w'), $_GET['userid'] . "\n");
				 fclose(fopen('Agent.txt', 'w'));
			 }
			 
        	
        	 fwrite(fopen('chat.txt', 'a'), "<span>". $nickname . "</span>" . $message = str_replace("\n", " ", $message) . "\n"); 
		 #}
     }
  echo json_encode($log);

?>
