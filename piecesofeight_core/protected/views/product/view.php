<?php
	$this->pageTitle = ucwords($model->name) . " | " . $this->pageTitle;
	
	$this->pageDescription = $model->page_description;
	//$this->pageKeywords = $model->pageKeywords;
	
	$this->pageCanonical = Yii::app()->request->hostInfo . $model->getUrl();
	

	// Include the jquery library
	Yii::app()->clientScript->registerCoreScript('jquery');

	// Include the slidejs gallery
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/slides.jquery.js', 
		CClientScript::POS_HEAD
	);
	
	// Include the Pinterest 'pin-it' scripts
	Yii::app()->clientScript->registerScriptFile(
		"//assets.pinterest.com/js/pinit.js",
		CClientScript::POS_END
	);
	
	// Include the Google+ script
	Yii::app()->clientScript->registerScript(
		'GooglePlus',
		"
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		",
		CClientScript::POS_READY
	);
	
	// Include the tabify script
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/jquery.tabify.js', 
		CClientScript::POS_HEAD
	);
	
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
	
	
	// Include the slidejs product css file
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/css/slidejs_product.css',
		'screen'
	);
	
	
	//
	// Include the select2 selectbox jquery plugin (http://ivaynberg.github.com/select2/)
	//
	
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/select2/select2.min.js', 
		CClientScript::POS_HEAD
	);
	
	// Include the fancybox css file
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/js/select2/select2.css',
		'screen'
	);
	
	// Init Fancybox
	Yii::app()->clientScript->registerScript(
		'Select2_Product',
		"
			$('.select2_selectbox').select2();
		",
		CClientScript::POS_READY
	);
	
	
	
	
	Yii::app()->clientScript->registerScript(
		'Fancybox_Product',
		"
		
			$('a[rel=product_gallery]').fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				/*'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
		    			return '<span id='fancybox-title-over'>Image ' +  (currentIndex + 1) + ' / ' + currentArray.length + ' ' + title + '</span>';
				}*/
			});
			
			$('.size_chart').fancybox({
				'hideOnContentClick': true
			});
		",
		CClientScript::POS_READY
	);
	
	
	Yii::app()->clientScript->registerScript(
		'SlideJS_Product',
		'
			$("#products").slides(
			{
				preload: true,
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
					margin-bottom: 1.5em;
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
			font-size: 10pt;
		}
		
		#size_chart_data
		{
			padding: 0.5em;
			padding-bottom: 0;
			width: 325px;
		}
		
		#size_chart_data > table
		{
			margin-bottom: 1.25em;
		}
		
		.select2_selectbox
		{
			width: 45%;
			margin-bottom: 0.5em;
		}
		
		.button_row
		{
			margin: 0 auto;
			margin-top: 1.5em;
			margin-bottom: 1em;
			width: 100%;
			position: relative;
		}
		
			.button_row a
			{
				width: 45%;
				font-size: 14px !important;
			}
			
			.button_row a:first-child
			{
				margin-right: 2.5em;
			}
		
		.submit
		{
			width: 100%;
			position: relative;
			margin-bottom: 1.5em;
		}
		
			.submit a
			{
				width: 100%;
				font-size: 15px !important;
			}
		
		.etsy_link
		{
			font-size: 10pt;
		}
		
		.hidden_data
		{
			display: none;
		}
		
		
		#social_button_bar
		{
			margin-top: 1em;
		}
		
		#social_button_bar div
		{
			display: inline-block;
		}
		
		/* In the product view, dont display the social media buttons */
		#social_media_buttons
		{
			display: none;
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


<div id="product_container" itemscope itemtype="http://schema.org/Product">
	<div id="product_image_container">
		<div id="products">
			<div class="slides_container">
			<?php
				// Make the default image the first image:
				$defaultImg = $model->getDefaultImage();
				$imgUrl = Yii::app()->request->baseUrl . '/images/product-images/' . $defaultImg->url;
				$imgTag = CHtml::image(
					$imgUrl,
					$model->getProductImgAltDescription(),
					array(
						'width' => 300,
						'itemprop'=>'image'
					)
				);
				
				echo "<a class='fancybox_product_gallery' href='".$imgUrl."' rel='product_gallery'>".$imgTag."</a>";
			
				
				// Now display the rest of the images:
				$imgs = $model->getImages();
				foreach ($imgs as $img)
				{					
					// Ignore the default image, it has already been placed in here:
					if ($img->id == $defaultImg->id)
					{
						continue;
					}
					
					$imgUrl = Yii::app()->request->baseUrl . '/images/product-images/' . $img->url;
					$imgTag = CHtml::image(
						$imgUrl,
						$model->getProductImgAltDescription(),
						array(
							'width' => 300,
							'itemprop'=>'image'
						)
					);
					//echo CHtml::link($imgTag, '#', array());
					echo "<a class='fancybox_product_gallery' href='".$imgUrl."' rel='product_gallery'>".$imgTag."</a>";
				}
			?>
			</div>
			<ul class="pagination">
			<?php
				// Display the default image
				$imgTag = CHtml::image(
					Yii::app()->request->baseUrl . '/images/product-images/' . $defaultImg->url,
					$model->getProductImgAltDescription(),
					array(
						'width' => 55
					)
				);
				echo "<li>";
				echo CHtml::link($imgTag, '#', array());
				echo "</li>";
					
				// Now display the rest of the images
				$imgs = $model->getImages();
				foreach ($imgs as $img)
				{
					// Ignore the default image, it has already been placed in here:
					if ($img->id == $defaultImg->id)
					{
						continue;
					}
					
					$imgTag = CHtml::image(
						Yii::app()->request->baseUrl . '/images/product-images/' . $img->url,
						$model->getProductImgAltDescription(),
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
				<h1 itemprop="name"><?php echo $model->name; ?></h1>
			</div>
			
			<?php
			if ($isAdmin)
			{
			?>
				<div class="admin_link">
					<?php 
					echo CHtml::link(
						'Edit this Product', 
						$this->createUrl('product/create', array('id'=>$model->id)), 
						array()
					); 
					?>
				</div>
			<?php
			}
			?>
			
			<div class="product_price" itemscope itemtype="http://schema.org/Offer">
				<span itemprop="price">
					<?php echo '$' . $model->price; ?>
				</span>
			</div>
			
			<p class="product_description" itemprop="description">
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
					echo $form->error($formModel,'quantity');
					echo $form->dropDownList(
						$formModel, 
						'size', 
						array_merge(
							array(''=>''),
							CHtml::listData($model->p8Sizes, 'size', 'size')
						),
						array("data-placeholder"=>'Select Size', "class"=>"select2_selectbox")
					);
						
					echo "<a class='size_chart' href='#size_chart_data' >Size Chart</a>";
					//CHtml::encode($model->size_chart)
					?>
					<div class='hidden_data'>
						<div id='size_chart_data'>
							<span>Women's Size Chart:</span>
							<table border="1" align="center" cellpadding="4">
								<tr>
									<th />
									<th>XS</th>
									<th>S</th>
									<th>M</th>
									<th>L</th>
									<th>XL</th>
								</tr>
								<tr>
									<td>Bust</td>
									<td>32</td>
									<td>34</td>
									<td>36</td>
									<td>38</td>
									<td>42</td>
								</tr>
								<tr>
									<td>Waist</td>
									<td>24</td>
									<td>26</td>
									<td>28</td>
									<td>30</td>
									<td>34</td>
								</tr>
								<tr>
									<td>Hips</td>
									<td>34</td>
									<td>36</td>
									<td>38</td>
									<td>40</td>
									<td>44</td>
								</tr>
							</table>
							
							
							<span>Men's Size Chart:</span>
							<table border="1" align="center" cellpadding="4">
								<tr>
									<th />
									<th>XS</th>
									<th>S</th>
									<th>M</th>
									<th>L</th>
									<th>XL</th>
								</tr>
								<tr>
									<td>Chest</td>
									<td>30-32</td>
									<td>34-36</td>
									<td>38-40</td>
									<td>42-44</td>
									<td>46-48</td>
								</tr>
								<tr>
									<td>Waist</td>
									<td>26-27</td>
									<td>28-30</td>
									<td>32-34</td>
									<td>36-38</td>
									<td>40-42</td>
								</tr>
								<tr>
									<td>Hips</td>
									<td>31-33</td>
									<td>35-37</td>
									<td>39-41</td>
									<td>43-45</td>
									<td>47-49</td>
								</tr>
							</table>
						</div>
					</div>
					<?php
			
				echo "</div>";
				
				echo "<div class='quantity'>";
					echo $form->dropDownList($formModel, 'quantity', array(''=>'', '1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8,'9'=>9), array('data-placeholder'=>'Quantity', "class"=>"select2_selectbox"));
					//echo $form->label($formModel, 'quantity');
					//echo $form->textField($formModel, 'quantity', array('value'=>1, 'size'=>1, 'maxlength'=>1));
				echo "</div>";
				
				echo $form->hiddenField($formModel, 'product_id', array('value'=>$model->id));
				
				
				// Etsy and Custom order buttons
				echo "<div class='button_row'>";
				echo CHtml::link(
						"View on Etsy</i>",
						"https://www.etsy.com/shop/PiecesOf8Costumes",
						array(
							'target'=>'_blank',
							'rel' => 'nofollow',
							'class' => 'btn'
						)
					);
				
				echo CHtml::link(
					"Custom Order",
					$this->createUrl('site/contact', array('pid'=>$model->id)),
					array(
						'target'=>'_blank',
						'rel' => 'nofollow',
						'class' => 'btn'
					)
				);
				echo "</div>";
				
				// Submit Button
				echo "<div class='submit'>";
					echo CHtml::linkButton(
						"<i class='icon-shopping-cart'></i> Add to Cart",
						array(
							'class' => 'btn btn-success'
						)
					);
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
					<p>
					<?php
						echo $model->care_information;
					?>
					</p>
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
					Shipping and handling fees are $8.95 within the US or $12.95 for 
					2 or more items shipped together. Items will be shipped 
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
			
			<div id="social_button_bar">
				<div>
					<?php
						// Generate the "Pin-It" button for Pinterest
						$pin_url = "url=" . rawurlencode($model->getUrl(true));
						$pin_media = "media=" . rawurlencode(Yii::app()->request->hostInfo . Yii::app()->request->baseUrl . '/images/product-images/' . $model->getDefaultImage()->url);
						$pin_description = "description=" . rawurlencode($model->page_description);
						$pin_href = "http://pinterest.com/pin/create/button/?" . $pin_url ."&". $pin_media ."&". $pin_description;
					?>
					<a href="<?php echo $pin_href; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
				</div>
				
				<div class="g-plusone" data-size="medium" data-annotation="bubble" data-href="https://plus.google.com/107715338617466620653"></div>
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