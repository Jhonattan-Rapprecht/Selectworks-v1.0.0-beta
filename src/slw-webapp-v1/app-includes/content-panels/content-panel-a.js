					// Get the modal
					var panel = document.getElementsByClassName("panel-container")[0];
					
					// Get the button that opens the modal
					var btn = document.getElementById("myBtn");
					
					// Get the <span> element that closes the modal
					var span = document.getElementsByClassName("close")[0];
					
					// When the user clicks on <span> (x), close the modal
					span.onclick = function() {
					  panel.style.display = "none";
					}
					
					// When the user clicks anywhere outside of the modal, close it
					window.onclick = function(event) {
					  if (event.target == document.body) {
					    panel.style.display = "none";
					  }
					}
					
					//Check if cookie is empty and display panel to first time visitor
					console.log(document.cookie);
					
						if (document.cookie != "") {
						
							panel.style.display = "none";
						
						
						} else {
						
						panel.style.display = "block";
						
						}
						
					//Get the consent buttons and create a cookie if it is clicked
					  
					function createCookie() {
						
					//Create cookie
					document.cookie = "selectworks-webdata-analytics=firstVisit";
							
					//Hide panel						  
					panel.style.display = "none";
						  	
					}
						  
					function hidePanel() { 
					  
					panel.style.display = "none";
					  
					}
					