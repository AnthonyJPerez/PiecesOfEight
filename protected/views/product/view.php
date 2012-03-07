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
	
	<div class='form'>
	<?php 
	
		$form = $this->beginWidget('CActiveForm', array(
			'action' => $this->createUrl('cart/add'),
		));
		
		echo $form->errorSummary($formModel);
		echo "<div class='row'>";
			echo $form->label($formModel, 'quantity');
			echo $form->textField($formModel, 'quantity', array('value'=>1, 'size'=>1, 'maxlength'=>1));
			echo $form->hiddenField($formModel, 'product_id', array('value'=>$model->id));
		echo "</div>";
		
		echo "<div class='row submit'>";
			echo CHtml::submitButton('Add to Cart');
		echo "</div>";
		
		$this->endWidget();
	?>
	</div>
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