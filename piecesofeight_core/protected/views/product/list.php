<?php
	if (isset($category))
	{
		switch ($category)
		{
			case 'new': 
				$this->pageTitle = 'New Products | ' . $this->pageTitle;
				break;
				
			default:
				$this->pageTitle = ucfirst($category) . ' | ' . $this->pageTitle;
				break;
		}
		
	}
	else
	{
		$this->pageTitle = 'Products | ' . $this->pageTitle;
	}

	Yii::app()->clientScript->registerCss(
		'product_view_rounded',
		'
			.background_shadow
			{
				background-color: #f7f7f7;
				
				-webkit-box-shadow: 3px 3px 8px -1px #666;
				-moz-box-shadow: 3px 3px 8px -1px #666;
				box-shadow:  3px 3px 8px -1px #666;
			}
			
			#product_listing
			{
				padding: 1em;
				background-color: lightgrey;
			}
			
				#product_listing > img
				{
					width: 45%;
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
					vertical-align: top;
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
				echo "<li><h1>".ucfirst($category)."</h1></li>";
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
	'enablePagination' => true,
	'sortableAttributes' => array(
		'price'
	),
)); 

?>