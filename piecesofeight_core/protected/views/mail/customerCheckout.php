<?php
	// Format the order data for the customer
	//print_r($model);
	
	// Follow this guide for best results: http://24ways.org/2009/rock-solid-html-emails
?>

<table>
	<tr>
		<?php
			$imgUrl = Yii::app()->request->baseUrl . '/images/product-images/header_shadow.png';
			echo CHtml::image(
				$imgUrl, 
				"Pieces of Eight Costumes Header Image", 
				array('width'=>'100%')
			);	
		?>
	</tr>
</table>