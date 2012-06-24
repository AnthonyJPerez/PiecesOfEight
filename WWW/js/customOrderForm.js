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
	
	
	
	function resetFormWizard(formWizard)
	{
		var children = formWizard.children();
		
		children.each(function()
		{
			$(this).css('opacity', 0).css('x', formWizard.width());
		});
		
		children.first().css('opacity', 1).css('x', 0);
	}
	
	function transitionFormWizard(current)
	{
		//current.hide();
		//current.next().show();
		var next = current.next();
		var width = current.width();
		
		current.transition(
			{
				x: -width,
				//opacity: 0
			},
			250,
			"in"
		);
		
		next.css({x: next.parent().width() }).transition
		(
			{
				x: 0,
				opacity: 1
			},
			500,
			"out"
		);
	}
	
	
	
	
	
	//
	// Main
	//
	
	// "Customize a new Product" button
	$("#custom_product_inquiry_form").on('click', '.create_product', function(event)
	{
		var formWizard = $('#create_product_wizard');
		resetFormWizard(formWizard);
		formWizard.css('height', 0).css('width', 0).show()
			.transition({width: '100%', height: '400px'});
		
		
		event.preventDefault();
	});
	

	// Form Wizard - Add product - Update the verification box with the selected product
	$("#product_list").on('click', '.add', function(event)
	{		
		var productInfo = {};
		productInfo.id = $(this).attr('data-productId');
		productInfo.htmlImg = $(this).parent().siblings('img').clone(); // clone the img as well
		productInfo.name = $(this).siblings('.product_name').html();
		setVerificationBox(productInfo);
		
		transitionFormWizard( $('#product_selector') );
		
		event.preventDefault();
	});
	
	
	// Form Wizard - Product verified, Go to the measurements section
	$('#product_verification').on('click', '#button_verification_yes', function()
	{	
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
					$('#product_details_container').html(html);	
					transitionFormWizard( $('#product_verification') );
				}
			}
		});
		
		// return...?
		event.preventDefault();
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
		
		// Make the edit form invisible
		original.find('fieldset').each(function()
		{
			$(this).toggle(); // make invisible
		});
		
		var newProduct = $('<div></div>');
		$('<a href="#" class="edit">Edit</a>').appendTo(newProduct);
		newProduct.append(original);
		newProduct.appendTo( $('#custom_product_array') );
		
		//$('#create_product_wizard').hide();
		$('#create_product_wizard')
			.transition({width: '0', height: '0'}, function()
			{
				$(this).hide();
			});
			
		// Enable the 'collect user contact info' button
		$('#collect_contact_info').show();
		// Change the button text
		$('#custom_product_inquiry_form .create_product').html('Customize another Item');
		
		event.preventDefault();
	});
	
	
	// Edit a product
	$('#custom_product_array').on('click', '.edit', function(event)
	{
		console.log('editing product');
		
		$(this).siblings('.custom_product_details').find('fieldset').each(function()
		{
			$(this).toggle();
		});
		
		event.preventDefault();
	});
	
	
	// Move form onto the collect user information portion of the wizard
	$('#custom_product_inquiry_form').on('click', '#collect_contact_info', function(event)
	{
		$('#user_details').show();
		event.preventDefault();
	});
	
	
	
	// Initialize the form
	$('#create_product_wizard')
		.css('position', 'relative')
		.css('overflow', 'hidden')
		.css('width', '100%')
		.css('height', '400px')
		.css('background-color', 'grey')
		.hide();
	$('#create_product_wizard').children().each(function()
	{
		// hide each child element as well:
		var t = $(this);
		t.css('position', 'absolute');
		t.css('opacity', 0);
	});
	$('#user_details').hide();
	$('#review_inquiry').hide();
	$('#collect_contact_info').hide();
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function disableSection(section)
	{
		section.addClass('sectionDisabled');
		section.find('button, input').each(function()
		{
			$(this).attr('disabled', true);
		});
	}
	
	function enableSection(section)
	{
		section.removeClass('sectionDisabled');
		section.find('button, input').each(function()
		{
			$(this).removeAttr('disabled');
		});
	}
	
	function gotoNextSection(section)
	{
		disableSection(section);
		enableSection(section.next());
	}
	
	function gotoPrevSection(section)
	{
		disableSection(section);
		enableSection(section.prev());
	}
	
	
	//
	// onClick events
	//
	
	$('#TEST_custom_product_inquiry_form').on('click', '.TEST_next', function(event)
	{
		gotoNextSection( $(this).parent() );
		
		event.preventDefault();
	});
	
	$('#TEST_custom_product_inquiry_form').on('click', '.TEST_prev', function(event)
	{
		gotoPrevSection( $(this).parent() );
		
		event.preventDefault();
	});
	
	
	
	// TEST
	var sectionCustomize = $('#TEST_customize');
	var sectionUserInfo = $('#TEST_user_info');
	var sectionReview = $('#TEST_review');
	
	enableSection(sectionCustomize);
	disableSection(sectionUserInfo);
	disableSection(sectionReview);
});