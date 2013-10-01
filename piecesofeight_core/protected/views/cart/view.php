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
	
	
	
	//
	// Include the select2 selectbox jquery plugin (http://ivaynberg.github.com/select2/)
	//
	
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/select2/select2.min.js', 
		CClientScript::POS_HEAD
	);
	
	// Include the select2 css file
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/js/select2/select2.css',
		'screen'
	);
	
	// Init select2
	Yii::app()->clientScript->registerScript(
		'Select2_Shipping',
		"
			$('.select2_selectbox').select2();
			
			function updateCart()
			{
				var subtotal = parseFloat(".number_format($subTotal, 2).");
				var select = $('#shipping_select');
				var val = select.val();
				var index = val.lastIndexOf('$');
				var shippingPrice = parseFloat(val.substring(index+1), 10);
				
				$('#subtotal_price').html('' + parseFloat(subtotal + shippingPrice).toFixed(2));
				
				//console.log (select, val, index, shippingPrice, subtotal, subtotal+shippingPrice, parseFloat(subtotal+shippingPrice).toFixed(2));
			}
			
			updateCart();
			
			// Edit the subtotal when the options are selected
			$('.select2_selectbox').bind('change', updateCart);
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
			
		.select2_selectbox
		{
			font-size: 0.75em;
			width: 160px;
		}
		
		.select2_selectbox a,
		.select2_selectbox a:visited,
		.select2_selectbox a:link
		{
			color: #000 !important;
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
		
		//echo "<tr><td class='shipping' colspan='4' align='right'><span>Shipping & Handling:</span></td></tr>";
		
		echo "<tr><td colspan='4' align='right'><hr />
		<div>Shipping &amp; Handling</div><select id='shipping_select' class='select2_selectbox'>";
			foreach ($shippingOptions as $option)
			{
				echo "<option>".$option."</option>";
			}
		echo"</select></tr></td>";
		
		$totalShipping = bcadd($subTotal, $shipping, 2);
		
		/*echo "<tr>";
			echo "<td class='subtotal' colspan='4' align='right'>";
				echo "<span>Subtotal: </span><span>";
				echo "$" . $totalShipping . " USD";
				echo "</span>";
			echo "</td>";
		echo "</tr>";*/
		
		echo "<tr><td class='subtotal' colspan='4' align='right'><span>Subtotal: $</span><span id='subtotal_price'>";
		echo number_format($totalShipping,2);
		echo "</span><span> USD</span></td></tr>";
		?>
	
	</table>
	
	
	<ul class='additional_buttons'>
		<?php $continue = "<i class='icon-arrow-left'></i> Continue Shopping" ?>
		<li><?php echo CHtml::link($continue, $this->createUrl('product/list'), array('class'=>'btn btn-primary')); ?></li>
		<li><a class='empty_cart btn btn-inverse' href="<?php echo $this->createUrl('cart/empty'); ?>"><i class='icon-trash'></i> Empty Cart</a></li>
		<li>
		<?php
			echo CHtml::link(
				"Exchange Policy",
				$this->createUrl('site/page', array('view'=>'faq', '#'=>'return-policy')),
				array(
					'title' => "Costume Exchange Policy"
				)
			);
		?>
		</li>
	</ul>
	
	
	<ul class='checkout_buttons'>
		<li>
		<!--form class='checkout' action="<?php echo Yii::app()->params['paypalUrl']; ?>" method="POST"-->
		<form class='checkout' method="POST" action="<?php echo $this->createAbsoluteUrl('cart/doCheckout'); ?>">
			<!--input type="hidden" name="cmd" value="_cart" />
			<input type="hidden" name="upload" value="1" />			
			<input type="hidden" name="return" value="<?php echo $this->createAbsoluteUrl('cart/doCheckout'); ?>" />
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
				}*/
			?>
		
			<?php 
				// Express Checkout
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