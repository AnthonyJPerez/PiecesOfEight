<?php
	$this->pageTitle = "Purchase Complete | " . $this->pageTitle;
?>
<h1>Ahoy! Thanks for Purchasing</h1>

<p>
	Aye, thank you for purchasing from Pieces of Eight Costumes!  We hath received yer order. 
	Ye shall receive an email shortly containing yer invoice and estimated shipping information.
</p>
<p>
	Have question about your order? <?php echo CHtml::link('Email us here', $this->createUrl('site/contact'), array('title'=>'Questions about your Pieces of Eight Costumes Order')); ?>
</p>


/*
	link to other pages?
	link to social media
	
	offer discounts for next order?
	show other items they may be interested in?
	
	link to contact page
*/