<?php
	/* product/create view */


	Yii::app()->clientScript->registerCss(
		'product-create-form-style',
		'
		#create-form
		{
			margin: 0 auto;
			width: 75%;
		}
		
		#create-form .row
		{
			position: relative;
			clear: both;
			margin: .75em;
			min-height:2em;
		}
			#create-form .row .main_container
			{
				width: 70%;
				display: inline-block;
			}
			
			#create-form textarea
			{
				min-height: 100px;
			}
		
			#create-form .row label
			{
				display: inline-block;
				width: 140px;
				text-align: right;
				margin-right: 0.5em;
				vertical-align: top;				
			}
			
			#create-form .row input, #create-form .row textarea
			{
				display: inline-block;
				padding: 4px 2px;
				width: 300px;
			}
			
			#create-form .price input
			{
				width: 50px;
			}
			
			#create-form .errorMessage
			{
				vertical-align: top;
				display: block;
				width: 250px;
				margin-left: 0.5em;
			}
			
			#create-form .hint
			{
				font-size: 10pt;
				width: 200px;
				display: inline-block;
				margin-left: 1em;
			}
			
			#create-form .buttons
			{
				width: 50%;
				margin: 3em auto;
			}
			
			#create-form .buttons > input
			{
				width: 100px;
				
			}
			
			#images_wrap
			{
				display: inline-block;
			}
			
			#create-form .sizes, #create-form .tags
			{
				margin: 0.5em;
			}
					
				#create-form .sizes input, #create-form .tags input
				{
					width: 20px
				}
				
				#create-form .sizes label
				{
					text-align: left;
					width: 50px;
				}
				
				#create-form .tags label
				{
					text-align: left;
					width: 150px;
				}
			
			.previously_uploaded
			{
				position: relative;
			}
			
			.previously_uploaded_container
			{
				width: 75%;
				float: right;
				padding: 1em;
			}
				
			#create-form .uploaded_item
			{
				position: relative;
				margin-right: 10px;
				margin-bottom: 10px;
				padding: 0;
				display: inline-block;
			}
			
				#create-form .uploaded_item a, #create-form .uploaded_item a img
				{
					margin: 0;
					padding: 0;
				}
			
				#create-form .uploaded_item a img
				{
					width: 75px;
					border: 5px solid green;
					border-radius: 4px;
				}
			
				#create-form .uploaded_item_checkbox
				{
					width: 20px !important;
					position: absolute;
					left: -4px;
					top: -3px;
				}
				
				#create-form .uploaded_item_radio
				{
					width: 20px !important;
					position: absolute;
					left: -4px;
					bottom: -4px;
				}
			
			
		',
		'screen'
	);
	
	
	// Include the jquery library
	Yii::app()->clientScript->registerCoreScript('jquery');
	
	
	Yii::app()->clientScript->registerScript(
		'uploaded-item-event',
		'
			$(".uploaded_item_checkbox").change(function() 
			{
				if (this.checked)
				{
					$(this).parent().find("img").css("border-color", "green");
				}
				else
				{
					$(this).parent().find("img").css("border-color", "red");
				}
			});
		',
		CClientScript::POS_READY
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
	
	Yii::app()->clientScript->registerScript(
		'Fancybox_Product',
		"
		
			$('a[rel=img_gallery]').fancybox({
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
?>

<div id="create-form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'gallery-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
?>

<!-- Images -->
<div class="row images_row">
	<label><?php echo "Images"; ?></label>
	<ul>
		<li><span class="note">To look right, images should be 700px (width) by 525px (height)</span></li>
	</ul>
	<div class="main_container">
		
	<?php
		// Image Uploader
		$this->widget('CMultiFileUpload', array(
		    'name' => 'images',
		    'accept' => 'jpeg|jpg|gif|png', // useful for verifying files
		    'duplicate' => 'Duplicate file!', // useful, i think
		    'denied' => 'Invalid file type', // useful, i think
		));
	?>
	</div>
</div>

<!-- Previously Uploaded Images -->
<div class="row previously_uploaded">
	<label>Previously Uploaded</label>
		<ul>
			<li><span class="note">Uncheck an image to delete it.</span></li>
		</ul>
		<div class="previously_uploaded_container">
		<?php		
			// Show previously uploaded images
			echo "<input id='ytGallery_images' type='hidden' value name='Gallery[images]'>";
			foreach ($_Gallery as $image)
			{
				$imgName = Yii::app()->baseUrl.'/images/gallery/'.$image->url;
				echo "<div class='uploaded_item'>";
					echo "<a href='".$imgName."' rel='img_gallery'>";
						echo "<img src='".$imgName."' />";
					echo "</a>";
					
					// Insert a checkbox!
					echo "<input class='uploaded_item_checkbox' id='Gallery_images_".$count."' value='".$image->id."' checked type='checkbox' name='Gallery[images][]'>";
				echo "</div>";
			}			
		?>
		</div>
</div>		

<?php
	echo "<div class='row buttons'>";
		echo GxHtml::submitButton(Yii::t('app', 'Update Gallery'));
	echo "</div>";
$this->endWidget();
?>
</div><!-- form -->