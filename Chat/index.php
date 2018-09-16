<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Chat</title>
    
    <link rel="stylesheet" href="style.css" type="text/css" />
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">
    
        // ask user for name with popup prompt    
        var name = prompt("Enter your chat name:", "Guest");
        
        // default name is 'Guest'
    	if (!name || name === ' ') {
    	   name = "Guest";	
    	}
    	
    	// strip tags
    	name = name.replace(/(<([^>]+)>)/ig,"");
    	
    	// display name on page
    	$("#name-area").html("You are: <span>" + name + "</span>");
    	// kick off chat
        var chat =  new Chat();
	    
	var lineuser = "";
	var agenttype = 'Agent.txt';
	var chattype = 'chat.txt';
	    if (name.includes("LOAN")) {
		    chattype = 'chatLOAN.txt';
		    agenttype = 'AgentLOAN.txt';
		    <?php 
		    $my_file1 = 'AgentLOAN.txt';
		    if(file_exists($my_file1)){
			    $line = file($my_file1);
			    echo "lineuser = "."'".$line[0]."';";
		    }
		    ?>
	    } else if (name.includes("CREDIT")) {
		    chattype = 'chatCREDIT.txt';
		    agenttype = 'AgentCREDIT.txt';
		    <?php 
		    $my_file1 = 'AgentCREDIT.txt';
		    if(file_exists($my_file1)){
			    $line = file($my_file1);
			    echo "lineuser = "."'".$line[0]."';";
		    }
	            ?>
	    } else {
		    <?php 
		    $my_file1 = 'Agent.txt';
		    if(file_exists($my_file1)){
			    $line = file($my_file1);
			    echo "lineuser = "."'".$line[0]."';";
		    }
	            ?>
	     }
    	$(function() {
    	
    		 chat.getState(chattype); 
    		 
    		 // watch textarea for key presses
             $("#sendie").keydown(function(event) {  
             
                 var key = event.which;  
           
                 //all keys including return.  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength");  
                     var length = this.value.length;  
                     
                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                  }  
    		 																																																});
    		 // watch textarea for release of key press

    		 $('#sendie').keyup(function(e) {	
    		 					 
    			  if (e.keyCode == 13) { 
    			  
                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                    
			    
                    // send 
                    if (length <= maxLength + 1) { 
                     
    			        chat.send(text, name, chattype);	
    			        $(this).val("");
    			        
                    } else {
                    
    					$(this).val(text.substring(0, maxLength));
    					
    				}	
    				
    				
    			  }
             });
    	});
		
		function SendChat(e){
			if (e.keyCode == 13) { 
				text =  document.getElementById("sendie").value;
				var maxLength = document.getElementById("sendie").getAttribute("maxlength"); 
				var length = text.length; 
 				if (length <= maxLength + 1) { 
				
				try{
					var xhttp = new XMLHttpRequest();
					//var readfile = new XMLHttpRequest();
					//readfile.open("GET", agenttype, false);
					//readfile.onreadystatechange = function () {
					//	if(readfile.status == 200 || readfile.readyState == 4) {
					//		lineuser = readfile.responseText;
					//	}
					//} readfile.send(null);
					var fs = require("fs");
					fs.readFile("./"+agenttype, function(text){
						lineuser = text.split("\n")
						});
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {

						}
					};
					
			url = 'https://cxpmiddleware.herokuapp.com/Push_To_Line.php?userid=Ua8e7ee2b2c8f81b0e0a414518846351a&text='+text+'user'+lineuser[0]+'&type='+agenttype;
				xhttp.open("GET", url, true);
				xhttp.send();
					
				 }
				 catch(err) {
					 alert(err.message);
				 }
				
    			        
                } 	
			}
		}
    </script>

</head>

<body onload="setInterval('chat.update(chattype)', 1000)">

    <div id="page-wrap">
    
        <h2>Agent Chat</h2>
        
        <p id="name-area"></p>
        
        <div id="chat-wrap"><div id="chat-area"></div></div>
        
        <form id="send-message-area">
            <p>Your message: </p>
            <textarea id="sendie" maxlength = '100' onkeyup="SendChat(event);"></textarea>
        </form>
    
    </div>

</body>

</html>
