<?php
	/* product/create view */


	Yii::app()->clientScript->registerCss(
		'product-custom-form-style',
		'
		
		',
		'screen'
	);
	
	
	// Include the jquery library
	Yii::app()->clientScript->registerCoreScript('jquery');
	
	
	Yii::app()->clientScript->registerScript(
		'uploaded-item-event',
		'
			
		',
		CClientScript::POS_READY
	);
	
	
	// Include the fancybox script
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/fancybox/jquery.fancybox-1.3.4.pack.js', 
		CClientScript::POS_HEAD
	);
	
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/fancybox/jquery.easing-1.4.pack.js', 
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
		
			$('a[rel=img_gallery]').fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over'
			});
		",
		CClientScript::POS_READY
	);
?>

<div id='custom_product_container'>
	<div id='product_list'>
	<?php
		foreach ($_AllProducts as $product)
		{
		?>
			<div id='product_listing'>
			<?php
				echo CHtml::image(
					Yii::app()->request->baseUrl . '/images/product-images/' . $product->defaultImage->url,
					$product->name,
					array('width'=>75)
				);
			?>
			</div>
		<?php
		}
	?>
	</div>
</div>