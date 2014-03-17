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
				"Manage Orders (".$totalOpenOrders." open)",
				$this->createUrl('admin/orders')
			);
		?>
		</li>
		<li>
		<?php
			echo CHtml::link(
				"Set Vacation Mode (currently ". (($this->getVacationModeOption()['enabled']) ? "enabled" : "disabled") .")",
				$this->createUrl('admin/vacation_mode')
			);
		?>
		</li>
	</ul>
</div>


<div>
	<b>Total Sales:</b> <?php echo $totalOrders; ?>
</div>
<div>
	<?php
		$month = date('F');
		echo "<b>Sales for {$month}:</b> {$totalOrdersMonth}";
	?>
</div>












		
	
	
	
	