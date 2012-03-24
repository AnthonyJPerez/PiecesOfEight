<?php
	/* product/create view */

?>

<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'product-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($_Product); ?>

		<div class="row">
		<?php echo $form->labelEx($_Product,'name'); ?>
		<?php echo $form->textField($_Product, 'name', array('maxlength' => 255)); ?>
		<?php echo $form->error($_Product,'name'); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($_Product,'price'); ?>
		<?php echo $form->textField($_Product, 'price', array('maxlength' => 6)); ?>
		<?php echo $form->error($_Product,'price'); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($_Product,'description'); ?>
		<?php echo $form->textArea($_Product, 'description'); ?>
		<?php echo $form->error($_Product,'description'); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($_Product,'care_information'); ?>
		<?php echo $form->textArea($_Product, 'care_information'); ?>
		<?php echo $form->error($_Product,'care_information'); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($_Product,'category_id'); ?>
		<?php echo $form->dropDownList($_Product, 'category_id', GxHtml::listDataEx(Category::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($_Product,'category_id'); ?>
		</div><!-- row -->


		<?php
		// Images
		$this->widget('CMultiFileUpload', array(
                'name' => 'images',
                'accept' => 'jpeg|jpg|gif|png', // useful for verifying files
                'duplicate' => 'Duplicate file!', // useful, i think
                'denied' => 'Invalid file type', // useful, i think
            ));
            ?>



		<!-- Images -->
		<!--
		<label><?php echo GxHtml::encode($_Product->getRelationLabel('images')); ?></label>
		<div class="row" id="duplicate_image">
			<label><?php echo GxHtml::encode($_Image->getRelationLabel('url')); ?></label>
			<?php echo $form->fileField($_Product, 'p8Images'); ?>
			<span>
				<span id="add_button_image"><a href="">[+]</a></span>
				<span id="remove_button_image"><a href="">[-]</a></span>
			</span>
		</div>
		-->
		
		
		
		
		<!-- Sizes -->
 		<div class="row">
			<label><?php echo GxHtml::encode($_Product->getRelationLabel('p8Sizes')); ?></label>
        		<?php echo $form->checkBoxList($_Product, 'p8Sizes', GxHtml::encodeEx(GxHtml::listDataEx(Size::model()->findAllAttributes(null, true)), false, true)); ?>
		</div>
		
		
		
		<div class="row">
		<?php echo $form->labelEx($_Product,'size_chart'); ?>
		<?php echo $form->textArea($_Product, 'size_chart'); ?>
		<?php echo $form->error($_Product,'size_chart'); ?>
		</div><!-- row -->
		
		
		
		<!-- Tags -->
		<label><?php echo GxHtml::encode($_Product->getRelationLabel('p8Tags')); ?></label>
		<div class="row">
			<?php echo $form->checkBoxList($_Product, 'p8Tags', GxHtml::encodeEx(GxHtml::listDataEx(Tag::model()->findAllAttributes(null, true)), false, true),
				array('labelOptions'=>array('checked'))); ?>
			
		</div>
		

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->