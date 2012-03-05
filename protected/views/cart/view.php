
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<div>
<?php
	foreach ($products as $p)
	{	
		$product = $p['product'];
		echo "<div class='product'>";
			echo CHtml::image(Yii::app()->request->baseUrl . '/images/products/' . $product->images[0]->url, '', array('width' => 50));
			echo "<div class='name'>". $product->name . "</div>";
			echo "<div class='price'>". $product->price . "</div>";
			echo "<div class='quantity'>". $p['quantity'] . "</div>";
			
			echo "<a href='".$this->createUrl('cart/remove', array('product_id'=>$product->id))."'>Remove Item</a>";
		echo "</div>";
	}
	
	echo "<div class='subtotal'>". $subTotal ."</div>";
?>
</div>


<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST">
	<input type="hidden" name="cmd" value="_cart" />
	<input type="hidden" name="upload" value="1" />
	<input type="hidden" name="business" value="po8_1330738240_biz@gmail.com" />
	<input type="hidden" name="return" value="http://localhost/yii_1.1.10/PeicesOfEight" />
	<input type="hidden" name="image_url" value="http://localhost/yii_1.1.10/PeicesOfEight/images/logo3.png" />
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
	?>
	<input type="submit" value="Checkout with PayPal" />
<form>


<a href="<?php echo $this->createUrl('cart/empty'); ?>">Empty Cart</a>
