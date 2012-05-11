<?php
	/* product/create view */


	Yii::app()->clientScript->registerCss(
		'product-custom-form-style',
		'
			#product_list, #selected_products
			{
				width: 675px
			}
			
			#product_list li, #selected_products li
			{
				width: 175px;
			}
			
			.product_listing_text
			{
				display: block;
				margin-top: 0.5em;
				font-size: 0.85em;
			}
			
			.product_name
			{
				display: block;
			}
			
			.mb-panel {
			    opacity: 0.75;
			    filter: alpha(opacity=75);   
			}
			.mb-panel.current {
			    opacity: 1;
			    filter: alpha(opacity=100);
			}
		',
		'screen'
	);
	
	
	// Include the jquery library
	Yii::app()->clientScript->registerCoreScript('jquery');
	
	
	//
	// Include the fancybox script
	//
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
	
	
	
	
	//
	// Include the movingboxes script
	//
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/movingboxes/js/jquery.movingboxes.js', 
		CClientScript::POS_HEAD
	);
	
	// Include the fancybox css file
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->request->baseUrl . '/js/movingboxes/css/movingboxes.css',
		'screen'
	);
	
	
	
	
	
	Yii::app()->clientScript->registerScript(
		'Movingboxes_CustomProduct',
		'
			$("#product_list").movingBoxes({
				reducedSize	 : 0.75,
				speed     	 : 100,
				easing	 : "linear",
				fixedHeight  : true,
				startPanel   : 1,      // start with this panel
				wrap         : true,   // if true, the panel will "wrap" (it really rewinds/fast forwards) at the ends
				buildNav     : false,   // if true, navigation links will be added
				navFormatter : function(index, panel){ return panel.find("span").text(); }, // function which returns the navigation text for each panel
			
				// callback when MovingBoxes has completed initialization
				initialized: function(e, slider, tar)
				{
					// Hide all non-current panel text
					slider.$panels.filter(":not(:eq(" + (tar) + "))").find("button").hide();
				},
				
				// callback upon change panel initialization
				initChange: function(e, slider, tar)
				{
					var t = (tar < 1) ? slider.totalPanels : (tar > slider.totalPanels) ? 1 : tar,
					$tar = slider.$panels.eq(t);
					// hide non-current panel text
					slider.$panels.not($tar).find("button").slideUp("fast");
					// show current panel text
					$tar.find("button").slideDown("fast");
				}
			});
			
			$("#selected_products").movingBoxes({
				reducedSize	 : 0.75,
				speed     	 : 100,
				easing	 : "linear",
				fixedHeight  : true,
				startPanel   : 1,      // start with this panel
				wrap         : true,   // if true, the panel will "wrap" (it really rewinds/fast forwards) at the ends
				buildNav     : false,   // if true, navigation links will be added
				navFormatter : function(index, panel){ return panel.find("span").text(); }, // function which returns the navigation text for each panel
			});
			
			var imageNumber = 0,
			navLinks = function()
			{
				var i, t = "", len = $("#selected_products").getMovingBoxes().totalPanels + 1;
				for ( i = 1; i < len; i++ ) {
					t += "<a>" + i + "</a> ";
				}
				$(".dlinks").find("span").html(t);
			},		
			panel = "<li class=\"product_listing\"><img href=\"*1\" /><p><span class=\"product_name\">*2</span></p></li>";
			slider = $("selected_products");
			
			$("button.add").click(function()
			{
				//slider.append( panel.replace(/\*2/g, ++imageNumber).replace(/\*1/g, "Product") )
				slider.append("<li><img href=test.jpg></img><p>HELLO</p></li>");
				slider.movingBoxes(); // Update movingboxes.
				navLinks();
			});
			
			$("button.remove").click(function()
			{
				var d = slider.data("movingBoxes"),
					c = d.curPanel,
					t = d.totalPanels;
					
				if (t > 1) {
					slider.find(".mb-panel:not(.clined):last").remove();
					if (c > t - 1) { c = t - 1; }
					slider.movingBoxes(); // update movingboxes
				}
				navLinks();
			});
		',
		CClientScript::POS_READY
	);
	
	
	Yii::app()->clientScript->registerScript(
		'Fancybox_CustomProduct',
		"
		
			$('a[img]').fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over'
			});
		",
		CClientScript::POS_READY
	);
	
?>

<div id='custom_product_container'>
	<br />
	<ul id='product_list'>
	<?php
		foreach ($_AllProducts as $product)
		{
		?>
			<li class='product_listing'>
			<?php
				echo CHtml::image(
					Yii::app()->request->baseUrl . '/images/product-images/' . $product->defaultImage->url,
					$product->name,
					array('width'=>150)
				);
				echo "<p class='product_listing_text'>";
				echo "<span class='product_name'>".$product->name."</span>";
				echo "<button class='add'>Add</button>";
				echo "</p>"
			?>
			</li>
		<?php
		}
	?>
	</ul>
	
	<ul id='selected_products'>
	
	</ul>
</div>