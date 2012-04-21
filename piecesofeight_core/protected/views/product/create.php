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
			
				#create-form .uploaded_item_input
				{
					width: 20px !important;
					position: absolute;
					left: 0;
					top: 0;
				}
				
				
			
			
		',
		'screen'
	);
	
	
	// Include the jquery library
	Yii::app()->clientScript->registerCoreScript('jquery');
	
	
	Yii::app()->clientScript->registerScript(
		'uploaded-item-event',
		'
			$(".uploaded_item_input").change(function() 
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
	
	
	// Include the clearbox script
	Yii::app()->clientScript->registerScriptFile( 
		Yii::app()->request->baseUrl . '/js/clearbox.js', 
		CClientScript::POS_HEAD
	);
?>

<div id="create-form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'product-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($_Product); ?>

		<div class="row">
		<?php echo $form->labelEx($_Product,'name'); ?>
		<?php echo $form->textField($_Product, 'name', array('maxlength' => 255)); ?>
		<?php echo $form->error($_Product,'name'); ?>
		</div><!-- row -->
		
		<div class="row price">
		<?php echo $form->labelEx($_Product,'price'); ?>
		<?php echo $form->textField($_Product, 'price', array('maxlength' => 6)); ?>
		<?php echo $form->error($_Product,'price'); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($_Product,'description'); ?>
		<?php echo $form->textArea($_Product, 'description'); ?>
		<?php echo $form->error($_Product,'description'); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($_Product,'care_information'); ?>
		<?php echo $form->textArea($_Product, 'care_information'); ?>
		<?php echo $form->error($_Product,'care_information'); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($_Product,'category_id'); ?>
		<?php echo $form->dropDownList($_Product, 'category_id', GxHtml::listDataEx(Category::model()->findAllAttributes(null, true)), array('empty'=>'Select a Category')); ?>
		<?php echo $form->error($_Product,'category_id'); ?>
		</div><!-- row -->


		<!-- Images -->
		<div class="row images_row">
			<label><?php echo GxHtml::encode($_Product->getRelationLabel('images')); ?></label>
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
		
		<div class="row previously_uploaded">
			<label>Previously Uploaded</label>
				<span class="note">
					Uncheck an image to delete it:
				</span>
				<div class="previously_uploaded_container">
				<?php
					// Show previously uploaded images
					echo "<input id='ytProduct_images' type='hidden' value name='Product[images]'>";
					$count = 0;
					foreach ($_Product->images as $image)
					{
						$imgName = Yii::app()->baseUrl.'/images/product-images/'.$image->url;
						echo "<div class='uploaded_item'>";
							echo "<a href='".$imgName."' rel='clearbox[gallery=uploaded_gallery]'>";
								echo "<img src='".$imgName."' />";
							echo "</a>";
							
							// Insert a checkbox!
							echo "<input class='uploaded_item_input' id='Product_images_".$count."' value='".$image->id."' checked='checked' type='checkbox' name='Product[images][]'>";
							$count++;
						echo "</div>";
					}
					
					//echo $form->checkBoxList($_Product, 'images', GxHtml::encodeEx(GxHtml::listDataEx($_Product->images), false, true)); 
				?>
				</div>
		</div>
		
		
		<!-- Sizes -->
 		<div class="row">
 			<label><?php echo GxHtml::encode($_Product->getRelationLabel('p8Sizes')); ?></label>
 			<div class="main_container">
				<span class="note">
					Check the sizes supported by this product:
				</span>
				<div class="sizes">
					<?php 
						echo $form->checkBoxList($_Product, 'p8Sizes', GxHtml::encodeEx(GxHtml::listDataEx(Size::model()->findAllAttributes(null, true)), false, true)); 
					?>
				</div>
			</div>
		</div>
		
		
		<!-- Size Chart -->
		<div class="row">
			<?php echo $form->labelEx($_Product,'size_chart'); ?>
			<div class="main_container">
				<span class="note">
 					Enter the size chart specific to this product:
 				</span>
				<?php echo $form->textArea($_Product, 'size_chart'); ?>
				<?php echo $form->error($_Product,'size_chart'); ?>
			</div>
		</div><!-- row -->
		
		
		
		<!-- Tags -->
		<div class="row">
			<label><?php echo GxHtml::encode($_Product->getRelationLabel('p8Tags')); ?></label>
			<div class="main_container">
				<span class="note">
					Check any appropriate tags:
				</span>
				<div class="tags">
					<?php 
						echo $form->checkBoxList($_Product, 'p8Tags', GxHtml::encodeEx(GxHtml::listDataEx(Tag::model()->findAllAttributes(null, true)), false, true),
							array('labelOptions'=>array('checked'))); 
					?>
				</div>
			</div>
		</div>
		

<?php
	echo "<div class='row buttons'>";
		echo GxHtml::submitButton(Yii::t('app', 'Create Product'));
	echo "</div>";
$this->endWidget();
?>
</div><!-- form -->