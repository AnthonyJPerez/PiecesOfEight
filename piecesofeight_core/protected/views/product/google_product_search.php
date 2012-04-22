<?php 
	echo '<?xml version="1.0"?>';
	echo '<feed xmlns="http://www.w3.org/2005/Atom" xmlns:g="http://base.google.com/ns/1.0">';

	echo '<title>Pieces of Eight Product Listings</title>';
	echo '<link href="http://piecesofeightcostumes.com" rel="alternate" type="text/html" />';
	echo '<updated>2012-04-21T02:46:00Z</updated>';
	echo '<author><name>Pieces of Eight Costumes</name></author>';

	// View for generating the XML for Google's Product Search
	foreach ($products as $product)
	{
		
	}
	
	echo '</feed>';

?>