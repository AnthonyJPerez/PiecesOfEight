<?php
	$this->pageTitle = "Lookbook | " . $this->pageTitle;
	$this->pageDescription = "Check out our latest pirate costume designs and outfits. ";
	
	$this->pageKeywords = "pirate clothes, pirate costumes, pirate costume designs, renaissance clothes, renaissance costumes, pirate outfits";
	
	
	// Include the fancybox script
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
	
	
	Yii::app()->clientScript->registerCss(
		'lookbook-style',
		'
			.lookbook-image
			{
				margin-left: 1em;
				
				-webkit-box-shadow: 5px 5px 5px #666;
				-moz-box-shadow: 5px 5px 5px #666;
				box-shadow:  5px 5px 5px #666;
			}
			}
			
			h1
			{
				text-shadow: 3px 3px 2px #bbb;
				color: #770000; 
			}
			
			h2
			{
				color: #770000; 
			}
			
		',
		'screen'
	);
	
	Yii::app()->clientScript->registerScript(
		'Fancybox_Lookbook',
		"
		
			$('a[rel=womens_gallery]').fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over'
			});
			
			$('a[rel=mens_gallery]').fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over'
			});
		",
		CClientScript::POS_READY
	);
?>

<h1>Lookbook</h1>

<h2>
	Women's Pirate Costume
</h2>
<div>
	<?php
	$imgLink = Yii::app()->request->baseUrl . '/images/lookbook/womens-pirate-costume-1.jpg';
	$img = CHtml::image(
		$imgLink,
		"Women's Pirate Costume",
		array('width'=>300, 'class'=>'lookbook-image')
	);
	echo "<a href='".$imgLink."' rel='womens_gallery'>".$img."</a>";
	
	
	$imgLink = Yii::app()->request->baseUrl . '/images/lookbook/womens-pirate-costume-2.jpg';
	$img = CHtml::image(
		$imgLink,
		"Women's Pirate Costume",
		array('width'=>300, 'class'=>'lookbook-image')
	);
	echo "<a href='".$imgLink."' rel='womens_gallery'>".$img."</a>";
	?>
</div>

<h2>
	Men's Pirate Costume
</h2>
<div>
	<?php
	$imgLink = Yii::app()->request->baseUrl . '/images/lookbook/mens-pirate-costume-1.jpg';
	$img = CHtml::image(
		$imgLink,
		"Men's Pirate Costume",
		array('width'=>300, 'class'=>'lookbook-image')
	);
	echo "<a href='".$imgLink."' rel='mens_gallery'>".$img."</a>";
	
	
	$imgLink = Yii::app()->request->baseUrl . '/images/lookbook/mens-pirate-costume-2.jpg';
	$img = CHtml::image(
		$imgLink,
		"Men's Pirate Costume",
		array('width'=>300, 'class'=>'lookbook-image')
	);
	echo "<a href='".$imgLink."' rel='mens_gallery'>".$img."</a>";
	?>
</div>
