<?php
	print_r($orderDetails);
	
	// Follow this guide for best results: http://24ways.org/2009/rock-solid-html-emails
?>

<div id='email_template'>
	<div>
		<span style="font-weight: bold;">
			Full Name: 
		</span>
		<span>
			<?php echo ucfirst($orderDetails['first_name']).' '.ucfirst($orderDetails['last_name']); ?>
		</span>
	</div>
	
	<div>
		<span style="font-weight: bold;">
			Email:
		</span>
		<span>
			<?php echo $orderDetails['email']; ?>
		</span>
	</div>
	
	<div>
		<span style="font-weight: bold;">
			Shipping Internationally:
		</span>
		<span>
		<?php
			echo ( isset($orderDetails['shipping_international']) && $orderDetails['shipping_international'] == 1 )
				? "Yes"
				: "No";
		?>
		</span>
	</div>
</div>