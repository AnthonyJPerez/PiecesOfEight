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
	
?>

<h1>Custom Order Page</h1>
<p>
	This page is currently in development. For custom order inquiries, check out our <?php echo CHtml::link('Contact Page', $this->createUrl('site/contact')); ?>
</p>


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
					Yii::app()->request->baseUrl . '/images/product-images/' . $product->defaultImage->url,
					$product->name,
					array('width'=>150)
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
