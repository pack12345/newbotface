<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Chat</title>
    
    <link rel="stylesheet" href="style.css" type="text/css" />
    
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
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
		
		
		var chattype = 'chat.txt';
		var agenttype = 'Agent.txt';		
	    if (name.toUpperCase().includes("LOAN")) {
		    chattype = 'chatLOAN.txt';
		    agenttype = 'AgentLOAN.txt';
	    } else if (name.toUpperCase().includes("CREDIT")) {
		    chattype = 'chatCREDIT.txt';
		    agenttype = 'AgentCREDIT.txt';
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
					var lineuser = GetLineID();
					if(lineuser == ""){
						#var readfile = new XMLHttpRequest();
						#readfile.open("GET", agenttype, true);
						#readfile.send();
						#readfile.onreadystatechange = function () {
						#	if(readfile.status == 200 || readfile.readyState == 4) {
						#		lineuser = readfile.responseText;
								var xhttp = new XMLHttpRequest();
								url = 'https://cxpmiddleware.herokuapp.com/Push_To_Line.php?userid=Ua8e7ee2b2c8f81b0e0a414518846351a'+'&text=0'+text+lineuser+'&type='+agenttype;
								xhttp.open("GET", url, true);
								xhttp.send();
								xhttp.onreadystatechange = function() {
									if (this.readyState == 4 && this.status == 200) {
			
									}
								};	
							}
						}
						
					}
					else {
						var xhttp = new XMLHttpRequest();
						url = 'https://cxpmiddleware.herokuapp.com/Push_To_Line.php?userid=Ua8e7ee2b2c8f81b0e0a414518846351a'+'&text='+text+lineuser+'&type='+agenttype;
						xhttp.open("GET", url, true);
						xhttp.send();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
	
							}
						};	
					}
					if (text.toUpperCase().includes("ขอบคุณ")) {
						lineuser = "";
					}
				 }
				 catch(err) {
					 alert(err.message);
				 }
    			        
                } else {                

    			}	
			}
		}
		
		function GetLineID(){
			var readfile = new XMLHttpRequest();
			readfile.open("GET", agenttype, true);
			readfile.send();
			readfile.onreadystatechange = function () {
				if(readfile.status == 200 || readfile.readyState == 4) {
					var lineuser = readfile.responseText;
					return lineuser;
				}
			}
		}
    </script>

</head>

<body onload="setInterval('chat.update(chattype)', 1000)">

    <div id="page-wrap">
    
        <h2>Agent Chat Page</h2>
        
        <p id="name-area"></p>
        
        <div id="chat-wrap"><div id="chat-area"></div></div>
        
        <form id="send-message-area">
            <p>Your message: </p>
            <textarea id="sendie" maxlength = '100' onkeyup="SendChat(event);"></textarea>
        </form>
    
    </div>

</body>

</html>
