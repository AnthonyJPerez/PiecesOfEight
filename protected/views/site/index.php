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



<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>


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


<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>










		
	
	
	
	