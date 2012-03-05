<div id="breadcrumbs">
	<ul>
		<li>
			<?php echo CHtml::link(
					'All Products',
					$this->createUrl('product/list')
				);
			?>
		</li>
		<li>
			>
		</li>
		<li>
		<?php	
			echo CHtml::link(
				ucfirst($model->category),
				$this->createUrl('product/list', array('category'=>$model->category))
			);
		?>
		</li>
		<li>
			>
		</li>
		<?php
			echo "<li>".$model->name."</li>";
		?>
	</ul>
</div>



<div id="product_listing">
	<?php
		echo CHtml::image(Yii::app()->request->baseUrl . '/images/products/' . $model->images[0]->url);
	?>
	
	<div>
		<?php echo $model->name; ?>
	</div>
	
	<div>
		<?php echo $model->price; ?>
	</div>
	
	<?php
		// @todo: this is a link, but in the future it will be a submit button, that way the
		// user can specify a quantity to add into the cart, instead of just one at a time.
		echo CHtml::link(
			'Add to Cart',
			$this->createUrl('cart/add', array('product_id' => $model->id, 'quantity' => 1))
		);
	?>
	
	<form action="<?php echo $this->createUrl('cart/add'); ?>" method="GET">
		<input type="hidden" name="product_id" value="<?php echo $model->id; ?>" />
		<input type="text" name="quantity" value="1" size="1" maxlength="1" />
		<input type="submit" value="Add to Cart" />
	</form>
	
	
</div>


<?php
/*
	echo GxHtml::openTag('ul');
	foreach($model->images as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('image/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('p8Tags')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->p8Tags as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('tag/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
*/
?>