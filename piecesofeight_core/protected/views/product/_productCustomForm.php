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
	echo CHtml::label('Select your Fabric', '');
	foreach ($product->p8Fabrics as $fabric)
	{
		echo Chtml::radioButton('fabric'.$fabric->id);
		echo CHtml::label($fabric->name, '');
	}
		
	
	echo CHtml::label('Preferred Color Choice', '');
	echo "<span class='hint'>Note: Availability</span>";
	echo CHtml::textField('preferred_color', '');
	
	echo CHtml::label('Additional Requests', '');
	echo "<span class='hint'>(hint)</span>";
	echo CHtml::textArea('additional_requests', '');
	
?>
</fieldset>