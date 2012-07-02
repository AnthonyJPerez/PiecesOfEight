//
// Custom order form
//




$(document).ready(function()
{
	// Globals
	var globalFormCounter = 0;
	var customHidden = 'isHidden';
	
	//
	// Main
	//
	
	
	function scrollTo(section)
	{
		$('html, body')
			.stop()
			.animate(
				{
					scrollTop: section.offset().top
				}, 
				750,
				'easeInOutExpo'
			);
	}
	
	
	function disableSection(section)
	{
		section.addClass('sectionDisabled');
		section.find('.btn, input').each(function()
		{
			$(this).attr('disabled', true);
		});
	
		section.fadeTo('fast', 0.6);
	}
	
	function enableSection(section)
	{
		section.removeClass('sectionDisabled');
		section.find('.btn, input').each(function()
		{
			$(this).removeAttr('disabled');
		});
		
		section.fadeTo('fast', 1);
	}
	
	function gotoNextSection(section)
	{
		var nextSection = section.next();
		disableSection(section);
		enableSection(nextSection);
		scrollTo(nextSection);
	}
	
	function gotoPrevSection(section)
	{
		var prevSection = section.prev();
		disableSection(section);
		enableSection(prevSection);
		scrollTo(prevSection);
	}
	
	function checkForProducts(container)
	{
		var productList = container.find('#TEST_added_products').children();
		
		if (productList.length > 0)
		{
			container.find('.TEST_no-products').hide();
			container.find('.TEST_next').removeAttr('disabled');
		} else {
			container.find('.TEST_no-products').show();
			container.find('.TEST_next').attr('disabled', true);
		}
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
	
	
	function setVerificationBox(productInfo)
	{
		// Capture the Id and image associated with the selected product, and put them into the
		// verification box
		var verifyBox = $('#wizard_verification');
		verifyBox.children('img').attr('src', productInfo.htmlImg.attr('src'));
		verifyBox.children('#button_verification_yes').attr('data-productId', productInfo.id);
		verifyBox.children('.product_name').html(productInfo.name);
		//console.log(verifyBox);
	}
	
	
	function transitionFormWizard(current)
	{
		var next = current.next();
		var width = current.width();
		
		current.transition(
			{
				x: -width
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
	
	function isDisabled(element)
	{
		return element.attr('disabled');
	}
	
	
	function openWizard(wizard)
	{
		console.log("openwizard: ", wizard.is(":visible"));
		//if (wizard.is(":visible") == false)
		if (hasAttr(wizard, customHidden))
		{
			wizard
				.css('height', 0)
				.show()
				.transition({height: '300px'}, 500, 'in-out')
				.removeAttr(customHidden);
		}
	}
	
	function closeWizard(wizard)
	{
		//if (wizard.is(":visible") == true)
		if (!hasAttr(wizard, customHidden))
		{
			wizard
				.transition({height: '0'}, 500, 'in-out', function()
				{
					console.log("hiding", this);
					$(this)
						.attr(customHidden, customHidden)
						.hide();
				})
				.attr(customHidden, customHidden);
		}
	}
	
	
	function hasAttr(element, attribute)
	{
		var attr = element.attr(attribute);
		
		console.log("has attr: ", element, attribute, attr);
		
		if (typeof attr !== 'undefined' && attr !== false)
		{
			return true;
		}
		
		return false;
	}
	
	
	
	
	//
	// onClick events
	//
	
	// Edit a product
	$('#TEST_added_products').on('click', '.TEST_edit', function(event)
	{
		event.preventDefault();
		if (isDisabled($(this))) return;
				
		$(this).siblings('.custom_product_details').find('fieldset').each(function()
		{
			$(this).toggle();
		});
	});
	
	
	$('#TEST_custom_product_inquiry_form').on('click', '.TEST_next', function(event)
	{
		event.preventDefault();
		if (isDisabled($(this))) return;
		
		gotoNextSection( $(this).parent() );		
	});
	
	$('#TEST_custom_product_inquiry_form').on('click', '.TEST_prev', function(event)
	{	
		event.preventDefault();
		if (isDisabled($(this))) return;
		
		gotoPrevSection( $(this).parent() );
	});
	
	// "Customize a new Product" button
	$("#TEST_customize").on('click', '.TEST_add_custom_product', function(event)
	{
		event.preventDefault();
		if (isDisabled($(this))) return;
		
		var formWizard = $('#create_product_wizard');
		
		resetFormWizard(formWizard);
		if (!hasAttr(formWizard, customHidden))
		{
			console.log("closing wizard");
			closeWizard(formWizard);
			scrollTo($('#TEST_customize'));
		}
		else
		{
			console.log("opening wizard");
			openWizard(formWizard);
			scrollTo($('#create_product_wizard'));
		}
	});
	
	
	// Form Wizard - Add product - Update the verification box with the selected product
	$("#wizard_selector").on('click', '.add', function(event)
	{		
		event.preventDefault();
		if (isDisabled($(this))) return;
		
		var productInfo = {};
		productInfo.id = $(this).attr('data-productId');
		productInfo.htmlImg = $(this).parent().siblings('img').clone(); // clone the img as well
		productInfo.name = $(this).siblings('.product_name').html();
		setVerificationBox(productInfo);
		
		transitionFormWizard( $('#wizard_selector') );
	});
	
	
	// Form Wizard - Product verified, Go to the measurements section
	$('#wizard_verification').on('click', '#button_verification_yes', function(event)
	{	
		console.log("verifying 1");
		event.preventDefault();
		if (isDisabled($(this))) return;
		
		console.log("verifying 2");
		
		var button = $(this);
		$.ajax({
			'url': button.attr('data-baseurl') + "/product/getProductCustomForm/" + button.attr('data-productid') + "/" + globalFormCounter++,
			'cache': false,
			complete: function(jqXHR, textStatus)
			{
				if (textStatus == 'success')
				{
					// Add the image and the custom html into the #product_details form
					var html = jqXHR.responseText;
					$('#wizard_details_container').html(html);	
					transitionFormWizard( $('#wizard_verification') );
				}
			}
		});		
	});
	
	
	// Product not verified, go back to the product selection
	$("#product_verification").on('click', '#button_verification_no', function(event)
	{
		event.preventDefault();
		if (isDisabled($(this))) return;
		
	});
	
	
	// Add the customized product to the list
	$('#wizard_details').on('click', '.addProductToList', function(event)
	{
		event.preventDefault();
		if (isDisabled($(this))) return;
		
		console.log("adding product");
		
		// Verify the data
		// ...
		
		// Save the data into local storage
		// ...
		
		// Inject this form data into the main form.
		var original = $('#wizard_details .custom_product_details');
		
		// Make the edit form invisible
		original.find('fieldset').each(function()
		{
			$(this).toggle(); // make invisible
		});
		
		var newProduct = $('<li></li>');
		$('<a href="#" class="TEST_edit btn btn-warning btn-small"><i class="icon-pencil"></i>Edit</a>').appendTo(newProduct);
		newProduct.append(original);
		newProduct.appendTo( $('#TEST_added_products') );
		
		scrollTo($('#TEST_customize'));
		closeWizard($('#create_product_wizard'));
			
		checkForProducts($('#TEST_customize'));		
	});
	
	
	$('#TEST_review').on('click', '.TEST_submit', function(event)
	{
		event.preventDefault();
		if(isDisabled($(this))) return;
	});
	
	
	
	// TEST
	var sectionCustomize = $('#TEST_customize');
	var sectionUserInfo = $('#TEST_user_info');
	var sectionReview = $('#TEST_review');
	
	$('#create_product_wizard, #edit_product_wizard').each(function()
	{
		$(this)
			.css('position', 'relative')
			.css('overflow', 'hidden')
			.css('width', '100%')
			.css('height', '400px')
			.css('background-color', 'grey')
			.attr(customHidden, customHidden)
			.hide();
			
		$(this).children().each(function()
		{
			$(this)
				.css('position', 'absolute')
				.css('opacity', 0);
		});
	});
	
	enableSection(sectionCustomize);
	disableSection(sectionUserInfo);
	disableSection(sectionReview);
	
	checkForProducts($('#TEST_customize'));
	
	
	
});