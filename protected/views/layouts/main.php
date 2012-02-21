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
		<div class="container shadow_right" id="page">
			<div id="header">
				<div id="logo">
					<?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/logo.jpg', 'Pieces of Eight Costumes by Sue LLC logo', array('width' => '150px', 'height' => '150px')); ?>
					<div><?php echo CHtml::encode(Yii::app()->name); ?></div>
				</div>
				
				<div id="top_right_nav">
					<?php $this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'Shopping Bag (empty)', 	'url'=>array('/site/index')),
							array('label'=>'Checkout', 			'url'=>array('/site/comment')),
							),
					)); ?>
				</div>
				
				<div id="top_nav">
					<?php $this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'Home', 		'url'=>array('/site/index')),
							array('label'=>'Feedback', 	'url'=>array('/site/comment')),
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
						<?php/*
							$form = $this->beginWidget('CActiveForm', array('focus'=>'search_site'));
							echo $form->textField(null, 'search_site', array('size'=>15));
							echo CHtml::submitButton('go');
							$this->endWidget();
						*/?>
						<form>
							<input class="input" type="text" id="search_site" size=14 value="search products" />
							<input type="submit" id="search_submit" value="go" />
						</form>
					</div>
					
					<?php $this->widget('zii.widgets.CMenu',array(
						'items'=>array(
							array('label'=>'Accessories', 'url'=>array('/site/index')),
							array('label'=>'Blouses', 	'url'=>array('/site/comment')),
							array('label'=>'Capes', 	'url'=>array('/site/about')),
							array('label'=>'Coats', 	'url'=>array('/site/contact')),
							array('label'=>'Dresses',	'url'=>array('/site/index')),
							array('label'=>'Pants', 	'url'=>array('/site/comment')),
							array('label'=>'Skirts', 	'url'=>array('/site/about')),
							array('label'=>'Tabbards', 	'url'=>array('/site/contact')),
							array('label'=>'Vests', 	'url'=>array('/site/index')),
							),
					)); ?>
				</div>
			
				<?php echo $content; ?>
			</div>
			
		
			<div class="clear"></div>
		
		
			<div id="footer">
				Copyright &copy; <?php echo date('Y'); ?> by Peices Of Eight Costumes by Sue LLC.<br/>
				All Rights Reserved.<br/>
				<?php echo Yii::powered(); ?>
			</div>
		</div>
	</body>
</html>
