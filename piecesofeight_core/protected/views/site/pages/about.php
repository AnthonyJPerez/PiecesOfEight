<?php
	$this->pageTitle = "About Us | " . $this->pageTitle;
	
	$this->pageDescription = "Designing costumes her whole life, Susan Perez has years of experience creating
	custom, handmade costumes and clothing. Susan specializes in creating pirate costumes and renaissance clothes
	from her costuming shop located in Keizer, Oregon. Born and raised in Cornwall, Sue was inspired by the
	many famous tales and legends that make up England's history, from notorious pirates to the legends of King Arthur.";
	
	$this->pageKeywords = "Costume designer, handmade costumes, Keizer Oregon Costume shop, pirate costumes, renaissance costumes";

	Yii::app()->clientScript->registerCss(
		'about-me-style',
		'
			img {
				padding-right: 1em;
			}
		',
		'screen'
	);
?>
<h1>Pieces of Eight Costumes</h1>

<p>
	<img align="left" width="200px" src="<?php echo Yii::app()->baseUrl . '/images/susan_perez.jpg' ?>" />Hello, my name is <a href="https://plus.google.com/111991154896541294171/about" rel="me">Sue Perez</a> and I have been creating costumes and other clothes my 
	whole life. I was born and raised in Cornwall which is a beautiful peninsula at the 
	southwestern most tip of England, full of history with ties to many Pirates and the 
	legends of King Arthur.
</p>
<p>
	My interest in sewing started very young when I would make 
	dolls clothes from scraps of materials and progressed from there. I studied 
	dressmaking at school and started making a lot of my own clothes as a teenager, 
	then when I became heavily involved in dance I used those same sewing skills to 
	make my own costumes for the stage. 
</p>
<p>
	I specialize in quality Pirate and Renaissance 
	costumes and am always up for a challenge. My creations have won numerous costume 
	contests and are always the talk of the party. I strive to obtain a good balance 
	between historic accuracy and modern comfort and convenience and like to select 
	items that are versatile and can be accessorized multiple ways to portray 
	different charaters. Most of my items are machine or hand washable although some 
	fabric choices will need dry cleaning. 
</p>
<p>
	I hope you have as much fun wearing these items as I do creating them.
</p>