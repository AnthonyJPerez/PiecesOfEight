<?php
	$product_name = "Product[".$form_id."]";
?>

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
	
	<h2 class='product_name'>
	<?php
		echo $product->name;
	?>
	</h2>
	
	<fieldset>
		<legend>Measurements</legend>
		<span class="hint">How to take measurements</span>
	<?php
		// Measurements
		foreach ($product->p8Measurements as $measurement)
		{
			echo CHtml::label($measurement->name, '');
			echo CHtml::textField(
				$product_name.'[measurement_'.$measurement->id.']', 	// Name
				'', 						// Value
				array (					// Html Options
					'maxlength' => 4
				)
			);		
		}
	?>
	</fieldset>
	
	
	<fieldset>
		<legend>Add-Ons & Customizations</legend>
	<?php
		// Add-Ons
		echo "<div>";
		echo CHtml::label('Select your Add-Ons (Optional)', '');
		$count = 0;
		foreach ($product->p8Addons as $addon)
		{
			echo Chtml::checkBox(
				$product_name.'[addon]['.$count.']',
				false,		// checked or not
				array(
					'value' => $addon->id
				)
			);
			echo CHtml::label($addon->name, '');
			$count++;
		}
		echo "</div>";
		
		
		// Customizations
		echo "<div>";
		echo CHtml::label('Select your Fabric', '');
		$count = 0;
		foreach ($product->p8Fabrics as $fabric)
		{
			echo Chtml::radioButton(
				$product_name.'[fabric]['.$count.']', // name
				false,		// [boolean] checked
				array(
					'value' => $fabric->id
				)
			);
			echo CHtml::label($fabric->name, '');
			$count++;
		}
		echo "</div>";
		
			
		echo "<div>";
		echo CHtml::label('Preferred Color Choice', '');
		echo "<span class='hint'>Note: Availability</span>";
		echo CHtml::textField(
			$product_name.'[preferred_color]', 	// name
			'ffffff',				// value
			array('class'=>'color', 'width'=>10, 'height'=>10)
		);
		echo "</div>";
		
		
		echo "<div>";
		echo CHtml::label('Additional Requests', '');
		echo "<span class='hint'>(hint)</span>";
		echo CHtml::textArea(
			$product_name.'[additional_requests]', 		// name
			''					// value
		);
		echo "</div>";
		
	?>
	</fieldset>
</div>
