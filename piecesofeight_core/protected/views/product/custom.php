<?php
	/* product/create view */


	Yii::app()->clientScript->registerCss(
		'product-custom-form-style',
		'
			
			#product_list li, #selected_products li
			{
				width: 175px;
			}
			
			.product_listing_text
			{
				display: block;
				margin-top: 0.5em;
				font-size: 0.85em;
			}
			
			.product_name
			{
				display: block;
			}
			
			.instructions 
			{
				font-size: 10pt;
			}
			
			
			#create_product_wizard,
			#user_details,
			#review_inquiry,
			#collect_contact_info
			{
				display: none;
			}
			
			
			#custom_product_array
			{
				position: relative;
				width: 100%;
			}
			
			
			#custom_product_array div
			{
				display: inline-block;
				margin-right: 1em;
				width: 175px;
			}
						
			
			
			#wizard_selector
			{
				border-color: red;
				width: 100%;
				height: 100%;
				overflow: auto;
			}
			
			#wizard_selector li
			{
				float: left;
			}
			
			
			.sectionDisabled
			{
				color: lightgrey;
			}
			
			.sectionDisabled input
			{
				background: lightgrey;
			}
			
		
			
			#TEST_added_products li
			{
				display: inline-block;
				margin-right: 1em;
				margin-bottom: 1.5em;
				width: 110px;
				text-align: center;
				position: relative;
				vertical-align: top;
			}
			
			#TEST_added_products img
			{
				width: 100%;
				box-shadow: 2px 2px 4px #888;
				-moz-box-shadow: 2px 2px 4px #888; 
				-webkit-box-shadow: 2px 2px 4px #888;
			}
			
			#TEST_added_products .TEST_edit
			{
				position: absolute;
				bottom: 3px;
				right: 0px;
				padding: 3px !important;
			}
			
			#TEST_added_products span
			{
				font-size: 10pt;
			}
			
			input, textarea
			{
				border-radius: 5px; 
				-moz-border-radius: 5px; 
				-webkit-border-radius: 5px;
				
				box-shadow: 0px 1px 0px #f2f2f2;
				-moz-box-shadow: 0px 1px 0px #f2f2f2; 
				-webkit-box-shadow: 0px 1px 0px #f2f2f2;
				
				background: white;
			}
			
			input:focus, textarea:focus {
				background: white;
			}
			
			
			#edit_product_wizard
			{
				background-color: green;
			}
		',
		'screen'
	);
	
	
	// Include the jquery library
	Yii::app()->clientScript->registerCoreScript('jquery');
	
	
	//
	// Include the Transit script
	//
	// documentation: http://ricostacruz.com/jquery.transit/
	//
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/transit/jquery.transit.min.js', 
		CClientScript::POS_HEAD
	);
	
	
	//
	// Include the fancybox script
	//
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/fancybox/jquery.fancybox-1.3.4.pack.js', 
		CClientScript::POS_HEAD
	);
	
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/fancybox/jquery.easing-1.3.pack.js', 
		CClientScript::POS_HEAD
	);
	
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/fancybox/jquery.mousewheel-3.0.4.pack.js', 
		CClientScript::POS_HEAD
	);
	
	// Include the fancybox css file
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/js/fancybox/jquery.fancybox-1.3.4.css',
		'screen'
	);
	
	// Init Fancybox
	Yii::app()->clientScript->registerScript(
		'Fancybox_CustomProduct',
		"
			$('a[img]').fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over'
			});
		",
		CClientScript::POS_READY
	);
	
	
	
	//
	// Include the Sisyphus script
	//
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/sisyphus/sisyphus.min.js', 
		CClientScript::POS_HEAD
	);
	
	
	// Init Sisyphus
	Yii::app()->clientScript->registerScript(
		'Sisyphus_CustomProduct',
		"
			// Check to make sure local storage is supported. If so, we'll protect
			// our forms using Sisyphus!
			
			//if (Modernizr.localstorage)
			//{
				// http://simsalabim.github.com/sisyphus/ -- documentation
				$('#customOrderForm').sisyphus(
				{
					customKeyPrefix: 'po8_',
					timeout: 0	// save after every change
				});
			//}
			
		",
		CClientScript::POS_READY
	);
	
	
	
	// Custom form javascript:
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/customOrderForm.js', 
		CClientScript::POS_HEAD
	);
	
	
?>

<h1>Custom Order Inquiries</h1>
<p>
	This page is currently in development. For custom order inquiries, check out our <?php echo CHtml::link('Contact Page', $this->createUrl('site/contact')); ?>
</p>


<?php
	// TEmporary!! Only have this code here until this page is ready for production mode
	if (defined('YII_DEBUG') && constant('YII_DEBUG') != false)
	{
?>
		




<!--ol class='instructions'>
	<li>Choose the products you are interested in.</li>
	<li>Fill out the custom-order form below.</li>
	<li>Supply your email.</li>
	<li>Done! Your info will be emailed to us and, as soon as we can, we will let you know what fabrics we have available and give you a quote on your order.</li>
	<li>When you are ready, we will create a private listing with your custom order so you can purchase and we can start sewing!
</ol-->


<?php
/*
Array ( 
	[Product] => Array ( 
		[name] => name 
		[price] => 10 
		[description] => description 
		[care_information] => care information 
		[category_id] => 1 
		[images] => 
		[defaultImage] => 
		[p8Sizes] => Array ( 
			[0] => 1 
			[1] => 5 
		) 
		[p8Tags] => Array ( 
			[0] => 1 
		) 
		[p8Measurements] => Array ( 
			[0] => 14 
			[1] => 15 
		) 
		[p8Addons] => Array ( 
			[0] => 1 
		) 
		[p8Fabrics] => Array ( 
			[0] => 1 
			[1] => 2 
		) 
	) 
	[yt0] => Create Product 
)
*/
?>


<?php
$form = $this->beginWidget('GxActiveForm', array(
	'id' => 'custom-inquiry-form',
	'enableAjaxValidation' => false
));
?>


<div id='TEST_custom_product_inquiry_form'>
	<div id="TEST_customize">
		<h2>Step 1: Customize!</h2>
		
		<div id='TEST_added_products_container'>
			<div><b>Your Custom Products:</b></div>
			<span class='TEST_no-products'>No products added</span>
			<ul id='TEST_added_products'></ul>
		</div>
		
		
		<a class="TEST_add_custom_product btn btn-primary" href="#">
			<i class="icon-plus"></i>
			Customize a Product
		</a>
		
		<div id="edit_product_wizard">
		
		</div>
		
		<div id="create_product_wizard">
			<!-- Show all products -->
			<div id='wizard_selector'>
				<ul id='product_list'>
				<?php
					foreach ($_AllProducts as $product)
					{
					?>
						<li class='product_listing'>
						<?php
							echo CHtml::image(
								Yii::app()->request->baseUrl . '/images/product-images/' . $product->getDefaultImage(),
								$product->getProductImgAltDescription(),
								array('width'=>100)
							);
							echo "<p class='product_listing_text'>";
							echo "<span class='product_name'>".$product->name."</span>";
							echo "<a href='#' class='add btn btn-inverse' data-productId='".$product->id."'>Add</a>";
							echo "</p>"
						?>
						</li>
					<?php
					}
				?>
				</ul>
			</div>		
			
			<!-- Is this the right product? -->
			<div id='wizard_verification'>
				<span class='product_name'></span>
				<img width="100px" href="" />
				<span>Is this the product you want to add?</span>
				<a id="button_verification_yes" class="btn btn-inverse" href="#" data-productid="" data-baseurl="<?php echo Yii::app()->baseUrl; ?>">Yes</a>
				<a id="button_verification_no" class="btn btn-inverse" href="#">No</a>
			</div>		
			
			<!-- Grab details of this product -->
			<div id='wizard_details'>
				<a href="#" class='addProductToList btn btn-inverse' >Add Product</a>
				<div id="wizard_details_container">
				
				</div>
			</div>
		</div>
		
		<a class="TEST_next btn" href="#">
			<i class="icon-arrow-down"></i>
			Continue to Contact Information
		</a>
	</div>
	
	
	<div id="TEST_user_info">
		<h2>Step 2: Contact Information</h2>
		
		<?php
			// email
			echo "<div>";
			echo CHtml::label('Email', '');
			echo CHtml::textField('email');	
			echo "</div>";
			
			// confirm email
			echo "<div>";
			echo CHtml::label('Confirm Email', '');
			echo CHtml::textField('confirm_email');	
			echo "</div>";
			
			// date of event
			echo "<div>";
			echo CHtml::label('Date of Event', '');
			echo "<input type='date' />";
			echo "</div>";
			
			// shipping internationally?
			echo "<div>";
			echo CHtml::label('Would you be shipping Internationally?', '');
			echo CHtml::radioButtonList(
				'shipping_international',
				'',	// select, not sure what this does, but people leave it empty
				array (
					0 => 'no',
					1 => 'yes'
				),
				array (
					'separator' => ''
				)
			);	
			echo "</div>";
		?>
		
		<a class="TEST_prev btn" href="#">
			<i class="icon-arrow-up"></i>
			Customize more Items
		</a>

		<a class="TEST_next btn" href="#">
			<i class="icon-arrow-down"></i>
			Review your Inquiry
		</a>
		
	</div>
	
	
	<div id="TEST_review">
		<h2>Step 3: Review Inquiry</h2>
		
		<a class="TEST_prev btn" href="#">
			<i class="icon-arrow-up"></i>
			Edit Contact Information
		</a>
		
		<a class="TEST_submit btn btn-success" href="#">
			<i class="icon-envelope-alt"></i>
			Email your Inquiry
		</a>
	</div>
</div>


<?php
$this->endWidget();
}	// end debug mode
?>