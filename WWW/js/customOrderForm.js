//
// Custom order form
//




$(document).ready(function()
{
	function setVerificationBox(productInfo)
	{
		// Capture the Id and image associated with the selected product, and put them into the
		// verification box
		var verifyBox = $('#product_verification');
		verifyBox.children('img').attr('src', productInfo.htmlImg.attr('src'));
		verifyBox.children('#button_verification_yes').attr('data-productId', productInfo.id);
		//console.log(verifyBox);
	}
	
	
	
	
	
	
	
	
	//
	// Main
	//
	

	// Update the verification box with the selected product
	$("#product_selector button").click(function()
	{		
		var productInfo = {};
		productInfo.id = $(this).attr('data-productId');
		productInfo.htmlImg = $(this).parent().siblings('img').clone(); // clone the img as well
		setVerificationBox(productInfo);
	});
	
	
	// Product verified, Go to the measurements section
	/*$("#button_verification_yes").click(function()
	{
	
	});*/
	
	// Product not verified, go back to the product selection
	$("#button_verification_no").click(function()
	{
	
	});
});