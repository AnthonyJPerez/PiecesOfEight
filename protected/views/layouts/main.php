<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
	
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout.css" media="screen" />
		
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
		<![endif]-->
	
	
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>
	
	<body>
		<div class="container" id="page">
			<div id="header">
				<div id="logo">
					<a href="<?php echo $this->createUrl('site/index'); ?>">
						<?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/logo2.png', 'Pieces of Eight Costumes by Sue LLC logo', array('width' => '150px', 'height' => '150px')); ?>
					</a>
					<div><?php echo CHtml::encode(Yii::app()->name); ?></div>
				</div>
				
				<div id="top_right_nav">
					<?php $this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'Shopping Bag (empty)', 	'url'=>array('/cart/index')),
							array('label'=>'Checkout', 			'url'=>array('/cart/checkout')),
							),
					)); ?>
				</div>
				
				<div id="top_nav">
					<?php $this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'Home', 		'url'=>array('/site/index')),
							array('label'=>'Feedback', 	'url'=>array('/site/comments')),
							array('label'=>'About', 	'url'=>array('/site/about')),
							array('label'=>'Resources',	'url'=>array('/site/resources')),
							array('label'=>'Contact Us', 	'url'=>array('/site/contact')),
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
					
					<?php $this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'New Arrivals','url'=>$this->createUrl('product/view', array('category'=>'new'))),
							array('label'=>'Accessories', 'url'=>$this->createUrl('product/view', array('category'=>'accessories'))),
							array('label'=>'Blouses', 	'url'=>$this->createUrl('product/view', array('category'=>'blouses'))),
							array('label'=>'Capes', 	'url'=>$this->createUrl('product/view', array('category'=>'capes'))),
							array('label'=>'Coats', 	'url'=>$this->createUrl('product/view', array('category'=>'coats'))),
							array('label'=>'Dresses',	'url'=>$this->createUrl('product/view', array('category'=>'dresses'))),
							array('label'=>'Pants', 	'url'=>$this->createUrl('product/view', array('category'=>'pants'))),
							array('label'=>'Skirts', 	'url'=>$this->createUrl('product/view', array('category'=>'skirts'))),
							array('label'=>'Tabbards', 	'url'=>$this->createUrl('product/view', array('category'=>'tabbards'))),
							array('label'=>'Vests', 	'url'=>$this->createUrl('product/view', array('category'=>'vests'))),
							),
					)); ?>
				</div>
			
				<?php echo $content; ?>
			</div>
		
		
			<div id="footer">
				Copyright &copy; <?php echo date('Y'); ?> by Peices Of Eight Costumes by Sue LLC.<br/>
				All Rights Reserved.<br/>
				<?php echo Yii::powered(); ?>
			</div>
		</div>
	</body>
</html>
