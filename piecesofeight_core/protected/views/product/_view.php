<?php 
	/* This view gets applied for each product in the list */
	
	// @hack @todo (remove this eventually).
	// Some products are not actually "Products," but rather add-ons. 
	// These products should not show up in the normal product listings, unless the category is
	// "Miscellaneous". Skip rendering of these products.
	if ( $data->shippable == 1 || ucfirst($category) == ucfirst("miscellaneous") )
	{
?>
	<div class="view background_shadow">
		<a href="<?php echo $data->getUrl(); ?>">
			<?php 
				$defaultImage = $data->getDefaultImage();
				echo CHtml::image(
					Yii::app()->request->baseUrl . '/images/product-images/' . $defaultImage->url,
					$data->getProductImgAltDescription(),
					array(
						//198x297
						"width" => "198",
						"height" => "auto" // Keeps the images from looking squished or stretched.
						//"height" => "297"
					)
				);
			?>
		</a>
		
		<div class='product_name'>
			<a href="<?php echo $data->getUrl(); ?>">
				<?php echo $data->name; ?>
			</a>
		</div>
		
		<div class='product_price'>
			<?php echo '$' . $data->price; ?>
		</div>
	</div>
<?php
	}
?>