<?php
	$details = "";
	switch ($error)
	{		
		case "do":
			$details = "<b>Note: Please check whether or not your card has been charged.</b>";
			break;
			
		default:
			$details = "<b>Note: Your credit card has not been charged.</b>";
			break;
	}
?>

<h1>Payment Error</h1>

<p>
	Oops, we received an error from Paypal during the checkout process! <br /><br /><?php echo $details; ?><br /><br />
	Please <?php echo CHtml::link('contact our support team', $this->createUrl('site/contact'), array('title'=>'Contact Pieces of Eight Costumes')); ?>
	so that we may help you to solve the problem.
</p>

