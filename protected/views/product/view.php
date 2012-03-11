<?php
	// Include the jquery library
	Yii::app()->clientScript->registerCoreScript('jquery');

	// Include the slidejs gallery
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/slides.jquery.js', 
		CClientScript::POS_HEAD
	);
	
	// Include the slidejs product css file
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/css/slidejs_product.css',
		'screen'
	);
	
	Yii::app()->clientScript->registerScript(
		'SlideJS_Product',
		'
		$("#products").slides(
		{
			preload: true,
			preloadImage: "' . Yii::app()->request->baseUrl . '/images/test/loading.gif",
			effect: "slide, fade",
			crossfade: true,
			slideSpeed: 350,
			fadeSpeed: 200,
			generateNextPrev: true,
			generatePagination: false
		});
		',
		CClientScript::POS_READY
	);
	
	
	Yii::app()->clientScript->registerCss(
		'product_view_rounded',
		'
		#product_container
		{
			display: table;
		}
		
			#product_image_container
			{
				display: table-cell;
			}
		
			#product_details_container
			{	
				vertical-align: top;
				display: table-cell;
				width: 400px;
				padding: 0.5em;
			}
			
			#product_details
			{
				margin-top: 15px;
			}
			
				.product_name
				{
					font-size: 16pt;
					margin-bottom: 10px;
					text-align: center;
				}
	
				.product_price
				{
					font-size: 10pt;
					margin-bottom: 10px;
				}
	
				.product_description
				{
				
				}
		',
		'screen'
	);
?>

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
		<!--li>
			>
		</li>
		<?php
			echo "<li>".$model->name."</li>";
		?>
		-->
	</ul>
</div>


<div id="product_container">
	<div id="product_image_container">
		<div id="products">
			<div class="slides_container">
			<?php
				foreach ($model->images as $img)
				{
					$imgTag = CHtml::image(
						Yii::app()->request->baseUrl . '/images/products/' . $img->url,
						$model->name,
						array(
							'width' => 300
						)
					);
					echo CHtml::link($imgTag, '#', array());
				}
			?>
			</div>
			<ul class="pagination">
			<?php
				foreach ($model->images as $img)
				{
					$imgTag = CHtml::image(
						Yii::app()->request->baseUrl . '/images/products/' . $img->url,
						$model->name . ' (small)',
						array(
							'width' => 55
						)
					);
					echo "<li>";
					echo CHtml::link($imgTag, '#', array());
					echo "</li>";
				}
			?>
			</ul>
		</div>
	</div>
	
	
	<div id="product_details_container">
		<div id="product_details">
			<div class="product_name red_title">
				<?php echo $model->name; ?>
			</div>
			
			<div class="product_price">
				<?php echo '$' . $model->price; ?>
			</div>
			
			<p class="product_description">
				<?php echo $model->description; ?>
			</p>
			
			<!-- Add to cart form -->
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
	</div>
</div>





<?php
/*

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