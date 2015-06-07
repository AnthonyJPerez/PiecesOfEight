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
	
	
	// Include the Facebook script
	Yii::app()->clientScript->registerScript(
		'Facebook2',
		'
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, "script", "facebook-jssdk"));
		',
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
	
	// Include the select2 css file
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/js/select2/select2.css',
		'screen'
	);
	
	// Init select2
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
				'autoScale': false,
				'width': 800,
				'height': 1340
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
			
			#tabs li a:link,
			#tabs li a:visited
			{
				color: #111 !important;
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
			
		.size_chart,
		.size_chart_2
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
				width: 44%;
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
			
			.submit div
			{
				width: 100%;
				font-size: 15px !important;
				text-align: center;
				padding: 0.75em;
				background-color: rgba(50, 50, 50, 0.5);
				border-radius: 2px;
				color: #eee;
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
			width: 70px !important;
			display: inline-block;
			vertical-align: top;
		}
		
		/* In the product view, dont display the social media buttons */
		#social_media_buttons
		{
			display: none;
		}
			
		',
		'screen'
	);
	
	
	//
	// Include the FullCalendar script files
	// http://fullcalendar.io
	//
	Yii::app()->clientScript->registerScriptFile( 
		'//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.min.js', 
		CClientScript::POS_END
	);
	
	Yii::app()->clientScript->registerCssFile(
		'//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.min.css',
		'screen'
	);
	
	Yii::app()->clientScript->registerCssFile(
		'//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.print.css',
		'print'
	);
	
	Yii::app()->clientScript->registerScriptFile( 
		'//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js', 
		CClientScript::POS_HEAD
	);
	
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/gcal.js', 
		CClientScript::POS_END
	);
	
	// Include the Calendar script
	Yii::app()->clientScript->registerScript(
		'FullCalendar',
		"
			$(document).ready(function() {
    			$('#calendar').fullCalendar({
    			    header: {
						left: 'prev,next today',
						center: 'title',
						right: ''
					},
					height: 'auto',
					eventLimit: true,
        			googleCalendarApiKey: 'AIzaSyAOPKgdIHF_YK7Y2b5aPT8ipBHRe-5m034',
        			eventSources: [
        				{
            				googleCalendarId: 'k8vm6pte6ulukc7anhe9c4i9go@group.calendar.google.com',
            				color: '#DB944D',
        				},
        				{
        					googleCalendarId: 'enggn3kale0s2ps57q6bu84bqo@group.calendar.google.com',
        					color: '#111111',
        					rendering: 'background'
        				}
        			],
        			loading: assignEventColors
    			});
    			
    			function assignEventColors(isLoading, view)
				{
					// This function is fired twice, when the data is loading and again
					// the data is finished loading. If it's loading, just return.
					if (isLoading) { return true; }
					
					// A list of colors. I will use JQuery to assign events with the same ID
					// colors based on the order they appear in the calendar.
					var colors = ['#DB944D', '#9BADFF', '#99CCB2', '#EB99EB', '#FFF9F9', '#FFFFC2', '#C2C2D6'];
				
					// Make all of the calendar links open up in new tabs:
					$('#calendar a').attr('target','_blank');
				
					// Assign the colors
					var assignedColors = {};
					var colorIndex = 0;
					//console.log('containers: ', $('#calendar a'));
					var calendarEvents = $('#calendar .fc-event-container a');
					calendarEvents.each(function(index)
					{
						var href = $(this).attr('href');
						if (!(href in assignedColors))
						{
							assignedColors[href] = colors[colorIndex % colors.length];
							//console.log('color: ', assignedColors[href]);
							colorIndex += 1;
						}
					});
				
					calendarEvents.each(function(index)
					{
						var colorStr = assignedColors[$(this).attr('href')];
						var newStyle = 'background-color:'+colorStr+';border-color:'+colorStr;
						//console.log('newStyle: ', newStyle);
						$(this).attr('style', newStyle); 
					});
				}
			});
		",
		CClientScript::POS_READY
	);
	
	Yii::app()->clientScript->registerCss(
		'custom_fullcalendar_css',
		'
			#calendar a
			{
				target-name:new;
				target-new:tab;
			}	
			
			#calendar a:link
			{
				text-shadow: none;
			}
			
			#calendar a:visited
			{
				text-shadow: none;
			}
			
			.fc-bgevent
			{
				opacity: 0.6;
			}
			
			#calendar h2
			{
				font: normal 2em Tahoma, Helvetica, Arial, Sans-Serif;
				color: #555;
				text-shadow: none;
			}
		',
		'screen'
	);
	
	//
	// End of FullCalendar file support
	//
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

<?php
	// If our vacation message is up, move the product_container down a little bit.
	$vacationMode = $this->getVacationModeOption();
	if ($vacationMode['enabled'])
	{
		echo "<br />";
	}
?>

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
		<div id="calendar"></div>
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
					<b>
						<?php echo '$' . $model->price . ' USD'; ?>
					</b>
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
						
					//echo CHtml::link('Size Chart', $this->createUrl('site/page', array('view'=>'size-chart')), array('target'=>'_BLANK', 'class'=>'size_chart_2'));
					echo CHtml::link(
						'Size Chart', 
						Yii::app()->baseUrl.'/images/Size-Chart.png', 
						array(
							'target'=>'_BLANK', 
							'class'=>'size_chart_2', 
							'title'=>'Size Chart',
							'onclick' => "
								window.open('".$this->createAbsoluteUrl('site/SizeChart')."','popup','width=820,height=1360,scrollbars=yes,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0'); return false
							"
						)
					);
					//echo "<a class='size_chart' href='#size_chart_data' >Size Chart</a>";
					?>
					<div class='hidden_data'>
						<img id='size_chart_data' width='800px' height='1340px' src="<?php echo Yii::app()->baseUrl . '/images/Size-Chart.png'; ?>" />
						<div id='size_chart_data_2'>
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
				if ($model->out_of_stock == 1)
				{
					echo "<div>Out of Stock</div>";
				}
				else if (true == constant('VACATION_MODE'))
				{
					echo "<div>Won't be available until March 12th</div>";
				}
				else
				{
					echo CHtml::linkButton(
						"<i class='icon-shopping-cart'></i> Add to Cart",
						array(
							'class' => 'btn btn-inverse',
						)
					);
				}
				echo "</div>";
				
				
				$this->endWidget();
			?>
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
			
				<div class="fb-like" data-href="https://www.facebook.com/PIECESOF8COSTUMES" data-width="100" data-show-faces="true"></div>
			</div>
			
			<div id="tabs_container">
				<ul id="tabs">
					<li class="active"><a href="#nav_shipping">Shipping</a></li>
					<li><a href="#nav_returns">Exchanges</a></li>
					<li><a href="#nav_care">Care</a></li>
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
					adjustments can be made to all orders; the item will need to be mailed 
					back with clear instructions of the adjustments needed. The item will 
					be shipped back out within 3-5 business days.
					<br /><br />
					Please Read our full 
					<?php
						echo CHtml::link(
							"Exchange Policy",
							$this->createUrl('site/page', array('view'=>'faq', '#'=>'return-policy')),
							array(
								'title' => "Costume Exchange Policy"
							)
						);
					?>
					</p>
				</div>
				<div id="nav_shipping" class="tab">
					<p>
					Items will be shipped via UPS or USPS standard ground with tracking, 
					3-10 days from date shipped. U.S. and International rates are calculated
					via the table below. Rush delivery available for an additional 
					fee depending on the destination.
					</p>
					<table style="display: inline-block; text-align: center; font-size: 10.5pt;" border="1" align="center" cellpadding="3">
						<tr>
							<th colspan=2>USA</th>
						</tr>
						<tr>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
						<tr>
							<td>Base</td>
							<td>$<?php echo number_format($model->ship_domestic_primary,2) . " "; ?>USD</td>
						</tr>
						<tr>
							<td>Additional</td>
							<td>$<?php echo number_format($model->ship_domestic_secondary,2) . " "; ?>USD</td>
						</tr>
					</table>
					<table style="display: inline-block; text-align: center; font-size: 10.5pt;" border="1" align="center" cellpadding="3">
						<tr>
							<th colspan=2>International</th>
						</tr>
						<tr>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
						<tr>
							<td>Base</td>
							<td>$<?php echo number_format($model->ship_international_primary,2) . " "; ?>USD</td>
						</tr>
						<tr>
							<td>Additional</td>
							<td>$<?php echo number_format($model->ship_international_secondary,2) . " "; ?>USD</td>
						</tr>
					</table>
					<p>
						In stock items will be shipped out within 3-7 business days of the order.
						Custom orders will take 3-6 weeks to ship. Overseas orders are subject 
						to additional shipping fees, all customs and taxes will be the 
						responsibility of the purchaser.
					</p>
					<p>
						Shipping rates are calculated by using the item in your cart with the largest
						<b>Base</b> shipping rate, then adding the <b>Additional</b> shipping rates of the remaining
						items. See <?php 
							echo CHtml::link(
								"Example Shipping Calculation",
								$this->createUrl('site/page', array('view'=>'faq', '#'=>'example-shipping-calculation')),
								array(
									'title' => "Costume Exchange Policy"
								)
							);
						?> for more details.
					</p>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<div id="fb-root"></div>
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