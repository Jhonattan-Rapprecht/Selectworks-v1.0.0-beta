	
	/* Code for displaying the animation on page load */
	
	
	
	document.onreadystatechange = function () {
	  var state = document.readyState
	  if (state == 'loading') {
	       document.getElementById('body').style.visibility="hidden";
	  } else if (state == 'complete') {
	      setTimeout(function(){
	         document.getElementById('load').style.visibility="hidden";
	         document.getElementById('body').style.visibility="visible";
	      },1000);
	  }
	}