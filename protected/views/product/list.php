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
)); 

?>