<?php 
	/* This view gets applied for each product in the list */ 	
	
	Yii::app()->clientScript->registerCss(
		'product_view_rounded',
		'
			.rounded_corners
			{
				background-color: #f7f7f7;
				
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				-khtml-border-radius: 10px;
				border-radius: 10px;
			}
			
			.list-view
			{
				width: 100%;
			}
				.list-view img
				{
					width: 100%;
					
					border-radius: 10px;
				}

				.list-view .product_name
				{
					text-align: left;
				}
				
				.list-view .product_price
				{
					text-align: right;
				}
				
				.list-view > .items > .view
				{
					display: inline-block;
					margin: 0.5em;
					padding: 0.5em;
					width: 30%;		
				}
				
				.list-view > .items > .view div
				{
					display: inline-block;
					width: 48%;
					padding: 0.25em;
				}
		',
		'screen'
	);
?>
<div class="view rounded_corners">
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