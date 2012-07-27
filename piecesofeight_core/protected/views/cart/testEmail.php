<?php
	// Format the order data for the customer
	//print_r($model);
	
	// Follow this guide for best results: http://24ways.org/2009/rock-solid-html-emails
?>

<table border=0 width="600px" cellpadding="0" cellspacing="0">
	<tr>
		<?php
			$bgImg = Yii::app()->request->hostInfo.Yii::app()->request->baseUrl . '/images/header_shadow_600x143.png';
			$imgUrl = Yii::app()->request->hostInfo.Yii::app()->request->baseUrl . '/images/pieces-of-eight-costumes-logo.png';
		?>
		<td height="143px" width="600" background="<?php echo $bgImg; ?>" style="overflow: hidden;" align="center" valign="middle">
		<?php
			echo CHtml::image(
				$imgUrl, 
				"Pieces of Eight Costumes Header Image", 
				array('width'=>'94px', 'style'=>"margin-top: 31px;")
			);
		?>
		</td>
	</tr>
	
	<!-- Welcome Message -->
	<tr>
		<td>
			<h1>Notification of Order</h1>
			<table border=0>
				<tr>
					<td>
						<h2>Order Details:</h2>
						<table border=0 align='left' cellpadding="4" cellspacing="4">
							<tr>
								<td align='right'>
									<b>Order #:</b>
								</td>
								<td>
									<?php echo $model->confirmation_code; ?>
								</td>
							</tr>
							<tr>
								<td align='right'>
									<b>Date:</b>
								</td>
								<td>
									<?php echo $model->order_date; ?>
								</td>
							<tr />
							<tr align='left'>
								<td align='right'>
									<b>Name:</b>
								</td>
								<td>
									<?php echo ucfirst($model->first_name).' '.ucfirst($model->last_name); ?>
								</td>
							</tr>
							<tr>
								<td align='right'>
									<b>Email:</b>
								</td>
								<td>
									<?php echo $model->email; ?>
								</td>
							</tr>
							<tr>
								<td align='right'>
									<b>Shipping Info:</b>
								</td>
								<td>
									<?php
										echo $model->shipto_name."<br />";
										echo $model->shipto_street."<br />";
										echo $model->shipto_city.", ";
										echo $model->shipto_state.", ";
										echo $model->shipto_zip."<br />";
										echo $model->shipto_countryname." (".$model->shipto_countrycode.")";
									?>
								</td>
							</tr>
							<tr>
								<td align='right'>
									<b>Total Price:</b>
								</td>
								<td>
									<?php echo "$".$model->total_amt; ?>
								</td>
							</tr>
							<tr>
								<td align='right'>
									<b>Paypal Fee:</b>
								</td>
								<td>
									<?php echo "$".$model->paypalfee_amt; ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	
	
	
	<!-- Order Details -->
	<tr>
		<td>
			<h2>Items Ordered: </h2>
			<table border="0" width="100%">
			<tr class="heading">
				<th width="70%" colspan="2">Product Description</th>
				<th width="10%">Size</th>
				<th width='10%'>Quantity</th>
				<th width='10%'>Price</th>
			</tr>
			
			<?php
			$products = unserialize(base64_decode($model->order_details));
			foreach ($products as $pid=>$pdetails)
			{	
				echo "<tr align='center' valign='middle'>";
					
					echo "<td class='cart_product' align='left' width='15%' style='padding: 0.5em;'>";
						$defaultImg = $pdetails['product']->getDefaultImage();
						$imgUrl = Yii::app()->request->hostInfo.Yii::app()->request->baseUrl . '/images/product-images/' . $defaultImg->url;
						echo CHtml::image(
							$imgUrl, 
							$pdetails['product']->getProductImgAltDescription(), 
							array('width' => 75, 'align'=>'left')
						);
					echo "</td><td width='85%' align='left'>";
						echo CHtml::link($pdetails['product']->name, $pdetails['product']->getUrl());
					echo "</td>";
					
					echo "<td>". $pdetails['size'] ."</td>";
					
					echo "<td>". $pdetails['quantity'] . "</td>";
					
					echo "<td>$". $pdetails['product']->price . "</td>";
				echo "</tr>";
			}			
			echo "<tr><td colspan='5'><hr /></td></tr>";
			
			echo "<tr><td colspan='3' align='right'>Shipping &amp; Handling: </td>";
			echo "<td colspan='2' align='right'>$".$model->shipping_amt."</td></tr>";
			
			echo "<tr><td colspan='3' align='right'><b>Total: </b></td>";
			echo "<td colspan='2' align='right'><b>$".$model->total_amt." USD</b></td></tr>";
			?>
		
		</table>
		</td>
	</tr>
</table>