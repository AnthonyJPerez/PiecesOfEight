<?php

	// Include the jquery library
	Yii::app()->clientScript->registerCoreScript('jquery');

	// Include the glDatePicker script
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/glDatePicker-v1.3/js/glDatePicker.min.js', 
		CClientScript::POS_HEAD
	);

	// Include the glDatePicker css file
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/js/glDatePicker-v1.3/css/default.css',
		'screen'
	);

	// Feedback_date_inseretd
	Yii::app()->clientScript->registerScript(
		'feedback_datepicker',
		'
			$("#Feedback_date_inserted").glDatePicker(
			{
				cssName: "default",
				startDate: -1,
				endDate: -1,
				selectedDate: -1,
				showNextPrev: true,
				allowOld: true,
				showAlways: false,
				position: "inherit",
				onChange: null
			}
			);
		',
		CClientScript::POS_READY
	);


	//
	// Include the select2 selectbox jquery plugin (http://ivaynberg.github.com/select2/)
	//
	
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/select2/select2.min.js', 
		CClientScript::POS_HEAD
	);
	
	// Include the select2 css file
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/js/select2/select2.css',
		'screen'
	);


	// Make a list of <img> tags for each product
	$img_list = "";
	foreach ($_Products as $product)
	{
		$img_list .= "'".$product->id."': \"<img width='50px' src='".Yii::app()->request->baseUrl . '/images/product-images/' . $product->getDefaultImage()->url."' />\",";
	}
	
	// Init select2
	Yii::app()->clientScript->registerScript(
		'Select2_Feedback',
		"
			function format(product)
			{
				if (!product.id) return product.text;
				var images = {
				".
					$img_list
				."
				};
				return images[product.id] + product.text;
			}

			$('#Feedback_web_location').select2();
			$('#Feedback_product_id').select2(
				{
					formatResult: format,
					formatSelection: format
				});
		",
		CClientScript::POS_READY
	);

	Yii::app()->clientScript->registerCss(
		'feedback-form-style',
		'
			.select2-container
			{
				width: 30% !important;
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
			> Insert Feedback
		</li>
	</ul>
</div>


<div>
<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'feedback-form',
	'enableAjaxValidation' => false
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($_Feedback); ?>

		<div class="row">
		<?php echo $form->labelEx($_Feedback,'comment'); ?>
		<?php echo $form->textArea($_Feedback, 'comment'); ?>
		<?php echo $form->error($_Feedback,'comment'); ?>
		</div><!-- row -->

		<div class="row">
		<?php echo $form->labelEx($_Feedback,'geo_location'); ?>
		<?php echo $form->textField($_Feedback, 'geo_location'); ?>
		<?php echo $form->error($_Feedback,'geo_location'); ?>
		</div><!-- row -->

		<div class="row">
		<?php echo $form->labelEx($_Feedback,'web_location'); ?>
		<?php echo GxHtml::activeDropDownList( $_Feedback,'web_location',$_Feedback->enumItem($_Feedback, 'web_location') ); ?>
		<?php echo $form->error($_Feedback,'web_location'); ?>
		</div><!-- row -->

		<div class="row">
		<?php echo $form->labelEx($_Feedback,'date_inserted'); ?>
		<?php echo $form->textField($_Feedback, 'date_inserted'); ?>
		<?php echo $form->error($_Feedback,'date_inserted'); ?>
		</div><!-- row -->

		<div class="row">
		<?php echo $form->labelEx($_Feedback,'product_id'); ?>
		<?php echo $form->dropDownList($_Feedback, 'product_id', GxHtml::listDataEx(Product::model()->findAllAttributes(null, true)), array('empty'=>'Select a Category')); ?>
		<?php echo $form->error($_Feedback,'product_id'); ?>
		</div><!-- row -->
		
		
		<!-- Tags -->
		<?php /*<div class="row">
			<label><?php echo GxHtml::encode($_Feedback->getRelationLabel('p8Tags')); ?></label>
			<div class="main_container">
				<span class="note">
					Check any appropriate tags:
				</span>
				<div class="tags">
					<?php 
						echo $form->checkBoxList($_Feedback, 'p8Tags', GxHtml::encodeEx(GxHtml::listDataEx(Tag::model()->findAllAttributes(null, true)), false, true),
							array('labelOptions'=>array('checked'))); 	
					?>
				</div>
			</div>
		</div>*/?>
		

<?php
	echo "<div class='row buttons'>";
		echo GxHtml::submitButton(Yii::t('app', 'Insert Feedback'));
	echo "</div>";
$this->endWidget();
?>
</div><!-- form -->