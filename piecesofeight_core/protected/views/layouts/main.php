<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
		<meta name="description" content="Handmade Pirate Costumes and Renaissance Clothing. We specialize in creating the highest quality, 
			period-authentic clothes that are made to last. Custom orders are available on all of our products!" />
		
		<meta name="keywords" content="pirate costume, pirate clothes, child pirate costume, adult pirate costume, couples pirate costume, pirate costumes,
			halloween, party, caribbean pirate, pirate wench, pirate captain, pirate shirt, renaissance clothing, renaissance outfits, handmade clothes,
			halloween costumes, renaissance costumes, medieval clothing, medieval costumes, renaissance faire clothing, wench costumes, wench clothing" />
	
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->

		<link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
		
		<!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css" media="screen" /-->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout_centered.css" media="screen, projection" />
		
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
		<![endif]-->
	
	
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		
		<?php
		if (!defined('YII_DEBUG') || constant('YII_DEBUG') == false)
		{
		?>
			<!-- Google Analytics -->
			<script type="text/javascript">
			  var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', 'UA-30707808-1']);
			  _gaq.push(['_trackPageview']);
			
			  (function() {
			    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();
			
			</script>
		<?php
		}
		?>
	</head>
	
	<body>
		<div class="container" id="page">
			<div id="header">
				<div id="logo">
					<a href="<?php echo $this->createUrl('site/index'); ?>">
						<?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/logo3.png', 'Pieces of Eight Costumes by Sue LLC logo', array('width' => '150px', 'height' => '150px')); ?>
					</a>
					<!--div><?php echo CHtml::encode(Yii::app()->name); ?></div-->
				</div>
				
				
				<div id="top_left_nav">
					<?php $this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'Home', 		'url'=>array('/site/index')),
							array('label'=>'Feedback', 	'url'=>array('/site/comments')),
							array('label'=>'Events',	'url'=>array('/site/events')),
							),
					)); ?>
				</div>
				
				<?php
					if ( !isset(Yii::app()->session['products']) )
					{
						Yii::app()->session['products'] = array();			
					}					
					
					// count the number of products in the cart
					$product_cart_count = 0;
					foreach (Yii::app()->session['products'] as $pid=>$data)
					{
						$product_cart_count += $data['quantity'];
					}
				?>
				<div id="top_right_nav">
					<?php $this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'LookBook', 	'url'=>$this->createUrl('product/lookbook')),
							array('label'=>'Custom Orders', 'url'=>$this->createUrl('product/custom')),
							array('label'=> ($product_cart_count>0) ? 'Cart ('.$product_cart_count.')' : 'Cart', 'url'=>array('/cart')),
							),
					)); ?>
				</div>
			</div>
			
		
			<div id="content_container">
				<div id="sidenav">
					<div class="search_bar">
						<?php
						/*
							$form = $this->beginWidget('CActiveForm', array('focus'=>'search_site'));
							echo $form->textField(null, 'search_site', array('size'=>15));
							echo CHtml::submitButton('go');
							$this->endWidget();
						*/
						?>
						<form>
							<input class="input" type="text" id="search_site" size=14 value="search products" />
							<input type="submit" id="search_submit" value="go" />
						</form>
					</div>
					
					<?php 
						$menu_items = array();
						array_push(
							$menu_items,
							array('label'=>'New Arrivals','url'=>$this->createUrl('product/list', array('category'=>'new')))
						);
						
						$_ProductCategories = Category::model()->findAll(
							array('order'=>'name ASC')
						);
						foreach ($_ProductCategories as $product_category)
						{
							array_push(
								$menu_items,
								array(
									'label' => $product_category->name,
									'url' => $this->createUrl(
										'product/list',
										array('category' => strtolower($product_category->name))
									)
								)
							);
						}
						
						array_push(
							$menu_items,
							array('label'=>'View All', 'url'=>$this->createUrl('product/list'))
						);
							
							
						$this->widget('zii.widgets.CMenu',array(
							'items'=>$menu_items
						)); 
					
					/*
					$this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'New Arrivals','url'=>$this->createUrl('product/list', array('category'=>'new'))),
							array('label'=>'Accessories', 'url'=>$this->createUrl('product/list', array('category'=>'accessories'))),
							array('label'=>'Blouses', 	'url'=>$this->createUrl('product/list', array('category'=>'blouses'))),
							array('label'=>'Capes', 	'url'=>$this->createUrl('product/list', array('category'=>'capes'))),
							array('label'=>'Coats', 	'url'=>$this->createUrl('product/list', array('category'=>'coats'))),
							array('label'=>'Dresses',	'url'=>$this->createUrl('product/list', array('category'=>'dresses'))),
							array('label'=>'Miscellaneous','url'=>$this->createUrl('product/list', array('category'=>'miscellaneous'))),
							array('label'=>'Pants', 	'url'=>$this->createUrl('product/list', array('category'=>'pants'))),
							array('label'=>'Skirts', 	'url'=>$this->createUrl('product/list', array('category'=>'skirts'))),
							array('label'=>'Shirts', 	'url'=>$this->createUrl('product/list', array('category'=>'shirts'))),
							array('label'=>'Tabards', 	'url'=>$this->createUrl('product/list', array('category'=>'tabards'))),
							array('label'=>'Vests', 	'url'=>$this->createUrl('product/list', array('category'=>'vests'))),
							array('label'=>'View All',	'url'=>$this->createUrl('product/list')),
							),
					)); 
					*/
					?>
				</div>
			
				<?php echo $content; ?>
				
				<div id="social_media_buttons" class="horizontal_menu">
					<div>Visit us on <a href="https://www.facebook.com/PiecesOf8Costumes" target="_blank">Facebook</a> and <a href="https://www.etsy.com/shop/PiecesOf8Costumes" target="_blank">Etsy</a>!</div>
					<ul>
						<li>
						<?php
							echo CHtml::link(
								CHtml::image(Yii::app()->request->baseUrl.'/images/facebook.png', 'Visit us on Facebook!', array('class'=>'')),
								"https://www.facebook.com/PiecesOf8Costumes",
								array('target'=>'_blank')
							);
						?>
						</li>
						
						<li>
						<?php
							echo CHtml::link(
								CHtml::image(Yii::app()->request->baseUrl.'/images/etsy.png', 'Visit our Etsy Shop!', array('class'=>'etsy')),
								"https://www.etsy.com/shop/PiecesOf8Costumes",
								array('target'=>'_blank')
							);
						?>
						</li>
					</ul>
				</div>
			</div>
		
		
		
		
			<div id="footer">
				<div> <?php echo CHtml::link('Contact Us', $this->createUrl('site/contact')); ?> </div>
				<div>	<?php echo CHtml::link('Terms of Service', $this->createUrl('site/page', array('view'=>'tos'))); ?> </div>
				<div>
					<span>Copyright &copy; <?php echo date('Y'); ?> by Peices Of Eight Costumes by Sue LLC.</span>
					<br />
					<span>All Rights Reserved.</span>
				</div>
				<div>
					Website by <a href="mailto:AnthonyJPerez@comcast.net?Subject=PiecesOfEightCostumes.net%20Site%20Inquiry">Anthony J. Perez</a>
				</div>
			</div>
		</div>
	</body>
</html>
