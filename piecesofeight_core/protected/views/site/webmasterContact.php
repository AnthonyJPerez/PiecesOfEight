<?php
	$this->pageTitle = "Contact Our Webmaster | " . $this->pageTitle;
	$this->pageDescription = "Contact the Pieces of Eight Costumes Webmaster by email if you have any questions or comments about the
	site, or you are experiencing any technical issues.";
	$this->pageKeywords = "contact, technical issues, contact the webmaster, email, email the webmaster";


	$this->pageCanonical = Yii::app()->request->hostInfo . $this->createUrl('site/webmasterContact');


	Yii::app()->clientScript->registerCss(
		'contact-form-style',
		'
		#contact-form
		{

		}
		
		#contact-form .row
		{
			position: relative;
			clear: both;
			margin: .75em;
			min-height:2em;
		}
		
			#contact-form .row label
			{
				display: inline-block;
				width: 140px;
				text-align: right;
				margin-right: 0.5em;
				vertical-align: top;
			}
			
			#contact-form .row input, #contact-form .row textarea
			{
				display: inline-block;
				padding: 4px 2px;
				width: 300px;
			}
			
			#contact-form .row textarea
			{
				width: 450px;
			}
			
			#contact-form .row > div
			{
				display: inline-block;
			}
			
			#contact-form .row > div > a
			{
				display: block;
			}
			
			#contact-form .errorMessage
			{
				vertical-align: top;
				display: block;
				width: 250px;
				margin-left: 0.5em;
			}
			
			#contact-form .hint
			{
				font-size: 10pt;
				width: 200px;
				display: inline-block;
				margin-left: 1em;
			}
			
			#contact-form .buttons
			{
				width: 50%;
				margin: 0 auto;
			}
			
			#contact-form .buttons > input
			{
				width: 100px;
				
			}
			
		',
		'screen'
	);


?>

<h1>Contact Our Webmaster</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p itemscope itemtype="http://schema.org/Organization">
If you have a question or comment about this site, email our webmaster at <span itemprop="email"><?php echo Yii::app()->params['webmasterEmail']; ?></span> by filling out the form below.
</p>

<div>
	If you are experiencing technical issues, please be sure to the following information in your email:
	<ul>
		<li>Internet Browser (and version)</li>
		<li>Description of the problem you are having</li>
		<li>A copy of the error message you received (if applicable)</li>
	</ul>
</div>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php
		$subject = "";
		$body = "";
	?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

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

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>12, 'cols'=>70)); ?>
		<?php echo $form->error($model,'body'); ?>
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
		<?php echo CHtml::submitButton('Send Email'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>