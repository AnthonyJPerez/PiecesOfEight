<?php 
	// Include the jquery library
	Yii::app()->clientScript->registerCoreScript('jquery');

	// Include the slidejs gallery
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/slides.jquery.js', 
		CClientScript::POS_HEAD
	);
	
	// Include the slidejs gallery css file
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/css/slidejs_gallery.css',
		'screen'
	);
	
	Yii::app()->clientScript->registerScript(
		'SlideJS_Gallery',
		'
		$("#slides").slides(
		{
			preload: true,
			preloadImage: "' . Yii::app()->request->baseUrl . '/images/test/loading.gif",
			play: 3000,
			pause: 1000,
			hoverPause: true,
			randomize: true
		});
		',
		CClientScript::POS_READY
	);
	
	Yii::app()->clientScript->registerCss(
		'col_3_menu_style',
		'
			#col_3_menu
			{
				width: 100%; 
				margin: 0.5em auto;
				
				display: table;
			}
			
				#col_3_menu .row
				{
					display: table-row;
				}
			
				#col_3_menu .title
				{			
					width: 33%;
					display: table-cell;
					font-size: 22pt;
					text-align: center;
					color: #770000; 
					/*text-shadow: 1px 2px 2px #fff;*/
				}
				
				#col_3_menu .menu_item
				{
					width: 33%;
					display: table-cell;
					border-spacing: 1em;
					padding: 2em;
					padding-top: 1em;
					border-left: 4px solid #770000;
					font-size: 11pt;
					/*text-shadow: 1px 2px 2px #fff;*/
				}
				
					#col_3_menu .menu_item:first-child
					{
						border-left: none;
					}
		',
		'screen'
	);
	
	$this->pageTitle = "Home - " . Yii::app()->name;
?>

<!-- Gallery -->
<div id="slidejs_container">
	<div id="slides">
		<div class="slides_container">
			<a href="#" title="" target=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/gallery/product_1.jpg" width="600" height="270"  /></a>
			<a href="#" title="" target=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/gallery/product_2.jpg" width="600" height="270"  /></a>
			<a href="#" title="" target=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/gallery/product_3.jpg" width="600" height="270"  /></a>
			<a href="#" title="" target=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/gallery/product_4.jpg" width="600" height="270"  /></a>
			<a href="#" title="" target=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/gallery/product_5.jpg" width="600" height="270"  /></a>
			<a href="#" title="" target=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/gallery/product_6.jpg" width="600" height="270"  /></a>
			<a href="#" title="" target=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/gallery/product_7.jpg" width="600" height="270"  /></a>
			<a href="#" title="" target=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/gallery/product_8.jpg" width="600" height="270"  /></a>			
		</div>
		<a href="#" class="prev"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/test/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
		<a href="#" class="next"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/test/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
	</div>
</div>

<div id="col_3_menu">
	<div class="row">
		<div class="title">Welcome!</div>
		<div class="title">About</div>
		<div class="title">Questions?</div>
	</div>
	<div class="row">
		<p class="menu_item">
			Please feel free to browse our collection of beautiful, period-authentic costumes.
			
		</p>
		<p class="menu_item">
			Pieces of Eight Costumes provides quality, handmade pirate / renaissance clothing and accessories that are washable or dry cleanable. For more information, visit our <a href="<?php echo $this->createUrl('site/page', array('view'=>'about')) ?>">About Us</a> page.
		</p>
		<p class="menu_item">
			If you have any questions, or you would like to place a custom order, please feel free to <a href="<?php echo $this->createUrl('site/contact') ?>">Contact Us</a>.
		</p>
	</div>
</div>












		
	
	
	
	