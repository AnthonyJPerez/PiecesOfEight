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
			hoverPause: true
		});
		',
		CClientScript::POS_READY
	);
	
	$this->pageTitle=Yii::app()->name;
?>

<!-- Gallery -->
<div id="container">
	<div id="example">
		<div id="slides">
			<div class="slides_container">
				<a href="" title="145.365 - Happy Bokeh Thursday! | Flickr - Photo Sharing!" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/test/slide-1.jpg" width="570" height="270" alt="Slide 1"></a>
				<a href="" title="Taxi | Flickr - Photo Sharing!" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/test/slide-2.jpg" width="570" height="270" alt="Slide 2"></a>
				<a href="" title="Happy Bokeh raining Day | Flickr - Photo Sharing!" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/test/slide-3.jpg" width="570" height="270" alt="Slide 3"></a>
				<a href="" title="We Eat Light | Flickr - Photo Sharing!" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/test/slide-4.jpg" width="570" height="270" alt="Slide 4"></a>
				<a href="" title="“I must go down to the sea again, to the lonely sea and the sky; and all I ask is a tall ship and a star to steer her by.” | Flickr - Photo Sharing!" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/test/slide-5.jpg" width="570" height="270" alt="Slide 5"></a>
				<a href="" title="twelve.inch | Flickr - Photo Sharing!" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/test/slide-6.jpg" width="570" height="270" alt="Slide 6"></a>
				<a href="" title="Save my love for loneliness | Flickr - Photo Sharing!" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/test/slide-7.jpg" width="570" height="270" alt="Slide 7"></a>
			</div>
			<a href="#" class="prev"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/test/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
			<a href="#" class="next"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/test/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
		</div>
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/test/example-frame.png" width="739" height="341" alt="Example Frame" id="frame">
	</div>
</div>

<?php
	Yii::app()->clientScript->registerCss(
		'col_3_menu_style',
		'
			#col_3_menu
			{
				width: 90%; 
				margin: 0 auto;
				
				display: table;
			}
			
				#col_3_menu .row
				{
					display: table-row;
				}
			
				#col_3_menu .title
				{			
					display: table-cell;
					font-size: 18pt;
					text-align: center;
					color: #770000; 
					text-shadow: 0px 2px 3px #670000;
				}
				
				#col_3_menu .menu_item
				{
					display: table-cell;
					border-spacing: 1em;
					padding: 2em;
					border-left: 4px solid darkred;
				}
				
					#col_3_menu .menu_item:first-child
					{
						border-left: none;
					}
		',
		'screen'
	);
?>


<div id="col_3_menu">
	<div class="row">
		<div class="title">Welcome</div>
		<div class="title">About</div>
		<div class="title">Questions?</div>
	</div>
	<div class="row">
		<div class="menu_item">
			Welcome to the website. Here is some placeholder text! What do you think?
		</div>
		
		<div class="menu_item">
			This is some descriptive text about our company. Right now, there's not much to say!
		</div>
		
		<div class="menu_item">
			If you have anything to ask, here will be some information that may help.
		</div>
	</div>
</div>










		
	
	
	
	