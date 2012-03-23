<?php
	/* product/create view */
	
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/dynamic-form.jquery.js', 
		CClientScript::POS_HEAD
	);
	
	
	Yii::app()->clientScript->registerScript(
		'duplicate-form-script',
		'
			$("#duplicate_image").dynamicForm("#add_button_image", "#remove_button_image", {limit: 30});
			$("#duplicate_size").dynamicForm("#add_button_size", "#remove_button_size", {limit: 30});
			$("#duplicate_tag").dynamicForm("#add_button_tag", "#remove_button_tag", {limit: 30});

		',
		CClientScript::POS_READY
	);
?>

<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'product-form',
	'enableAjaxValidation' => false,
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
		<?php echo $form->labelEx($_Product,'category_id'); ?>
		<?php echo $form->dropDownList($_Product, 'category_id', GxHtml::listDataEx(Category::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($_Product,'category_id'); ?>
		</div><!-- row -->




		<!-- Images -->
		<label><?php echo GxHtml::encode($_Product->getRelationLabel('images')); ?></label>
		<div class="row">
			<label><?php echo GxHtml::encode($_Image->getRelationLabel('url')); ?></label>
			<?php
				echo $form->fileField($_Product, 'image', array('id'=>"duplicate_image"));
			?>
			<span>
				<span id="add_button_image"><a href="">[+]</a></span>
				<span id="remove_button_image"><a href="">[-]</a></span>
			</span>
		</div>
		
		
		
		
		<!-- Sizes -->
		<label><?php echo GxHtml::encode($_Product->getRelationLabel('p8Sizes')); ?></label>
		<div class="row">
			<?php
				$_sizes = Size::model()->findAllAttributes(null, true);
				foreach ($_sizes as $_size)
				{
					echo "<div>";
					echo "<input id='Size_size_$x' type='checkbox' name='Size[size][]' value='".$_size->id."'>";
					echo "<label for='Size_size_$x'>".$_size->size."</label>";
					echo "&nbsp;&nbsp;";
					echo "<label for='SizeProduct_size_chart_$x'>".GxHtml::encode($_SizeProduct->getRelationLabel('size_chart'))."</label>";
					echo "<textarea id='SizeProduct_size_chart_$x' name='SizeProduct[size_chart][]'></textarea>";
					echo "</div>";
				}
			?>
		</div>
		
		
		
		
		<!-- Tags -->
		<label><?php echo GxHtml::encode($_Product->getRelationLabel('p8Tags')); ?></label>
		<div class="row">
			<?php echo $form->checkBoxList($_Tag, 'name', GxHtml::listDataEx(Tag::model()->findAllAttributes(null, true)),
				array('labelOptions'=>array('checked'))); ?>
			
		</div>
		

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->