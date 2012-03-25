
<h1>Shopping Cart</h1>


<?php
if (!empty($products))
{

	Yii::app()->clientScript->registerCss(
		'cart_css',
		'
		
		#cart_table
		{
			margin: 0 auto;
			width: 90%;
			color: #111;
		}
		
			#cart_table table
			{
				width: 100%;
				border-spacing: 1em 1em;
			}
			
			#cart_table table th
			{
				background: #ccc;
				padding: .5em;
				font-size: 9pt;
			}
			
		cart_product
		{
			
		}
			.cart_product img
			{
				margin-right: 1em;
			}
			
			.cart_product .name
			{
				margin: .5em;
			}
			
		.subtotal
		{
			font-weight: bold;
		}
		
		.checkout_buttons
		{
			float: right;
			display: table;
		}
		
			.checkout_buttons li
			{
				padding-left: 2em;
				display: table-cell;
				vertical-align: middle;
			}
		',
		'screen'
	);
?>
<div id='cart_table'>
	<table border="0">
		<tr class="heading">
			<th>Product Description</th>
			<th width="10%">Size</th>
			<th width='10%'>Price</th>
			<th width='10%'>Quantity</th>
		</tr>
		
		<?php
		foreach ($products as $p)
		{	
			$product = $p['product'];
			echo "<tr align='center' valign='top'>";
				
				echo "<td class='cart_product' align='left'>";
					echo CHtml::image(Yii::app()->request->baseUrl . '/images/product-images/' . $product->images[0]->url, '', array('width' => 75, 'align'=>'left'));
					echo "<div class='name'>".CHtml::link($product->name, $this->createUrl('product/view', array('id'=>$product->id)))."</div>";
				
					// Remove item from cart button
					$form = $this->beginWidget('CActiveForm', array(
						'action' => $this->createUrl('cart/remove'),
					));
					
						echo $form->errorSummary($AddcartModel);
						echo "<div class='row'>";
							echo $form->hiddenField($AddcartModel, 'product_id', array('value'=>$product->id));
							echo $form->hiddenField($AddcartModel, 'size', array('value'=>$p['size']));
						echo "</div>";
						
						echo "<div class='row submit'>";
							echo CHtml::submitButton('Remove');
						echo "</div>";
					
					$this->endWidget();
				echo "</td>";
				
				echo "<td class='size'>". $p['size'] ."</td>";
				
				echo "<td class='price'>$". $product->price . "</td>";
				
				echo "<td class='quantity'>". $p['quantity'] . "</td>";
			echo "</tr>";
		}
		
		echo "<tr><td class='subtotal' colspan='3' align='right'><span>Subtotal:</span> $". $subTotal ."</td></tr>";
		?>
	
	</table>
	
	
	<ul class='checkout_buttons'>
		<li><a class='empty_cart' href="<?php echo $this->createUrl('cart/empty'); ?>">Empty Cart</a></li>

		<li><form class='checkout' action="https://www.paypal.com/cgi-bin/webscr" method="POST">
			<input type="hidden" name="cmd" value="_cart" />
			<input type="hidden" name="upload" value="1" />
			<!--input type="hidden" name="business" value="po8_1330738240_biz@gmail.com" /-->
			<input type="hidden" name="business" value="<?php echo Yii::app()->params['adminEmail']; ?>" />
			<input type="hidden" name="return" value="<?php echo $this->createAbsoluteUrl('cart/checkout'); ?>" />
			<input type="hidden" name="image_url" value="<?php echo Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/images/logo3.png'; ?>" />
			<input type="hidden" name="rm" value="1" />
			
			<?php
				$count = 1;
				foreach ($products as $p)
				{
					$product = $p['product'];
					echo "<input type='hidden' name='item_name_". $count ."' value='". CHtml::encode($product->name)."' />";
					echo "<input type='hidden' name='amount_". $count ."' value='".CHtml::encode($product->price)."' />";
					echo "<input type='hidden' name='quantity_". $count ."' value='".$p['quantity']."' />";
					
					$count++;
				}
				
				echo CHtml::imageButton(Yii::app()->baseUrl . '/images/paypal_button.gif', array('alt'=>'Checkout with Paypal'));
			?>
			
		</form></li>
	</ul>		
</div>
	
	
	
<?php
}
else
{ // Cart is empty! Don't bother rendering the above!
?>
	<p>
		Your shopping cart is empty! Check out our <?php echo CHtml::link('Products', $this->createUrl('product/list')); ?> page to add some items into your cart.
	</p>
<?php
}
?>