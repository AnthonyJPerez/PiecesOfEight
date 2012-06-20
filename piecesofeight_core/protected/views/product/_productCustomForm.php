
<div class='custom_product_details' data-customproductid='<?php echo $form_id; ?>'>
	<?php
		$defaultImage = $product->getDefaultImage();
		echo CHtml::image(
			Yii::app()->request->baseUrl . '/images/product-images/' . $defaultImage->url,
			$product->getProductImgAltDescription(),
			array(
				'width' => 100,
				'class' => 'edit'
			)
		);
	?>
	
	<a href="#" class="edit">Edit</a>
	
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
		echo "<div>";
		echo CHtml::label('Select your Add-Ons (Optional)', '');
		foreach ($product->p8Addons as $addon)
		{
			echo Chtml::checkBox('addon_'.$addon->id);
			echo CHtml::label($addon->name, '');
		}
		echo "</div>";
		
		
		// Customizations
		echo "<div>";
		echo CHtml::label('Select your Fabric', '');
		foreach ($product->p8Fabrics as $fabric)
		{
			echo Chtml::radioButton('radio_fabric_'.$form_id, false);
			echo CHtml::label($fabric->name, '');
		}
		echo "</div>";
		
			
		echo "<div>";
		echo CHtml::label('Preferred Color Choice', '');
		echo "<span class='hint'>Note: Availability</span>";
		echo CHtml::textField('preferred_color', '');
		echo "</div>";
		
		
		echo "<div>";
		echo CHtml::label('Additional Requests', '');
		echo "<span class='hint'>(hint)</span>";
		echo CHtml::textArea('additional_requests', '');
		echo "</div>";
		
	?>
	</fieldset>
	
	
	<button class='add_product' >Add Product</button>
</div>
