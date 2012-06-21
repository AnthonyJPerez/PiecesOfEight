//
// Custom order form
//




$(document).ready(function()
{
	// Globals
	var globalFormCounter = 0;
	
	
	// Avoid injecting duplicate scripts
	function isDefined(path) 
	{
		var target = window;
		var parts = path.split('.');
		
		while(parts.length) {
		  var branch = parts.shift();
		  if (typeof target[branch] === 'undefined') {
			return false;
		  }
		
		  target = target[branch];
		}
		
		return true;
	}
	
	function stripExistingScripts(html)
	{
		var map = {
			"jquery.js": "$",
			"jquery.min.js": "$",
			"jquery-ui.min.js": "$.ui",
			"jquery.yiiactiveform.js": "$.fn.yiiactiveform",
			"jquery.yiigridview.js": "$.fn.yiiGridView",
			"jquery.ba-bbq.js": "$.bbq"
		};
		
		for (var scriptName in map) 
		{
			var target = map[scriptName];
			if (isDefined(target)) 
			{
				var regexp = new RegExp('<script.*src=".*' +
							scriptName.replace('.', '\\.') +
							'".*</script>', 'i');
				html = html.replace(regexp, '');
			}
		}
		
		return html;
	}
	

	function setVerificationBox(productInfo)
	{
		// Capture the Id and image associated with the selected product, and put them into the
		// verification box
		var verifyBox = $('#product_verification');
		verifyBox.children('img').attr('src', productInfo.htmlImg.attr('src'));
		verifyBox.children('#button_verification_yes').attr('data-productId', productInfo.id);
		verifyBox.children('.product_name').html(productInfo.name);
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
		productInfo.name = $(this).siblings('.product_name').html();
		setVerificationBox(productInfo);
	});
	
	
	// Product verified, Go to the measurements section
	$('#product_verification').on('click', '#button_verification_yes', function()
	{	
		console.log('test');
		console.log('this: ', this);
		var button = $(this);
		$.ajax({
			'url': button.attr('data-baseurl') + "/product/getProductCustomForm/" + button.attr('data-productid') + "/" + globalFormCounter++,
			'cache': false,
			complete: function(jqXHR, textStatus)
			{
				if (textStatus == 'success')
				{
					// Add the image and the custom html into the #product_details form
					var html = stripExistingScripts(jqXHR.responseText);
					//button.siblings('img').clone().appendTo($('#product_details')); // copy the image again into this form.
					$('#product_details').append(html);	
				}
			}
		});
		
		// return...?
	});
	
	
	// Product not verified, go back to the product selection
	$("#product_verification").on('click', '#button_verification_no', function()
	{
		
	});
	
	
	// Clear the form
	//$('#product_verification').on('click', '#button_verification_yes', function()


	// Add the customized product
	$('#product_details').on('click', '.add_product', function()
	{
		console.log("adding product");
		
		// Verify the data
		// ...
		
		// Save the data into local storage
		// ...
		
		// Inject this form data into the main form.
		var original = $('#product_details .custom_product_details');
		//var cloned = original.clone();
		//console.log('cloned: ', cloned, cloned.find('textarea'));
		//cloned.find('textarea').val( original.find('textarea').val() ); // value of text areas are not copied in jquery, it's a bug..
		
		var newProduct = $('<div></div>');
		newProduct.append(original);
		newProduct.appendTo( $('#custom_product_array') );
		
	});
	
	
	// Edit a product
	$('#custom_product_array').on('click', '.edit', function(event)
	{
		console.log('editing product');
		
		$(this).siblings('fieldset, button').each(function()
		{
			$(this).toggle();
		});
		
		/*
		var content = $(this).parent().children('*');		
		$('#product_details').html(content);
		*/
		
		event.preventDefault();
	});
	
	// Save edits
	$('#custom_product_array').on('click', '.add_product', function()
	{
		$(this).parent().children('fieldset, button').each(function()
		{
			$(this).toggle();
		});
	});
});