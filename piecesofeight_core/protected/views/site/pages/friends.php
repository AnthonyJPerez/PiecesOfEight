<?php
	$this->pageTitle = "Our Friends | " . $this->pageTitle;

	Yii::app()->clientScript->registerCss(
		'partners-style',
		'
		#friends
		{

		}
		
		#friends div
		{
			margin-top: 1em;
		}
			
		',
		'screen'
	);
?>

<h1>Our Friends</h1>

<p>
	Check out the websites of some of our friends. They have great items that compliment our pirate garb very nicely!
	<br /><br />
</p>

<div id="friends">
	<div>
		<a href="http://www.djaru.net/masks.htm" rel="nofollow" target="_blank">The Studio Djaru</a> - Magnificent handcrafted, renaissance-influenced masks and head pieces.
	</div>
	
	<div>
		<a href="http://waxingmoonenchantments.com/home.html" rel="nofollow" target="_blank">Waxing Moon Enchantments</a> - Hand-poured mythic, fantasy, decorative and aroma candles, individually crafted.
	</div>
	
	<div>
		<a href="http://www.privateers4kids.org/Goals___Objectives.html" rel="nofollow" target="_blank">Privateers 4 Kids</a> - The "Privateer" entertains and educates children at risk of complicated and debilitating challenges such as Cancer and other ailments. Show him support by donating to his cause!
	</div>
</div>