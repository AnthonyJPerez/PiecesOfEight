<?php
	/* product/create view */


	Yii::app()->clientScript->registerCss(
		'product-custom-form-style',
		'
			#product_list, #selected_products
			{
				width: 675px
			}
			
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
			
			.mb-panel {
			    opacity: 0.75;
			    filter: alpha(opacity=75);   
			}
			.mb-panel.current {
			    opacity: 1;
			    filter: alpha(opacity=100);
			}
			
			#product_selector
			{
				border-color: red;
				width: 100%;
				height: 250px;
				overflow: auto;
			}
			
			#product_selector li
			{
				float: left;
			}
			
			
			.instructions 
			{
				font-size: 10pt;
			}
			
			
			
			
			
			
			
			
			
			#custom_product_array
			{
				
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

<h1>Custom Order Page</h1>
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

<div id="custom_product_inquiry_form">

	<!-- Custom products will go here -->
	<div id='custom_product_array'>
		
	</div>
	
	
	<button class='create_product'>Customize an Item</button>
	
	
	<div id="create_product_wizard">
		<!-- Show all products -->
		<div id='product_selector'>
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
						echo "<button class='add' data-productId='".$product->id."'>Add</button>";
						echo "</p>"
					?>
					</li>
				<?php
				}
			?>
			</ul>
		</div>		
		
		<!-- Is this the right product? -->
		<div id='product_verification'>
			<span class='product_name'></span>
			<img width="100px" href="" />
			<span>Is this the product you want to add?</span>
			<button id="button_verification_yes" data-productid="" data-baseurl="<?php echo Yii::app()->baseUrl; ?>">Yes</button>
			<button id="button_verification_no">No</button>
		</div>		
		
		<!-- Grab details of this product -->
		<div id='product_details'>
			<button class='add_product' >Add Product</button>
			<div id="product_details_container">
			
			</div>
		</div>
	</div>
	
	
	<!-- Grab user info -->
	<div id='user_details'>
		<fieldset>
			<legend>User Information</legend>
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
				// ...
				
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
		</fieldset>
	</div>
	
	
	<!-- Review the inquiry -->
	<div id="review_inquiry">
	
	</div>
	
	
	<div id='submit'>
	<?php
		echo GxHtml::submitButton(Yii::t('app', 'Email your Inquiry'));
	?>
	</div>
	
</div>

<?php
$this->endWidget();
}	// end debug mode
?>