<fieldset>
	<legend>Measurements</legend>
	<span class="hint">How to take measurements</span>
<?php
	// Measurements
	foreach ($product->p8Measurements as $measurement)
	{
		echo CHtml::label($measurement->name, '');
		echo CHtml::textField('measurement_'.$measurement->name, '', array('maxlength' => 4));
	}
?>
</fieldset>


<fieldset>
	<legend>Add-Ons & Customizations</legend>
<?php
	// Add-Ons
	echo CHtml::label('Select your Add-Ons (Optional)', '');
	//echo CHtml::activeCheckBoxList($product, 'p8Addons', CHtml::listData(Addon::model()->findAll(), 'id', 'name'));
	foreach ($product->p8Addons as $addon)
	{
		echo Chtml::checkBox('addon_'.$addon->id);
		echo CHtml::label($addon->name, '');
	}
	
	// Customizations
	/*
	echo CHtml::activeLabel($product, 'fabric');
	echo CHtml::activeRadioButtonList($product, 'fabric', CHtml::listData($product->fabric, 'fabric', 'fabric'));
	
	echo CHtml::label('Preferred Color Choice', string $for);
	echo "<span class='hint'>Note: Availability</span>";
	echo CHtml::textField('preferred_color', '');
	
	echo CHtml::label('Additional Requests', string $for);
	echo "<span class='hint'>(hint)</span>";
	echo CHtml::textArea('additional_requests', '');
	*/
?>
</fieldset>