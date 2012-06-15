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
	//$("#button_verification_yes").click(function()	
	{	
		console.log('test');
		console.log('this: ', this);
		$button = $(this);
		$.ajax({
			'url': $button.attr('data-baseurl') + "/product/getProductCustomForm/" + $button.attr('data-productid') + "/" + globalFormCounter++,
			'cache': false,
			complete: function(jqXHR, textStatus)
			{
				if (textStatus == 'success')
				{
					var html = stripExistingScripts(jqXHR.responseText);
					$('#product_details').html(html);
				}
			}
		});
		
		// return...?
	});
	
	// Product not verified, go back to the product selection
	$("#button_verification_no").click(function()
	{
	
	});
});