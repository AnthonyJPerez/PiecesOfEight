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
			
			
			.instructions 
			{
				font-size: 10pt;
			}
		',
		'screen'
	);
	
	
	// Include the jquery library
	Yii::app()->clientScript->registerCoreScript('jquery');
	
	
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
	
	
	
	//
	// Include the Slidorion script
	//
	// documentation: http://www.slidorion.com/
	//
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/transit/jquery.transit.min.js', 
		CClientScript::POS_HEAD
	);
	
	
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/slidorion/js/jquery.slidorion.js', 
		CClientScript::POS_HEAD
	);
	
	// Init Slidorion
	Yii::app()->clientScript->registerScript(
		'Slidorion_CustomProduct',
		"
			$('#slidorion').slidorion(
			{
				autoPlay: false,
				effect: 'fade',
				first: 1,
				speed: 50
			});
		",
		CClientScript::POS_READY
	);
	
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/js/slidorion/css/slidorion.css',
		'screen'
	);
	
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/js/slidorion/css/slidorion-style.css',
		'screen'
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
		
<h2>How to place your custom order:</h2>

<ol class='instructions'>
	<li>Choose the products you are interested in.</li>
	<li>Fill out the custom-order form below.</li>
	<li>Supply your email.</li>
	<li>Done! Your info will be emailed to us and, as soon as we can, we will let you know what fabrics we have available and give you a quote on your order.</li>
	<li>When you are ready, we will create a private listing with your custom order so you can purchase and we can start sewing!
</ol>


<div id="slidorion">
	<div id="slider">
		<div id="product_selection" class="slide">
			<span>Select your Items</span>
		</div>
		<div id="product_customization" class="slide">
			<span>Customize</span>
		</div>
		<div id="user_info" class="slide">
			<span>User Information</span>
		</div>
	</div>
	
	<div id="accordion">
		<div class="link-header">Choose Products</div>
		<div class="link-content">
			<div class="description">
				Choose the products you would like to customize.
			</div>
		</div>
		
		<div class="link-header">Customize</div>
		<div class="link-content">
			<div class="description">
				For each product, specify measurements and customizations such as colors, fabrics, etc..
			</div>
		</div>
		
		<div class="link-header">Email Us!</div>
		<div class="link-content">
			<div class="description">
				Email us!
			</div>
		</div>
	</div>
</div>


<div id='custom_product_container'>
	<br />
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
				echo "<button class='add'>Add</button>";
				echo "</p>"
			?>
			</li>
		<?php
		}
	?>
	</ul>
	
	<ul id='selected_products'>
	
	</ul>
</div>

<?php
}	// end debug mode
?>