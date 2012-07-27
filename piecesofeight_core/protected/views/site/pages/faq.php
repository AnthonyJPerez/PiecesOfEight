<?php
	$this->pageTitle = "Frequently Asked Questions | " . $this->pageTitle;
	
	$this->pageDescription = "Have a question regarding a costume? Want to learn how to custom-order a costume?
	Read our most frequently-asked questions to learn the answer!";
	
	$this->pageKeywords = "Frequently Asked Questions, How to custom order, common questions";

	$this->pageCanonical = Yii::app()->request->hostInfo . $this->createUrl('site/page', array('view'=>'faq'));


	Yii::app()->clientScript->registerCss(
		'faq-style',
		'	
			.category
			{
				padding: 0.5em;
			}
			
			.category > span
			{
				font-weight: bold;
				font-size: 1.1em;
				color: #444;
			}
			
			.category > ul
			{
				list-style: none;
				margin: 0.25em;
			}
			
			.answers > li > span
			{
				font-weight: bold;
				font-style: italic;
				color: #444;
			}
			
			#seller-information
			{
				list-style: none;
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
<div id="question-categories">
	<div class='category'>
		<span id="shopping-questions">Shopping</span>
		<ul class='questions'>
			<li>
				<a href="#determine-size">
					How do I know what size I am?
				</a>
			</li>
			<li>
				<a href="#plus-sizes">
					Do you carry petite, plus, or extended sizes?
				</a>
			</li>
			<li>
				<a href="#reserve">
					Can I reserve an item?
				</a>
			</li>
			<li>
				<a href="#no-longer-listed">
					What if the item that I wanted is no longer listed?
				</a>
			</li>
			<li>
				<a href="#time-to-receive">
					How long will it take to receive my item?
				</a>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="order-help-questions">Order Help</span>
		<ul class='questions'>
			<li>
				<a href="#cancelling">
					Can I cancel or modify my order?
				</a>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="custom-order-questions">Custom Orders</span>
		<ul class='questions'>
			<li>
				<a href="#how-to-custom-order">
					How do I Custom Order an item?
				</a>
			</li>
			<li>
				<a href="#time-for-custom-orders">
					How long does it take to construct a custom order?
				</a>
			</li>
			<li>
				<a href="#additional-fees-custom-orders">
					Are there any additional fees associated with custom orders?
				</a>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="payment-option-questions">Payment Options</span>
		<ul class='questions'>
			<li>
				<a href="#payment">
					What forms of payment do you accept?
				</a>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="shipping-questions">Shipping</span>
		<ul class='questions'>
			<li>
				<a href="#time-to-ship">
					How long does shipping take?
				</a>
			</li>
			<li>
				<a href="#shipping-charges">
					What are the charges for shipping and handling?
				</a>
			</li>
			<li>
				<a href="#international-shipping">
					Do you ship internationally?
				</a>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="refunds-and-exchanges-questions">Refunds &amp; Exchanges</span>
		<ul class='questions'>
			<li>
				<a href="#return-policy">
					What is your return policy?
				</a>
			</li>
			<li>
				<a href="#wrong-size">
					What if my item does not fit?
				</a>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="technical-questions">Technical</span>
		<ul class='questions'>
			<li>
				<a href="#technical-problems">
					I am having problems accessing your website.
				</a>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="contact-questions">Contact</span>
		<ul class='questions'>
			<li>
				<a href="#newsletter-signup">
					How can I sign up for your newsletter?
				</a>
			</li>
			<li>
				<a href="#how-to-contact">
					How can I contact you?
				</a>
			</li>
		</ul>
	</div>
</div>






<?php
	$customOrderLink = CHtml::link(
		"Custom Order Form",
		$this->createUrl('product/custom'),
		array(
			'title' => 'Custom Order Form'
		)
	);
	
	$sizeChartLink = CHtml::link(
		"Size Chart",
		//$this->createUrl('site/page', array('view'=>'size-chart')),
		Yii::app()->baseUrl.'/images/Size-Chart.png',
		array(
			'title' => 'Size Chart',
			'target' => '_BLANK',
			'onclick' => "window.open('".$this->createAbsoluteUrl('site/SizeChart')."','popup','width=820,height=1360,scrollbars=yes,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0'); return false"
		)
	);
	
	$regularSizesLink = CHtml::link(
		"regular sizes",
		//$this->createUrl('site/page', array('view'=>'size-chart')),
		Yii::app()->baseUrl.'/images/Size-Chart.png',
		array(
			'title' => 'Size Chart',
			'target' => '_BLANK',
			'onclick' => "window.open('".$this->createAbsoluteUrl('site/SizeChart')."','popup','width=820,height=1360,scrollbars=yes,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0'); return false"
		)
	);
	
	$contactUsLink = CHtml::link(
		"Contact Us",
		$this->createUrl('site/contact'),
		array(
			'title' => "Contact Pieces of Eight Costumes"
		)
	);
	
	$etsyLink = CHtml::link(
		"Etsy Shop",
		"https://www.etsy.com/shop/PiecesOf8Costumes",
		array(
			'title' => "Pieces of Eight Costumes Etsy Shop",
			'target'=>'_blank',
			'rel' => "nofollow"
		)
	);
	
	$facebookLink = CHtml::link(
		"Facebook",
		"https://www.facebook.com/PiecesOf8Costumes",
		array(
			'title' => "Pieces of Eight Costumes Facebook Page",
			'target' => '_blank',
			'rel' => "nofollow"
		)
	);
	
	$googleLink = CHtml::link(
		"Google+",
		"https://plus.google.com/107715338617466620653",
		array(
			'title' => "Pieces of Eight Costumes Google+ Page",
			'target' => '_blank',
			'rel' => "nofollow"
		)
	);
	
	$pinterestLink = CHtml::link(
		"Pinterest",
		"http://pinterest.com/pieceof8costume/",
		array(
			'title' => "Pieces of Eight Costumes Pinterest Board",
			'target' => '_blank',
			'rel' => "nofollow"
		)
	);
	
	$paypalLink = CHtml::link(
		"PayPal",
		"https://www.paypal.com/home",
		array(
			'title' => "PayPal payment service",
			'target'=>'_blank',
			'rel' => "nofollow"
		)
	);
	
	$webmasterContactLink = CHtml::link(
		"Contact our Webmaster",
		$this->createUrl('site/webmasterContact'),
		array(
			'title' => 'Contact the Pieces of Eight Costumes Webmaster'
		)
	);
?>

<!-- Answers -->
<hr />
<div id="answer-categories">
	<div class='category'>
		<span id="shopping">Shopping</span>
		<ul class='answers'>
			<li>
				<span id="determine-size">
					How do I know what size I am?
				</span>
				<p>
					Determining your size is easy with the help of our <?php echo $sizeChartLink; ?>.
					You can use this chart to learn how to take your measurements as well as 
					determine what general size your measurements fall under.
				</p>
			</li>
			<li>
				<span id="plus-sizes">
					Do you carry petite, plus, or extended sizes?
				</span>
				<p>
					If your measurements do not fit within our <?php echo $regularSizesLink; ?>
					you can custom order the item and we will tailor the item to your measurements.
					You can custom order an item by filling out our <?php echo $customOrderLink; ?>
					Please note that we may need to cut a new pattern and an additional nominal
					fee to cover the time taken may apply. You will be notified in
					advance if this is necessary for your order. <b>Most items will NOT require
					a pattern making fee!</b> Also, if you are requesting an item that is 
					considerably larger than those that we offer, the actual price may be 
					slightly higher due to the extra cost of any additional materials required
					to create the item.
				</p>
			</li>
			<li>
				<span id="reserve">
					Can I reserve an item?
				</span>
				<p>
					If you would like to reserve a ready-made item that is shown in stock,
					please <?php echo $contactUsLink; ?> and we can put the item on
					hold for up to 48 hours. If at the end of the 48-hour period you have
					not committed to purchasing the item, it will be made available
					to other customers. We cannot gaurantee being able to have the exact
					same item again because the same fabric and trim may not be available.
					However, if you have missed out on an item we can always create a similar
					item for you!
				</p>
			</li>
			<li>
				<span id="no-longer-listed">
					What if the item that I wanted is no longer listed?
				</span>
				<p>
					Restocking of some of our specialty items depend upon the availability
					of the fabric. While we cannot gaurantee being able to have the
					exact same item again, if you <?php echo $contactUsLink; ?> we will work
					with you to create a similar item for you.
				</p>
			</li>
			<li>
				<span id="time-to-receive">
					How long will it take to receive my item?
				</span>
				<p>
					In-stock items will be shipped out within 1-5 days of order.
					Depending on detail and/or difficulty of a custom order, please
					allow between 3-6 weeks for construction and completion. <b>Please
					note that custom orders will not be started until at least 50%
					(half) of the payment has been received.</b> All items will be
					shipped via USPS or UPS ground with tracking. The item should be
					received 3-10 days from the date it was shipped. Next-day air is
					available upon request at an additional fee, which is based on the 
					item's size and its shipping destination.
				</p>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="order-help">Order Help</span>
		<ul class='answers'>
			<li>
				<span id="cancelling">
					Can I cancel or modify my order?	
				</span>
				<p>
					Unfortunately, once your order has been processed it cannot be
					canceled or modified. All sales are final and non-refundable.
					Please check the garment sizing and descriptions carefully before
					ordering. Please feel free to <?php echo $contactUsLink; ?> if you
					have any questions!
				</p>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="custom-orders">Custom Orders</span>
		<ul class='answers'>
			<li>
				<span id="how-to-custom-order">
					How do I custom order an item?
				</span>
				<p>
					If you would like to customize an item, please fill out our
					<?php echo $customOrderLink; ?>. Once you have completed the form,
					submit your inquiry and you will then receive a confirmation email
					stating that we have received your inquiry. After we have reviewed
					your inquiry we will send you an email containing a link that will
					direct you to your private custom order listing, where you will then
					be able to purchase your custom item. <b>Please note that custom orders
					will not be started until at least 50% (half) of the payment has been
					received.</b>
				</p>
			</li>
			<li>
				<span id="time-for-custom-orders">
					How long does it take to construct a custom order?
				</span>
				<p>
					Depending on the detail and/or difficulty of a custom order, please
					allow between 3-6 weeks for construction and completion. We will
					try to accomodate rush orders, but as it depends on our production
					schedule, they cannot be gauranteed. <b>We recommend placing your
					orders as early as possible to gaurantee early delivery.</b> An additional fee for rush orders
					may apply.
				</p>
			</li>
			<li>
				<span id="additional-fees-custom-orders">
					Are there any additional fees associated with custom orders?
				</span>
				<p>
					If your measurements do not fit within our <?php echo $regularSizesLink; ?>
					we may need to cut a new pattern. There will be an additional nominal fee
					to cover the time taken to do this, and you will be notified ahead
					of time if this action is necessary for your order. <b>Please note that 
					most of our items do NOT require a pattern-making fee.</b> If you are requesting an item
					that is considerably larger than those that we offer, the actual price
					may be slightly higher due to the extra cost of any additional
					materials required to create an item.
				</p>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="payment-options">Payment Options</span>
		<ul class='answers'>
			<li>
				<span id="payment">
					What forms of payment do you accept?	
				</span>
				<p>
					The only form of payment that Pieces of Eight Costumes
					currently accepts is <?php echo $paypalLink; ?>. With Paypal, you can choose to pay
					with oyur debit card, bank account, credit card, or the balance
					on your Paypal account. We also accept credit cards directly through
					our <?php echo $etsyLink; ?>. On Etsy, we accept Visa, Master Card,
					American Express, and Discover cards.
				</p>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="custom-orders">Shipping</span>
		<ul class='answers'>
			<li>
				<span id="time-to-ship">
					How long does shipping take?
				</span>
				<p>
					Items will be shipped via USPS or UPS ground with tracking and
					should be received within 3-10 business days from the day it
					shipped. Next day air is available on request at an additional
					fee depending on the items' size and destination.
				</p>
			</li>
			
			<li>
				<span id="shipping-charges">
					What are the charges for shipping and handling?
				</span>
				<p>
					Items will be shipped via UPS or USPS standard ground with tracking, 
					3-10 days from date shipped. U.S. and International rates can are calculated
					via the table below. Rush delivery available for an additional 
					fee depending on the destination.
				</p>
				<p>
					<table style="display: inline-block; text-align: center; font-size: 10.5pt;" border="1" align="center" cellpadding="4">
						<tr>
							<th colspan=2>USA</th>
						</tr>
						<tr>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
						<tr>
							<td>1</td>
							<td>$8.95 USD</td>
						</tr>
						<tr>
							<td>2</td>
							<td>$12.95 USD</td>
						</tr>
						<tr>
							<td>3 - 4</td>
							<td>$18.95 USD</td>
						</tr>
						<tr>
							<td>5 - 7</td>
							<td>$24.95 USD</td>
						</tr>
						<tr>
							<td>8+</td>
							<td>$35.95 USD</td>
						</tr>
					</table>
					<br />
				</p>
			</li>
			
			<li>
				<span id="international-shipping">
					Do you ship internationally?
				</span>
				<p>
					Yes! Please note that any international customs and taxes
					will be the responsibility of the purchaser. Our international
					shipping rates are calculated via the table below:
				</p>
				<p>
					<table style="display: inline-block; text-align: center; font-size: 10.5pt;" border="1" align="center" cellpadding="4">
						<tr>
							<th colspan=2>International</th>
						</tr>
						<tr>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
						<tr>
							<td>1</td>
							<td>$49.95 USD</td>
						</tr>
						<tr>
							<td>2 - 3</td>
							<td>$59.95 USD</td>
						</tr>
						<tr>
							<td>4 - 6</td>
							<td>$79.95 USD</td>
						</tr>
						<tr>
							<td>7 - 9</td>
							<td>$99.95 USD</td>
						</tr>
						<tr>
							<td>10+</td>
							<td>$150 USD</td>
						</tr>
					</table>
					<br />
				</p>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="refunds-and-exchanges">Refunds &amp; Exchanges</span>
		<ul class='answers'>
			<li>
				<span id="return-policy">
					What is your return policy?	
				</span>
				<p>
					As with many small costuming businesses, all sales are final and
					non-refundable. Please check the <?php echo $sizeChartLink; ?> and
					product descriptions carefully before ordering. Please feel free to
					<?php echo $contactUsLink; ?> and ask any questions before placing
					your order! We are more than happy to help!
				</p>
			</li>
			<li>
				<span id="wrong-size">
					What if my item does not fit?
				</span>
				<p>
					If your item does not fit it will need to be mailed back with clear
					indications of the adjustments required. It will be shipped back out
					within 3-5 business days.
				</p>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="technical">Technical</span>
		<ul class='answers'>
			<li>
				<span id="technical-problems">
					I am experience problems while accessing your website.
				</span>
				<p>
					If you are running into technical issues with our website, please
					try clearing your browser's cache and be sure that JavaScript is enabled
					in your browser and try again.
				</p>
				<p>
					If you still experience problems with the website, please
					<?php echo $webmasterContactLink; ?>. In order to adequately assist
					you with your problem, please include the following information in
					your email:
					<ul>
						<li>
							Your email address
						</li>
						<li>
							The Internet browser you are using
						</li>
						<li>
							A description of the problem you are having
						</li>
						<li>
							A copy of the error message you received (if possible)
						</li>
					</ul>
				</p>
			</li>
		</ul>
	</div>
	
	<div class='category'>
		<span id="contact">Contact</span>
		<ul class='answers'>
			<li>
				<span id="newsletter-signup">
					How can I sign up for your newsletter?
				</span>
				<p>
					To receive product updates, special offers, and discounts you can sign up
					for our newsletter! The sign-up form is located at the bottom of each 
					page.
				</p>
			</li>
			<li>
				<span id="how-to-contact">
					How can I contact you?
				</span>
				<p>
					If you have any other questions, feel free to <?php echo $contactUsLink; ?>
					. We also have an <?php echo $etsyLink; ?> page, where you may send us
					a message or buy our products from there. You can follow 
					us on <?php echo $facebookLink; ?>, <?php echo $pinterestLink; ?>,
					<?php echo $googleLink; ?>!
				</p>
			</li>
			<li>
				<span id="seller-information">
					Seller Information
				</span>
				<p>
					<ul class='contact-info'>
						<li>Sue Perez</li>
						<li>Owner</li>
						<li>Piees of Eight Costumes by Sue, LLC</li>
						<li><?php echo Yii::app()->params['adminEmail']; ?></li>
						<li>Keizer, Oregon, USA</li>
					</ul>
				</p>
			</li>
		</ul>
	</div>
</div>
