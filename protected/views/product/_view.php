<?php /* This view gets applied for each product in the list */ ?>
<div class="view">
	<a href="<?php echo $this->createUrl('product/view', array('id'=>$data->id)); ?>">
		<?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/products/' . $data->images[0]->url); ?>
	</a>
	<div class='product_name'>
		<?php echo $data->name; ?>
	</div>
	<div class='product_price'>
		<?php echo $data->price; ?>
	</div>
</div>