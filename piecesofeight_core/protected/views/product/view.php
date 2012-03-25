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
	
	// Include the clearbox script
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/clearbox.js', 
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
					text-align: left;
				}
	
				.product_price
				{
					font-size: 10pt;
					margin-bottom: 10px;
				}
	
				.product_description
				{
				
				}
				
			#product_container input
			{
				margin-top: 1em;
			}
				
		.tabs_container
		{
		
		}
		
			#tabs 
			{ 
				text-align: left; 			/* set to left, right or center */
				margin: 1em 0 0 0; 			/* set margins as desired */
				border-bottom: 1px solid #999; 	/* set border COLOR as desired */
				list-style-type: none;
				padding: 3px 10px 3px 10px; 		/* THIRD number must change with respect to padding-top (X) below */
			}
			
			#tabs li
			{
				display: inline;
			}
			
			#tabs li.tab
			{
				border-bottom: 1px solid #fff;
				background-color: #fff;
			}
			
			#tabs li a
			{
				padding: 3px 4px;
				border: 1px solid #999;
				background-color: #cfcfcf;
				margin-right: 0px;
				text-decoration: none;
				border-bottom: none;
			}
			
			#tabs li a:hover
			{
				background: #fff;
			}
			
			#tabs li.active a
			{
				background-image: url("'.Yii::app()->request->baseUrl.'/images/bg_noise_2.png");
				position: relative;
				top: 1px;
				padding-top: 4px;
			}
			
			#tabs_container .tab
			{
				min-height: 200px;
				padding: 0.75em;
				border-left: 1px solid #999;
				border-right: 1px solid #999;
				border-bottom: 1px solid #999;
			}
			
			.size_chart
			{
				margin-left: 1em;
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
						Yii::app()->request->baseUrl . '/images/product-images/' . $img->url,
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
						Yii::app()->request->baseUrl . '/images/product-images/' . $img->url,
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
					'id' => 'add-cart-form',
					'focus'=>array($formModel,'size')
				));
								
				echo "<div class='size'>";
					echo $form->error($formModel,'size');
					echo $form->dropDownList($formModel, 'size', CHtml::listData($model->p8Sizes, 'size', 'size'), array('empty'=>'Select Size'));
				
					echo "<a class='size_chart' href='htmlcontent' rel='clearbox[html=".
						CHtml::encode("<p>".$model->size_chart."</p>")
						."]'>Size Chart</a>";
				
				echo "</div>";
				
				echo "<div class='quantity'>";
					echo $form->label($formModel, 'quantity');
					echo $form->textField($formModel, 'quantity', array('value'=>1, 'size'=>1, 'maxlength'=>1));
				echo "</div>";
				
				echo $form->hiddenField($formModel, 'product_id', array('value'=>$model->id));
				
				echo "<div class='submit'>";
					echo CHtml::submitButton('Add to Cart');
				echo "</div>";
				
				$this->endWidget();
			?>
			</div>
			
			
			<div id="tabs_container">
				<ul id="tabs">
					<li class="active"><a href="#nav_care">Care</a></li>
					<li><a href="#nav_returns">Returns</a></li>
					<li><a href="#nav_shipping">Shipping</a></li>
				</ul>  
				
				<div id="nav_care" class="tab">
					<?php
						echo $model->care_information;
					?>
				</div>
				<div id="nav_returns" class="tab">
					<p>
					As with many small costuming businesses, all sales are final. Size 
					adjustments can be made to custom orders, item will need to be mailed 
					back to me with clear indications of the adjustments needed and will 
					be shipped back out within 3-5 business days.
					</p>
				</div>
				<div id="nav_shipping" class="tab">
					<p>
					Shipping and handling fees $8.95 per item within the US. $12.95 for 
					2 or more items shipped together with the US. Items will be shipped 
					UPS or USPS standard ground with tracking. 3-10 days from date shipped. 
					Rush delivery available for an additional fee depending on the destination.
					</p>
					<p>
					In stock items will be shipped out within 1-5 days of order.
					Custom orders will take 3-6 weeks to ship. Oversees orders subject 
					to additional shipping fees, all customs and taxes will be the 
					responsibility of the purchaser.
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