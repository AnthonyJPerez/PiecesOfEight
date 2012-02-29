<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'product-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model, 'quantity', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'quantity'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model, 'price', array('maxlength' => 6)); ?>
		<?php echo $form->error($model,'price'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'date_inserted'); ?>
		<?php echo $form->textField($model, 'date_inserted'); ?>
		<?php echo $form->error($model,'date_inserted'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model, 'category_id', GxHtml::listDataEx(Category::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'category_id'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('p8Tags')); ?></label>
		<?php echo $form->checkBoxList($model, 'p8Tags', GxHtml::encodeEx(GxHtml::listDataEx(Tag::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->