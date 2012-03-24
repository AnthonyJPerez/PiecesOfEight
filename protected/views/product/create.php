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
			#create-form .row div
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
		',
		'screen'
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


		<div class="row images_row">
			<label><?php echo GxHtml::encode($_Product->getRelationLabel('images')); ?></label>
			<?php
			// Images
			$this->widget('CMultiFileUpload', array(
			    'name' => 'images',
			    'accept' => 'jpeg|jpg|gif|png', // useful for verifying files
			    'duplicate' => 'Duplicate file!', // useful, i think
			    'denied' => 'Invalid file type', // useful, i think
			));
			?>
		</div>
		
		
		<!-- Sizes -->
 		<div class="row">
 			<label><?php echo GxHtml::encode($_Product->getRelationLabel('p8Sizes')); ?></label>
 			<div>
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
		
		
		<div class="row">
			<?php echo $form->labelEx($_Product,'size_chart'); ?>
			<div>
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
			<div>
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