<?php
	$this->pageTitle = "Frequently Asked Questions | " . $this->pageTitle;
	
	$this->pageDescription = "Have a question regarding a costume? Want to learn how to custom-order a costume?
	Read our most frequently-asked questions to learn the answer!";
	
	$this->pageKeywords = "Frequently Asked Questions, How to custom order, common questions";



	Yii::app()->clientScript->registerCss(
		'faq-style',
		'	
			.questions
			{
				list-style: none;
			}
			
			.question
			{
				font-weight: bold;
			}
			
			
		',
		'screen'
	);


?>
<h1>Frequently Asked Questions</h1>

<p>
	<?php
		$contactLink = CHtml::link(
			"ask it here",
			$this->createUrl('site/contact'),
			array(
				'title' => 'Contact Pieces of Eight Costumes'
			)
		);
	?>
	Take a look at our most frequently asked questions below. If you can't find the answer to
	your question, please feel free to <?php echo $contactLink; ?>.
</p>


<!-- Questions -->
<h2 id="custom-orders">
	Custom Orders
</h2>

<ul class='questions'>
	<li>
		<a href="#how-to-custom-order">
			How do I Custom Order a product from Pieces of Eight Costumes?
		</a>
	</li>
</ul>



<!-- Answers -->
<h2>
	Custom Orders
</h2>

<div>
	<span id="how-to-custom-order" class='question'>
		How do I Custom Order a product from Pieces of Eight Costumes?
	</span>
	<p>
		<?php
			$customOrderLink = CHtml::link(
				"Custom Order Form",
				$this->createUrl('product/custom'),
				array(
					'title' => 'Custom Order Form'
				)
			);
		?>
		To Custom Order a product, fill-out our <?php echo $customOrderLink; ?>
	</p>
</div>