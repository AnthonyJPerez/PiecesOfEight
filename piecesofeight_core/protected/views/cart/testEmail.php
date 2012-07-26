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
			<h2>ORDER CONFIRMATION</h2>
			<table border=0>
				<tr>
					<td>
						Hi <?php echo $model->first_name; ?>,
						<br /><br />
						Thank you for shopping at Pieces Of Eight Costumes! Your order number is: 
					</td>
				</tr>
				<tr>
					<td>
						<br />
							<b><?php echo $model->confirmation_code; ?></b>
						<br />
					</td>
				</tr>
				<tr>
					<td>
						<p>
						We have successfully received your online order and it is now being processed. 
						Please note that this order cannot be cancelled or modified.
						<br /><br />
						For further assistance, please email us at 
						<a href="mailto:<?php echo Yii::app()->params['adminEmail'];?>">
							<?php 
								echo Yii::app()->params['adminEmail'];
							 ?> 
						</a>
						. Don't forget to reference your order number!
						</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	
	
	
	<!-- Order Details -->
	<tr>
		<td>
			<h2>Order Details: </h2>
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
	
	
	
	
	<!-- Footer Message -->
	<tr>
		<td>
			<br /><br />
			<p>
				By placing this order you have agreed to Pieces Of Eight Costume’s 
				<?php echo CHtml::link('terms of service', $this->createAbsoluteUrl('site/page', array('view'=>'tos')), array('target'=>'_BLANK')); ?> and 
				<?php echo CHtml::link('privacy policy', $this->createAbsoluteUrl('site/page', array('view'=>'tos', '#'=>'Privacy')), array('target'=>'_BLANK')); ?>.
			</p>
			<p>
				Would you like to receive special offers, discounts, and product updates 
				from Pieces Of Eight Costumes? Subscribe to our 
				<?php echo CHtml::link('newsletter', $this->createAbsoluteUrl('site/newsletter'), array('target'=>'_BLANK')); ?> 
				to stay connected.
			</p>
			<p>
				Thank you again, we appreciate your business and look forward to serving you again
				in the near future!
			</p>
			<br />
			<p>
				Sincerely,
				<br /><br />
				Susan Perez
				<br />
				Pieces Of Eight Costumes By Sue LLC
			</p>
		</td>
	</tr>
</table>