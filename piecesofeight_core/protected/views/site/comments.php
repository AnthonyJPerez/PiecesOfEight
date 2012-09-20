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
			
			.comment,
			.comment_reversed
			{
				width: 85%;
				position: relative;
				overflow: auto;
				margin-bottom: 2em;
				border-top: 2px solid grey;
				padding-top: 0.5em;
				margin: 0 auto;				
				font-style: italic;
				color: #333;
			}
			
			.comment .img_container,
			.comment_reversed .text_container
			{
				float: left;
			}
			
			.comment .text_container,
			.comment_reversed .img_container
			{
				float: right;
			}
			
			.img_container
			{
				width: 23%;
				height: 120px;
				margin-top: 1em;
				margin-bottom: 4em;
				margin-left: 0.25em;
				overflow: hidden;
				border-radius: 2px;
			}
			
			.comment p:before,
			.comment_reversed p:before
			{
				content: open-quote;
				font-size: 18pt;
				text-shadow: 0 1px 1px #909090;
			}
			
			.comment p:after,
			.comment_reversed p:after
			{
				content: no-close-quote;
			}
			
				.img_container img
				{
					width: 100%;
				}
			
			.text_container
			{
				width: 74%;
			}
			
			.date
			{
				font-weight: bold;
				font-size: 8pt;
				float: right;
				margin-top: 1.5em;
				margin-right: 2em;
			}
			
			.source
			{
				float: left;
				margin-top: 1em;
				margin-left: 0.5em;
				font-size: 10pt;
			}
			
			.
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

	<?php foreach ($_Comments as $comment)
	{
	?>
		<div class="comment">
			<?php
				$product = $comment->product;
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
					array('width'=>140, 'class' => 'img')
				);
			?>
			<div class='img_container'>
				<?php echo CHtml::link($img, $productUrl); ?>
			</div>
			<div class='text_container'>
				<p>
					<?php echo $comment->comment; ?>
				</p>
				
				<span class="source">
					<?php echo $comment->geo_location; ?> on
					<?php 
						echo CHtml::link(
							$comment->web_location,
							"http://www.etsy.com/people/susanperez3/feedback", 
							array(
								'target'=>'_blank',
								'rel' => "nofollow"
							)
						);
					?>
				</span>
				
				<span class="date">
					<?php 
						$date = new DateTime($comment->date_inserted);
						echo $date->format('F j, Y');
					?>
				</span>
			</div>
		</div>
	<?php
	}
	?>
	
</div>








		
	
	
	
	