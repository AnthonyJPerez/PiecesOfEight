<?php
	$this->pageTitle = "Newsletter | " . $this->pageTitle;
	
	
	
	$this->pageCanonical = Yii::app()->request->hostInfo . $this->createUrl('site/newsletter');


	Yii::app()->clientScript->registerCss(
		'newsletter-form-style',
		'
		#newsletter-form
		{

		}
		
		#newsletter-form .row
		{
			position: relative;
			clear: both;
			margin: .75em;
			min-height:2em;
		}
		
			#newsletter-form .row label
			{
				display: inline-block;
				width: 140px;
				text-align: right;
				margin-right: 0.5em;
				vertical-align: top;
			}
			
			#newsletter-form .row input, #contact-form .row textarea
			{
				display: inline-block;
				padding: 4px 2px;
				width: 300px;
			}
			
			#newsletter-form .row textarea
			{
				width: 450px;
			}
			
			#newsletter-form .row > div
			{
				display: inline-block;
			}
			
			#newsletter-form .row > div > a
			{
				display: block;
			}
			
			#newsletter-form .errorMessage
			{
				vertical-align: top;
				display: block;
				width: 250px;
				margin-left: 0.5em;
			}
			
			#newsletter-form .hint
			{
				font-size: 10pt;
				width: 200px;
				display: inline-block;
				margin-left: 1em;
			}
			
			#newsletter-form .buttons
			{
				width: 50%;
				margin: 0 auto;
			}
			
			#newsletter-form .buttons > input
			{
				width: 100px;
				
			}
			
		',
		'screen'
	);
?>

<h1>Newsletter</h1>

<?php if(Yii::app()->user->hasFlash('newsletter')): ?>

<h2>Ahoy Mateys!</h2>
<p>
	Thank you for subscribing to our newsletter! You will now receive special offers, 
	discounts, and product updates from Pieces Of Eight Costumes.
</p>
<p>
	If you have any questions or comments, feel free to contact us. 
</p>
<p>
	<i>Aye, good luck in findin’ yer treasure,</i><br />
	Pieces Of Eight Costumes By Sue LLC 
</p>

<?php else: ?>

<p itemscope itemtype="http://schema.org/Organization">
Sign up for our newsletter to receive special offers, discounts, and product updates from <span itemprop="name">Pieces of Eight Costumes</span>!
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'newsletter-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'confirmEmail'); ?>
		<?php echo $form->textField($model,'confirmEmail'); ?>
		<?php echo $form->error($model,'confirmEmail'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode', array('class'=>'required')); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Subscribe'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>