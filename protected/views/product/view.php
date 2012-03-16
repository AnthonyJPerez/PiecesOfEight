<?php
	// Include the jquery library
	Yii::app()->clientScript->registerCoreScript('jquery');

	// Include the slidejs gallery
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/slides.jquery.js', 
		CClientScript::POS_HEAD
	);
	
	// Include the tabify script
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/jquery.tabify.js', 
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
	
	Yii::app()->clientScript->registerScript(
		'tabify',
		'
			$("#tabs").tabify();
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
				padding-left: 0.75em;
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
			<div class='AddcartForm'>
			<?php 
			
				$form = $this->beginWidget('CActiveForm', array(
					'action' => $this->createUrl('cart/add'),
				));
				
				echo $form->errorSummary($formModel);
				
				echo "<div class='size'>";
					echo $form->dropDownList($formModel, 'size', array('Size', 'Small', 'Medium', 'Large'), array());
					echo CHtml::link('Size Chart', $this->createUrl('/'), array());
				echo "</div>";
				
				echo "<div class='quantity'>";
					echo $form->label($formModel, 'quantity');
					echo $form->textField($formModel, 'quantity', array('value'=>1, 'size'=>1, 'maxlength'=>1));
					echo $form->hiddenField($formModel, 'product_id', array('value'=>$model->id));
				echo "</div>";
				
				echo "<div class='submit'>";
					echo CHtml::submitButton('Add to Cart');
				echo "</div>";
				
				$this->endWidget();
			?>
			</div>
			
			
			
			 <!--[if IE]>
			<style type="text/css">
				.box { display: block; }
				#box { overflow: hidden;position: relative; }
				b { position: absolute; top: 0px; right: 0px; width:1px; height: 251px; overflow: hidden; text-indent: -9999px; }
			</style>
		 	<![endif]-->
			<div id="tabs_container">
				<ul id="tabs">
					<li class="active"><a href="#nav_care">Care</a></li>
					<li><a href="#nav_returns">Returns</a></li>
					<li><a href="#nav_shipping">Shipping</a></li>
				</ul>  
				
				<div id="nav_care" class="tab">
					<p>
						This information talks about how to care for your item.
					</p>
				</div>
				<div id="nav_returns" class="tab">
					<p>
						This is the return policy.
					</p>
				</div>
				<div id="nav_shipping" class="tab">
					<p>
						This is the shipping information.
					</p>
				</div>
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