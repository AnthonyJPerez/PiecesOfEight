<?php 
	// Main Admin Page
?>

<div id="breadcrumbs">
	<ul>
		<li>
			<?php echo CHtml::link(
					'Admin Home',
					$this->createUrl('admin/index')
				);
			?>
		</li>
		<li>
			> Orders
		</li>
	</ul>
</div>


<h1>
	Manage Orders
</h1>


<div>
	<?php
		foreach ($orders as $category => $orders)
		{
		?>
			<h2><?php echo ucfirst($category) . " Orders" ?></h2>
			<div>
				<ul>
					<?php
						if (empty($orders)) {
							echo "<li>None</li>";
						}
						else
						{
							foreach ($orders as $order)
							{
								echo "<li>";
								$date = preg_split("/\s/", $order->order_date);
								$date = $date[0];
								echo CHtml::link(
									"[".$date ."] " . $order->shipto_name . " -- " . $order->confirmation_code,
									$this->createUrl('admin/order', array('id' => $order->id))
								);
								echo "</li>";
							}
						}
					?>
				</ul>
			</div>
		<?php
		}
	?>
</div>












		
	
	
	
	