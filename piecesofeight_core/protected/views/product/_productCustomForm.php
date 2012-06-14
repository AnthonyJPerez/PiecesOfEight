<!--<fieldset>
<?php
	//echo CHtml::activeLabel($product, 'name');
	//echo CHtml::activeTextField($product, 'name', array('maxlength' => 4));
?>
</fieldset>-->

<?php
	$form = $this->beginWidget('GxActiveForm', array(
		'id' => 'custom-product-form-' . $form_id,
		'enableAjaxValidation' => true,
		'clientOptions' => array(
			'validateOnChange' => true,
			'validationUrl' => $this->createUrl('product/validateProduct')
		)
	));
	
	
	echo "<div class='row'>";
	echo $form->labelEx($product,'name');
	echo $form->textField($product, 'name', array('maxlength' => 255));
	echo $form->error($product,'name');
	echo "</div>";


	$this->endWidget();
?>