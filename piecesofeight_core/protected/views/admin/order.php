<?php 
	// Main Admin Page

	$model = $order;
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
			>
		</li>
		<li>
			<?php echo CHtml::link(
					'Orders',
					$this->createUrl('admin/orders')
				);
			?>
		</li>
	</ul>
</div>




<div>
	<table border=0 width="600px" cellpadding="0" cellspacing="0">
		
		<!-- Welcome Message -->
		<tr>
			<td>
				<table border=0>
					<tr>
						<td>
							<h2>Order Details:</h2>
							<table border=0 align='left' cellpadding="4" cellspacing="4">
								<tr>
									<td align='right'>
										<b>Order Status: </b>
									</td>
									<td>
										<?php 
											$form = $this->beginWidget('GxActiveForm', array(
												'id' => 'order-details-form',
												'enableAjaxValidation' => false
											));
										
											echo "<div class='row buttons'>";
											echo GxHtml::activeDropDownList( $model,'order_status',$model->enumItem($model, 'order_status') );
											echo GxHtml::submitButton(Yii::t('app', 'Update Order'));
											echo "</div>";
											$this->endWidget();
										?>
									</td>
								</tr>
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
</div>











		
	
	
	
	