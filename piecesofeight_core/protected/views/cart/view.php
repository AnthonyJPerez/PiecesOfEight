<?php
	$this->pageTitle = "Shopping Cart | " . $this->pageTitle;
	$this->pageDescription = "Add our costumes to your shopping cart. Need a custom item? Contact us or check out our collection of handmade costumes";
	$this->pageKeywords = "pieces of eight costumes shopping cart, handmade pirate costumes";
?>
<h1>Shopping Cart</h1>


<?php
	// Include the fancybox script
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/fancybox/jquery.fancybox-1.3.4.pack.js', 
		CClientScript::POS_HEAD
	);
	
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/fancybox/jquery.easing-1.3.pack.js', 
		CClientScript::POS_HEAD
	);
	
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/fancybox/jquery.mousewheel-3.0.4.pack.js', 
		CClientScript::POS_HEAD
	);
	
	// Include the fancybox css file
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/js/fancybox/jquery.fancybox-1.3.4.css',
		'screen'
	);
	
	Yii::app()->clientScript->registerScript(
		'Fancybox_Cart',
		"
		
			$('a.fancybox_cart_product').fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				/*'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
		    			return '<span id='fancybox-title-over'>Image ' +  (currentIndex + 1) + ' / ' + currentArray.length + ' ' + title + '</span>';
				}*/
			});
		",
		CClientScript::POS_READY
	);
	
	
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
		
		.shipping
		{
		
		}
		
		.additional_buttons
		{
			float: left;
			display: table;
			padding: 0;
			padding-top: 1em;
			margin: 0;
			margin-left: 1em;
		}
		
			.additional_buttons li
			{
				padding-right: 2em;
				display: table-cell;
				vertical-align: top;
			}
			
		.checkout_buttons
		{
			float: right;
			display: table;
			padding: 0;
			padding-top: 1em;
			margin: 0;
		}
		
			.checkout_buttons li
			{
				padding-left: 2em;
				display: table-cell;
				vertical-align: top;
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
			<th width='10%'>Quantity</th>
			<th width='10%'>Price</th>
		</tr>
		
		<?php
		foreach ($products as $p)
		{	
			$product = $p['product'];
			echo "<tr align='center' valign='top'>";
				
				echo "<td class='cart_product' align='left'>";
					$defaultImg = $product->getDefaultImage();
					$imgUrl = Yii::app()->request->baseUrl . '/images/product-images/' . $defaultImg->url;
					echo "<a class='fancybox_cart_product' href='".$imgUrl."'>";
					echo CHtml::image(
						$imgUrl, 
						$product->getProductImgAltDescription(), 
						array('width' => 75, 'align'=>'left')
					);
					echo "</a>";
					
					echo "<div class='name'>".CHtml::link($product->name, $product->getUrl())."</div>";
				
					// Remove item from cart button
					$form = $this->beginWidget('CActiveForm', array(
						'action' => $this->createUrl('cart/remove'),
					));
					
						echo $form->errorSummary($AddcartModel);
						echo "<div class='row'>";
							echo $form->hiddenField($AddcartModel, 'product_id', array('value'=>$product->id));
							echo $form->hiddenField($AddcartModel, 'size', array('value'=>$p['size']));
							echo $form->hiddenField($AddcartModel, 'quantity', array('value'=>$p['quantity']));
						echo "</div>";
						
						echo "<div class='row submit'>";
							echo CHtml::linkButton(
								"<i class='icon-minus-sign'></i> Remove",
								array(
									'class' => 'btn'
								)
							);
						echo "</div>";
					
					$this->endWidget();
				echo "</td>";
				
				echo "<td class='size'>". $p['size'] ."</td>";
				
				echo "<td class='quantity'>". $p['quantity'] . "</td>";
				
				echo "<td class='price'>$". $product->price . "</td>";
			echo "</tr>";
		}
		
		echo "<tr><td class='shipping' colspan='4' align='right'><span>Shipping & Handling:</span> $". $shipping ."</td></tr>";
		echo "<tr><td class='subtotal' colspan='4' align='right'><span>Subtotal:</span> $". ($subTotal + $shipping) ."</td></tr>";
		?>
	
	</table>
	
	
	<ul class='additional_buttons'>
		<?php $continue = "<i class='icon-arrow-left'></i> Continue Shopping" ?>
		<li><?php echo CHtml::link($continue, $this->createUrl('product/list'), array('class'=>'btn btn-primary')); ?></li>
	</ul>
	
	
	<ul class='checkout_buttons'>
		<li><a class='empty_cart btn btn-inverse' href="<?php echo $this->createUrl('cart/empty'); ?>"><i class='icon-trash'></i> Empty Cart</a></li>

		<li>
		<!--form class='checkout' action="https://www.paypal.com/cgi-bin/webscr" method="POST"-->
		<form class='checkout' method="POST" action="<?php echo $this->createAbsoluteUrl('cart/checkout'); ?>">
			<!--input type="hidden" name="cmd" value="_cart" />
			<input type="hidden" name="upload" value="1" />			
			<input type="hidden" name="return" value="<?php echo $this->createAbsoluteUrl('cart/checkout'); ?>" />
			<input type="hidden" name="image_url" value="<?php echo Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/images/pieces-of-eight-costumes-logo.png'; ?>" />
			<input type="hidden" name="rm" value="1" />
			<input type="hidden" name="handling_cart" value="<?php echo $shipping; ?>" />
			
			<input type="hidden" name="business" value="<?php echo Yii::app()->params['paypalEmail']; ?>" /-->

			<?php
			/*
				$count = 1;
				foreach ($products as $p)
				{
					$product = $p['product'];
					echo "<input type='hidden' name='item_name_". $count ."' value='". CHtml::encode($product->name)."' />";
					echo "<input type='hidden' name='amount_". $count ."' value='".CHtml::encode($product->price)."' />";
					echo "<input type='hidden' name='quantity_". $count ."' value='".$p['quantity']."' />";
					
					$count++;
				}
				*/
				echo CHtml::imageButton(Yii::app()->baseUrl . '/images/paypal_button.gif', array('alt'=>'Checkout with Paypal'));				
			?>
			
		</form>
		</li>
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