<?php 
	
	$this->pageTitle = "Feedback | " . $this->pageTitle;
	$this->pageDescription = "Check out what others think about our handmade costumes! Bought a costume from us? Leave a comment and let the world
	know how much you love your unique pirate costume!";
	
	$this->pageKeywords = "Leave a comment, pirate costume, handmade costume, leave feedback";



	Yii::app()->clientScript->registerCss(
		'comments-style',
		'
			#comments_container
			{
				margin-top: 2em;
				
			}
			
			.comment
			{
				margin-bottom: 2em;
				border-top: 2px solid grey;
				padding-top: 0.5em;
				margin: 0 auto;
				width: 85%;
				position: relative;
				
				font-style: italic;
				color: #333;
			}
			
			.comment p:before
			{
				content: open-quote;
				font-size: 18pt;
				text-shadow: 0 1px 1px #909090;
			}
			
			.comment p:after
			{
				content: no-close-quote;
			}
			
			.comment img
			{
				margin-right: 1.5em;
				margin-bottom: 1em;
				margin-top: 1em;
			}
			
			.comment .date
			{
				font-weight: bold;
				font-size: 8pt;
				position: absolute;
				right: 0;
				bottom: 0;
			}
			
			.comment .source
			{
				font-size: 10pt;
			}
		',
		'screen'
	);
?>

<h1>Leave us some Feedback</h1>

<p>
	We love to hear from our customers! If you would like to leave us a comment, 
	or show off your new costume, just drop us a line at our <?php echo CHtml::link('Contact Page', $this->createUrl('site/contact')); ?>
</p>


<div id="comments_container">
	
	<div class="comment">
		<?php
			$product = Product::model()->findByPk(28);
			$imgUrl = "";
			$imgAlt = "";
			$productUrl = "";
			
			if ($product->id)
			{
				$imgUrl = $product->getDefaultImage()->url;
				$imgAlt = $product->getProductImgAltDescription();
				$productUrl = $product->getUrl();
			}
			
			// Display the default image for this product
			$img = CHtml::image(
				Yii::app()->request->baseUrl . '/images/product-images/' . $imgUrl,
				$imgAlt,
				array('width'=>140, 'align'=>'left')
			);
			
			echo CHtml::link(
				$img,
				$productUrl
			);
		?>
		
		<p>
			Absolutely exactly what I was hoping for. It looks great with all of my vests and ascots. Totally worth every penny.
		</p>
		
		<span class="source">
			Anonymous from 
			<?php 
				echo CHtml::link(
					'Etsy',
					"http://www.etsy.com/people/susanperez3/feedback", 
					array(
						'target'=>'_blank',
						'rel' => "nofollow"
					)
				);
			?>
		</span>
		
		<span class="date">
			June 30, 2012
		</span>
	</div>
	
	
	
	<br /><br /><br /><br /><br />
	<div class="comment">
		<?php
			$product = Product::model()->findByPk(38);
			$imgUrl = "";
			$imgAlt = "";
			$productUrl = "";
			
			if ($product->id)
			{
				$imgUrl = $product->getDefaultImage()->url;
				$imgAlt = $product->getProductImgAltDescription();
				$productUrl = $product->getUrl();
			}
			
			// Display the default image for this product
			$img = CHtml::image(
				Yii::app()->request->baseUrl . '/images/product-images/' . $imgUrl,
				$imgAlt,
				array('width'=>140, 'align'=>'left')
			);
			
			echo CHtml::link(
				$img,
				$productUrl
			);
		?>
		
		<p>
			Thank you so much! The coat is absolutely gorgeous, wonderfully made and I have been pretty much wearing it EVERYWHERE. ♥
		</p>
		
		<span class="source">
			Anonymous from 
			<?php 
				echo CHtml::link(
					'Etsy',
					"http://www.etsy.com/people/susanperez3/feedback", 
					array(
						'target'=>'_blank',
						'rel' => "nofollow"
					)
				);
			?>
		</span>
		
		<span class="date">
			June 8, 2012
		</span>
	</div>
	
	
	
	<br /><br /><br /><br /><br />
	<div class="comment">
		<?php
			$product = Product::model()->findByPk(38);
			$imgUrl = "";
			$imgAlt = "";
			$productUrl = "";
			
			if ($product->id)
			{
				$imgUrl = $product->getDefaultImage()->url;
				$imgAlt = $product->getProductImgAltDescription();
				$productUrl = $product->getUrl();
			}
			
			// Display the default image for this product
			$img = CHtml::image(
				Yii::app()->request->baseUrl . '/images/product-images/' . $imgUrl,
				$imgAlt,
				array('width'=>140, 'align'=>'left')
			);
			
			echo CHtml::link(
				$img,
				$productUrl
			);
		?>
		
		<p>
			This coat is absolutely beautiful! I had a very difficult time finding a traditional pirate-style coat to fit a woman. Susan's design takes the feminine form into account and creates a fit and drape that are just right. I can't say enough good things! Thank you!
		</p>
		
		<span class="source">
			Anonymous from 
			<?php 
				echo CHtml::link(
					'Etsy',
					"http://www.etsy.com/people/susanperez3/feedback", 
					array(
						'target'=>'_blank',
						'rel' => "nofollow"
					)
				);
			?>
		</span>
		
		<span class="date">
			May 29, 2012
		</span>
	</div>
</div>








		
	
	
	
	