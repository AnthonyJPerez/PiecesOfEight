<?php 
	/* This view gets applied for each product in the list */
?>
<div class="view background_shadow">
	<a href="<?php echo $data->getUrl(); ?>">
		<?php 
			$defaultImage = $data->getDefaultImage();
			echo CHtml::image(Yii::app()->request->baseUrl . '/images/product-images/' . $defaultImage->url);
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