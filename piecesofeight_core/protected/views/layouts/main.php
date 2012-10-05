<!DOCTYPE html>
<!-- DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<!-- SEO Meta tags -->
		<!-- Safe-Surf metatag -->
		<meta http-equiv="PICS-Label" content='(PICS-1.1 "http://www.classify.org/safesurf/" L gen true for "http://www.piecesofeightcostumes.com/" r (SS~~000 1))' />
		<meta name="netinsert" content="0.0.1.12.10.1" />
		<meta name="alexaVerifyID" content="RwEeuoatshINXtnwr0m4KkjecQs" />
		
		<!-- google webmasters verification -->
		<meta name="google-site-verification" content="x2mCPZ9Lo7NYTPnLOccXUt0FO3hgd85tB4fem9qIeMI" />
		
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fonts/gothic-ultra-ot/gothic-ultra-ot-webfont.css" media="screen, projection" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
		
		<?php
			$cssTag = "10042012";
			if ($this->pageCanonical !== null)
			{
				?>
				<link rel="canonical" href="<?php echo $this->pageCanonical; ?>" />
				<?
			}
		?>

		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		<meta http-equiv="Content-Language" Content="en" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="copyright" content="Copyright &copy;, <?php echo date('Y'); ?> Peices Of Eight Costumes by Sue LLC. All rights reserved." />
		<meta name="author" content="Pieces of Eight Costumes" />
		<meta name="Charset" content="UTF-8" />
		<meta name="Ditribution" content="Global" />
		<meta name="Rating" content="General" />
		<meta name="Robots" content="INDEX,FOLLOW" />
		<meta name="googlebot" content="index,follow" />
		<meta name="Revisit-after" content="14 Days" />
		<meta name="category" content="Costumes" />
		
		<!-- open graph -->
		<meta property="og:title" content="<?php echo CHtml::encode($this->pageTitle); ?>" />
		<meta property="og:description" content="<?php echo CHtml::encode($this->pageDescription); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="http://www.piecesofeightcostumes.com/" />
		<meta property="og:image" content="http://www.piecesofeightcostumes.com/images/pieces-of-eight-costumes-logo.png" />
		<meta property="og:site_name" content="Pieces of Eight Costumes" />
		<meta property="og:locale" content="en_US" />
		
		
		<meta name="keywords" content="<?php echo CHtml::encode($this->pageKeywords); ?>" />
		<meta name="description" content="<?php echo CHtml::encode($this->pageDescription); ?>" />
		
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout_centered.css?v=<?php echo $cssTag; ?>" media="screen, projection" />
		
		<!-- Fonts & Icons | Documentation: http://fortawesome.github.com/Font-Awesome/#all-icons -->
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fonts/font-awesome/css/font-awesome.css?v=<?php echo $cssTag; ?>" media="screen, projection" />
		
		<!--[if lt IE 8]>
			<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css?v=<?php echo $cssTag; ?>" media="screen, projection" />
			<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/fonts/font-awesome/css/font-awesome-ie7.css?v=<?php echo $cssTag; ?>" media="screen, projection" />
		<![endif]-->
	
	
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		
		<?php
			// Custom form javascript:
			Yii::app()->clientScript->registerScript(
				'smoothscroll_Template',
				"
					if (navigator.appVersion.indexOf('Win') >= 0) {
						if (navigator.userAgent.indexOf('Chrome') >= 0) {
							// Load SmoothScroll
							(function() {
								var sstag = document.createElement('script'); sstag.type = 'text/javascript'; sstag.async = true;
								sstag.src = '".Yii::app()->request->baseUrl."/js/smoothscroll/smoothscroll.js';
								var s = document.getElementsByTagName('script')[0];
								s.parentNode.insertBefore(sstag, s);
							})();
						}
					}
				",
				CClientScript::POS_READY
			);
		?>
		
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
	<?php
		// Site speed optimization:
		flush();
	?>
	<body>
		<div class="container" id="page">
			<div id="header">
				<div id="logo">
					<a href="<?php echo $this->createUrl('site/index'); ?>">
						<?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/pieces-of-eight-costumes-logo.png', 'Pieces of Eight Costumes by Sue LLC logo', array('width' => '150px', 'height' => '150px')); ?>
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
					<?php 
						$cart = '<i class="icon-shopping-cart"></i> Cart';
						$this->widget('zii.widgets.CMenu',array(
						'encodeLabel' => false,
						'items'=>array(
							array('label'=>'LookBook', 	'url'=>$this->createUrl('product/lookbook')),
							array('label'=>'Custom Orders', 'url'=>$this->createUrl('product/custom')),
							array('label'=> ($product_cart_count>0) ? $cart.' ('.$product_cart_count.')' : $cart, 'url'=>array('/cart')),
							),
						//'lastItemCssClass' => 'icon-shopping-cart'
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

						// If Admin, show the admin link
						$isAdmin = !Yii::app()->user->isGuest;
						if ($isAdmin)
						{
							array_push(
								$menu_items,
								array(
									'label' => 'Admin Home', 
									'url'=>$this->createUrl('admin/index')
								)
							);
						}

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
							'items'=>$menu_items,
							'activateItems' => true,
							'activeCssClass' => 'active_menu_item',
							'activateParents' => true,
							'firstItemCssClass' => ($isAdmin) ? 'linkcolor_red' : null
						)); 
					?>
				</div>

				<!-- Halloween-specific Note -->
				<?php
				$c = Yii::app()->getController();
				if ($c->getId() == 'product' || $c->getId() == 'cart')
				{
				?>
				<span class="halloween_notice">
					Sorry, we are completely booked for Halloween orders. Any purchase 
					made after October 3rd cannot be guaranteed to arrive in time for 
					Halloween. 
				</span>
				<?php
				}
				?>
				<!-- End Halloween note -->
			
				<?php echo $content; ?>
				
				<div id="social_media_buttons" class="horizontal_menu">
					<div>Visit us on <a href="https://www.facebook.com/PiecesOf8Costumes" rel="nofollow" target="_blank">Facebook</a> and <a href="https://www.etsy.com/shop/PiecesOf8Costumes" target="_blank" rel="nofollow">Etsy</a>!</div>
					<ul>
						<li>
						<?php
							echo CHtml::link(
								CHtml::image(Yii::app()->request->baseUrl.'/images/pinterest.png', 'Visit our Pinterest Board!', array('class'=>'etsy')),
								"http://pinterest.com/pieceof8costume/",
								array(
									'target'=>'_blank',
									'rel' => "nofollow"
								)
							);
						?>
						</li>
						
						<li>
						<?php
							echo CHtml::link(
								CHtml::image(Yii::app()->request->baseUrl.'/images/facebook.png', 'Visit us on Facebook!', array('class'=>'facebook')),
								"https://www.facebook.com/PiecesOf8Costumes",
								array(
									'target'=>'_blank',
									'rel' => "nofollow"
								)
							);
						?>
						</li>
						
						<li>
						<?php
							echo CHtml::link(
								CHtml::image(Yii::app()->request->baseUrl.'/images/etsy.png', 'Visit our Etsy Shop!', array('class'=>'etsy')),
								"https://www.etsy.com/shop/PiecesOf8Costumes",
								array(
									'target'=>'_blank',
									'rel' => "nofollow"
								)
							);
						?>
						</li>
					</ul>
				</div>
			</div>
		
		
		
		
			<div id="footer">
				<div class="footer_menu_container">
					<div>
						<span>Help</span>
						<ul>
							<li><?php echo CHtml::link('FAQ', $this->createUrl('site/page', array('view'=>'faq')), array('title'=>'Frequently Asked Questions')); ?></li>
							<li><?php echo CHtml::link('Size Chart', Yii::app()->baseUrl.'/images/Size-Chart.png', array('title'=>'Pieces of Eight Costumes Size Chart', 'target'=>'_BLANK', 'onclick' => "window.open('".$this->createAbsoluteUrl('site/SizeChart')."','popup','width=820,height=1360,scrollbars=yes,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0'); return false")); ?>
								</li>
							<li><?php echo CHtml::link('Site Feedback', $this->createUrl('site/webmasterContact'), array('title'=>'Product Comments and Feedback')); ?></li>
						</ul>
					</div>
					<div>
						<span>Follow Us</span>
						<ul>
							<li><?php echo CHtml::link('Facebook', "https://www.facebook.com/PiecesOf8Costumes", array('target'=>'_BLANK', 'title'=>'Pieces of Eight Costumes Facebook Page')); ?></li>
							<li><?php echo CHtml::link('Pinterest', "http://pinterest.com/pieceof8costume/", array('target'=>'_BLANK', 'title'=>'Pieces of Eight Costumes Pinterest Board')); ?></li>
							<li><?php echo CHtml::link('Google+', "https://plus.google.com/107715338617466620653", array('target'=>'_BLANK', 'title'=>'Pieces of Eight Costumes Google+ Page')); ?></li>
						</ul>
					</div>
					<div>
						<span>About Us</span>
						<ul>
							<li><?php echo CHtml::link('About Us', $this->createUrl('site/page', array('view'=>'about')), array('title'=>'About Susan Perez, Owner of Pieces of Eight Costumes')); ?></li>
							<li><?php echo CHtml::link('Contact Us', $this->createUrl('site/contact'), array('title'=>'Contact Pieces of Eight Costumes')); ?></li>
							<li><?php echo CHtml::link('Etsy Shop', "https://www.etsy.com/shop/PiecesOf8Costumes", array('target'=>'_BLANK', 'title'=>'Pieces of Eight Costumes Etsy Shop')); ?></li>
						</ul>
					</div>
					<div>
						<span>Site Info</span>
						<ul>
							<li><?php echo CHtml::link('Terms & Conditions', $this->createUrl('site/page', array('view'=>'tos')), array('title'=>'Pieces of Eight Costumes Terms and Conditions')); ?></li>
							<li><?php echo CHtml::link('Privacy Policy', $this->createUrl('site/page', array('view'=>'tos', '#'=>'Privacy')), array('title'=>'Pieces of Eight Costumes Privacy Policy')); ?></li>
							<li><?php echo CHtml::link('Our Friends', $this->createUrl('site/page', array('view'=>'friends')), array('title'=>'Friends of Pieces of Eight Costumes')); ?></li>
						</ul>
					</div>
				
					<div class='newsletter'>
						<span>Subscribe to our Newsletter to get product updates and discounts:</span>
						<?php
							$newsletterModel = new Newsletter('inline');
							$form = $this->beginWidget('CActiveForm', array(
								'id' => 'newsletter',
								'enableAjaxValidation'=>true,
								'action' => array('site/newsletterInline'),
								'clientOptions' => array(
									'validateOnSubmit' => true
								)
							));
							
							echo '<div class="row">';
								echo $form->textField($newsletterModel,'email', array('placeholder'=>'Your Email'));
								echo $form->error($newsletterModel,'email');
							echo '</div>';
							
							echo GxHtml::submitButton(Yii::t('app', 'Subscribe'));
							
							$this->endWidget();
						?>
					</div>
				</div>
				<span class="footer_details">
					<span>
						Website by <?php echo CHtml::link('Anthony J. Perez', $this->createUrl('site/webmasterContact'), array('title' => 'Email the Pieces of Eight Costumes Webmaster')); ?>
					</span>
					<span>
						<span>Copyright &copy; <?php echo date('Y'); ?>, Peices Of Eight Costumes by Sue LLC.</span>
					</span>
				</span>
			</div>
		</div>
	</body>
</html>
