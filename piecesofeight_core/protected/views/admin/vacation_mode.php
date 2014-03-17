
<?php
	Yii::app()->clientScript->registerCss(
		'vacation-mode-form-style',
		'
		#vacation-mode-form
		{

		}
		
		#vacation-mode-form .row
		{
			position: relative;
			clear: both;
			margin: .75em;
			min-height:2em;
		}
		
			#vacation-mode-form .row label
			{
				display: inline-block;
				width: 140px;
				text-align: right;
				margin-right: 0.5em;
				vertical-align: top;
			}
			
			#vacation-mode-form .row input, #vacation-mode-form .row textarea
			{
				display: inline-block;
				padding: 4px 2px;
				width: 300px;
			}
			
			#vacation-mode-form .row textarea
			{
				width: 355px;
			}
			
			#vacation-mode-form .row > div
			{
				display: inline-block;
			}
			
			#vacation-mode-form .row > div > a
			{
				display: block;
			}
			
			#vacation-mode-form .errorMessage
			{
				vertical-align: top;
				display: block;
				width: 250px;
				margin-left: 0.5em;
			}
			
			#vacation-mode-form .hint
			{
				font-size: 10pt;
				width: 200px;
				display: inline-block;
				margin-left: 1em;
			}
			
			#vacation-mode-form .buttons
			{
				width: 50%;
				margin: 0 auto;
			}
			
			#vacation-mode-form .buttons > input
			{
				//width: 300px;
				
			}
			
		',
		'screen'
	);
?>

<div id="breadcrumbs">
	<ul>
		<li>
			<?php echo CHtml::link(
					'Admin Home',
					$this->createUrl('admin/index')
				);
			?>
		</li>
		<li>
			> Set Vacation Mode
		</li>
	</ul>
</div>


<div>
<br /><br /><br /><br /><br />
<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'vacation-mode-form',
	'enableAjaxValidation' => false
));
?>

	<?php echo $form->errorSummary($_Option); ?>

		<div class="row">
		<?php echo $form->labelEx($_Option,'enabled'); ?>
		<?php echo $form->checkBox($_Option, 'enabled'); ?>
		<?php echo $form->error($_Option,'enabled'); ?>
		</div><!-- row -->

		<div class="row">
		<?php echo $form->labelEx($_Option,'message'); ?>
		<?php echo $form->textArea($_Option, 'message', array('rows'=>6, 'cols'=>48)); ?>
		<?php echo $form->error($_Option,'message'); ?>
		</div><!-- row -->
		
		
		<!-- Tags -->
		<?php /*<div class="row">
			<label><?php echo GxHtml::encode($_Option->getRelationLabel('p8Tags')); ?></label>
			<div class="main_container">
				<span class="note">
					Check any appropriate tags:
				</span>
				<div class="tags">
					<?php 
						echo $form->checkBoxList($_Option, 'p8Tags', GxHtml::encodeEx(GxHtml::listDataEx(Tag::model()->findAllAttributes(null, true)), false, true),
							array('labelOptions'=>array('checked'))); 	
					?>
				</div>
			</div>
		</div>*/?>
		

<?php
	echo "<div class='row buttons'>";
		echo GxHtml::submitButton(Yii::t('app', 'Update Vacation Mode Settings'));
	echo "</div>";
$this->endWidget();
?>
</div><!-- form -->