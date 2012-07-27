$(".view-full-size").click(function() {

	
  var theImage = new Image();
  theImage.src = "/images/Size-Chart.png";
	
  var winWidth = 800 + 20;
  var winHeight = 1340 + 20;
	
  window.open(this.href,  null, 'height=' + winHeight + ', width=' + winWidth + ', toolbar=0, location=0, status=0, scrollbars=1, resizable=0'); 
	
  return false;
	
});