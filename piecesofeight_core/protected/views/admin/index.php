<?php 
	// Main Admin Page
?>

<h1>
	Administration Section
</h1>

<div>
	<ul>
		<li>
		<?php
			echo CHtml::link(
				"Create New Product",
				$this->createUrl('product/create')
			);
		?>
		</li>
		<li>
		<?php
			echo CHtml::link(
				"Insert New Feedback",
				$this->createUrl('admin/feedback')
			);
		?>
		</li>
		<li>
		<?php
			echo CHtml::link(
				"Manage Orders",
				$this->createUrl('admin/orders')
			);
		?>
		</li>
	</ul>
</div>












		
	
	
	
	