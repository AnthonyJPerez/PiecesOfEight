<?php 
	$this->pageDescription = "Pirate Costumes - find handmade pirate costumes perfect for renaissance faires, halloween parties and even a romantic pirate wedding.
	With years of experience, our handmade costumes are unique, and guaranteed to make you the life of the party! We have pirate costumes such as
	Captain Jack Sparrow costumes, Snow White and the Huntsman costume, halloween costume, renaissance costumes, ladies pirate costumes, mens pirate costumes, ladies pirate coats, mens pirate coats, ladies pirate pants
	mens pirate pants, and childrens pirate costumes. Place your order now for a beautiful, unique pirate costume today!";
	
	$this->pageKeywords = "pirate costume, mens pirate costume, ladies pirate costume, mens pirate coat, ladies pirate coat, mens pirate shirt, mens pirate pants, renaissance dress
	snow white huntsman costume, captain jack sparrow costume, pirate shirt, pirate pants, renaissance faire costume, pirate wedding, halloween costume";
	
	
	$this->pageCanonical = Yii::app()->request->hostInfo . $this->createUrl('site/index');
	
	
	// Include the jquery library
	Yii::app()->clientScript->registerCoreScript('jquery');

	// Include the slidejs gallery
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/orbit/jquery.orbit-1.2.3.min.js', 
		CClientScript::POS_HEAD
	);
	
	// Include the slidejs gallery css file
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/js/orbit/orbit-1.2.3.css',
		'screen'
	);
	
	Yii::app()->clientScript->registerScript(
		'Orbit_Gallery',
		'
			$("#orbit_gallery").orbit({
				animation: "fade",
				advanceSpeed: 6000,
				pauseOnHover: false,
				startClockOnMouseOut: true,
				directionalNav: false,
				bullets: true
				
			});
		',
		CClientScript::POS_READY
	);
	
	Yii::app()->clientScript->registerCss(
		'col_3_menu_style',
		'
			#orbit_gallery_container
			{
				left: 1.6em;
				margin: 0 auto;
				width: 100%;
				text-align: center;
			}
			
			
			.orbit-wrapper
			{
				margin: 0 auto;
			}
			
			#content
			{
				padding-right: 0;
			}
			
			#col_3_menu
			{
				width: 100%; 
				margin: 0.5em auto;
				margin-top: 3em;
				
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
					text-shadow: 3px 3px 2px #bbb;
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
				
				.replace_text
				{
					text-indent: 100%;
					white-space: nowrap;
					overflow: hidden;
					padding: 0;
					margin: 0;
					font-size: 10pt;
					height: 10px;
				}
			
			#col_3_menu h2
			{
				font-size: 32pt !important;
			}
		',
		'screen'
	);	
?>

<h1 class='replace_text'>
	Handmade Pirate Costumes and Renaissance Clothing
</h1>

<?php
if ($isAdmin)
{
?>
	<div class="admin_link">
		<?php 
		echo CHtml::link(
			'Edit the Gallery', 
			$this->createUrl('product/gallery'), 
			array()
		); 
		?>
	</div>
<?php
}
?>

<!-- Gallery -->
<div id="orbit_gallery_container">
	<div id="orbit_gallery">
		<?php
			$images = Gallery::model()->findAll();
			foreach ($images as $image)
			{
				$imgTag = CHtml::image(
					Yii::app()->request->baseUrl . '/images/gallery/' . $image->url,
					$image->alt_description,
					array(
						'width' => 700,
						'height' => 525
					)
				);
				
				echo CHtml::link(
					$imgTag,
					$this->createUrl('product/list'),
					array(
						'title' => ''
					)
				);
			}
		?>
	</div>
</div>



<div id="col_3_menu">
	<div class="row">
		<h2 class="title">Welcome!</h2>
		<h2 class="title">About</h2>
		<h2 class="title">Questions?</h2>
	</div>
	<div class="row">
		<p class="menu_item">
			Please feel free to browse our collection of beautiful, period-authentic costumes.
			
		</p>
		<p class="menu_item">
			Pieces of Eight Costumes provides quality, handmade pirate / renaissance clothing and accessories that are washable or dry cleanable. For more information, visit our <a href="<?php echo $this->createUrl('site/page', array('view'=>'about')); ?>" rel="author">About Us</a> page.
		</p>
		<p class="menu_item">
			If you have any questions, or you would like to place a custom order, please feel free to <a href="<?php echo $this->createUrl('site/contact'); ?>">Contact Us</a>.
		</p>
	</div>
</div>












		
	
	
	
	