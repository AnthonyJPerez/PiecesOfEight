<?php
	Yii::app()->clientScript->registerCss(
		'product_view_rounded',
		'
			.background_shadow
			{
				background-color: #f7f7f7;
				
				-webkit-box-shadow: 2px 2px 6px 1px #888;
				-moz-box-shadow: 2px 2px 6px 1px #888;
				box-shadow: 2px 2px 6px 1px #888;
			}
			
			.list-view
			{
				width: 100%;
				padding-left: 1.5em;
			}
				.view {
					position: relative;
				}
				
				.view img
				{
					width: 100%;
					margin-bottom: 5px;
				}

				.view .product_name
				{
					float: left;
					text-align: left;
					width: 70%;	
				}
				
				.view .product_price
				{
					position: absolute;
					right: 5px;
					bottom: 5px;
				}
				
				.list-view > .items > .view
				{
					display: inline-block;
					margin: .8em;
					padding: 0.5em;
					width: 30%;		
				}
				
			.list-view .summary
			{
				display: none;
			}
			
			.list-view .sorter
			{
				margin-right: 1.5em;
			}
			
			.list-view .empty
			{
				position: absolute;
				top: 75px;
				margin-left: 1em;
			}
			
			.list-view-loading
			{
				background-image: none;
			}
		',
		'screen'
	);
?>

<div id="breadcrumbs">
	<ul>
	<?php
		if (isset($category))
		{
			echo "<li>";
			
			echo CHtml::link(
				'All Products',
				$this->createUrl('product/list')
			);
			
			echo "</li><li> > </li>";

			if (isset($category))
			{
				echo "<li>".ucfirst($category)."</li>";
			}
		}
		else
		{
			echo "<li>All Products</li>";
		}
	?>
	</ul>
</div>


<?php 

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'sortableAttributes' => array(
		'price'
	),
)); 

?>