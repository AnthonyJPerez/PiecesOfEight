<?php
	$canonicalCategory = null;

	if (isset($category) && null != $category)
	{
		switch ($category)
		{
			case 'new': 
				$this->pageTitle = 'Newest Clothing | ' . $this->pageTitle;
				$this->pageDescription = "Shop our newest products from our collection of handmade pirate costumes and renaissance clothing. Find your Captain Jack Sparrow costume, Snow White and the Huntsman Costume, 
				ladies pirate costume, ladies pirate shirt, mens pirate costume, mens pirate shirt, mens pirate pants, halloween costume, pirate wedding dress, renaissance dress, pirate coat, 
				pirate pants. Custom orders are available on all of our costumes and products!";
				
				$this->pageKeywords = "Captain Jack Sparrow costume, Snow White and the Huntsman Costume, 
				ladies pirate costume, ladies pirate shirt, mens pirate costume, mens pirate shirt, mens pirate pants, halloween costume, pirate wedding dress, renaissance dress, pirate coat, 
				pirate pants";
				break;

			default:
				$this->pageTitle = ucfirst($categoryModel->name). ' | ' . $this->pageTitle;
				$canonicalCategory = $category;
				
				// @todo: grab from database
				//$this->pageDescription = $categoryModel->description;
				//$this->pageKeywords = $categoryModel->keywords;
				break;
		}
	}
	else
	{
		$this->pageTitle = 'Pirate Clothes | ' . $this->pageTitle;
		
		$this->pageDescription = "Shop our collection of handmade pirate costumes and renaissance clothing. Find your Captain Jack Sparrow costume, Snow White and the Huntsman Costume, 
		ladies pirate costume, ladies pirate shirt, mens pirate costume, mens pirate shirt, mens pirate pants, halloween costume, pirate wedding dress, renaissance dress, pirate coat, 
		pirate pants. Custom orders are available on all of our costumes and products!";
		
		$this->pageKeywords = "Captain Jack Sparrow costume, Snow White and the Huntsman Costume, 
		ladies pirate costume, ladies pirate shirt, mens pirate costume, mens pirate shirt, mens pirate pants, halloween costume, pirate wedding dress, renaissance dress, pirate coat, 
		pirate pants";
	}

	$canonicalOptions = array();
	if ($canonicalCategory)
	{
		$canonicalOptions['category'] = $canonicalCategory;
	}
	$this->pageCanonical = Yii::app()->request->hostInfo . $this->createUrl('product/list', $canonicalOptions);


	//
	// Handle the pagination linking for Google's SEO:
	//
	$this->pageLink = "";

	if ($showNext)
	{		
		$this->pageLink .= "<link rel=\"next\" href=\"".
			$this->createUrl(
				'product/list', 
				array(
					'page' => ($page + 1),
					'category' => $category
				)
			)."\"/>";
	}

	if ($showPrev)
	{
		$this->pageLink .= "<link rel=\"prev\" href=\"".
			$this->createUrl(
				'product/list', 
				array(
					'page' => ($page - 1),
					'category' => $category
				)
			)."\"/>";
	}
	

	Yii::app()->clientScript->registerCss(
		'product_view_rounded',
		'
			.pager
			{
				margin: 2em 0 0 0;
				text-align: center;
			}

			.pager ul
			{
				font-size: 12px;
				border: 0;
				margin: 0;
				padding: 0;
				line-height: 100%;
				display: inline;
			}

			.pager li
			{
				display: inline;
			}

			.pager a:link
			{
				font-weight: bold;
				padding: 1px 6px;
				text-decoration: none;
			}

			.pager .selected a:link
			{
				text-decoration: underline;
				font-weight: normal;
			}

			.background_shadow
			{
				background-color: #f7f7f7;
				
				-webkit-box-shadow: 3px 3px 8px -1px #666;
				-moz-box-shadow: 3px 3px 8px -1px #666;
				box-shadow:  3px 3px 8px -1px #666;
			}
			
			#product_listing
			{
				padding: 1em;
				background-color: lightgrey;
			}
			
				#product_listing > img
				{
					width: 45%;
				}
			
			.list-view
			{
				width: 100%;
				padding-left: 1.5em;
			}

			.list-view > .items > .view
			{
				display: inline-block;
				vertical-align: top;
				margin: 0.7em;
				padding: 0.5em;
				width: 30%;
			}

				.view {
					position: relative;
					
				}
				
				.view img
				{
					width: 100%;
					margin-bottom: 5px;
				}

				.view .product_name
				{
					float: left;
					text-align: left;
					width: 70%;	
				}
				
				.view .product_price
				{
					position: absolute;
					right: 5px;
					bottom: 5px;
				}
				
				.list-view > .items > .view
				{
					display: inline-block;
					vertical-align: top;
					margin: .7em;
					padding: 0.5em;
					width: 30%;		
				}
				
			.list-view .summary
			{
				display: none;
			}
			
			.list-view .sorter
			{
				margin-right: 1.5em;
			}
			
			.list-view .empty
			{
				position: absolute;
				top: 75px;
				margin-left: 1em;
			}
			
			.list-view-loading
			{
				background-image: none;
			}
			
			
			.empty
			{
				margin-top: 2em;
			}
		',
		'screen'
	);
?>



<div id="breadcrumbs">
	<ul>
	<?php
		if (isset($category))
		{
			echo "<li>";
			
			echo CHtml::link(
				'All Products',
				$this->createUrl('product/list')
			);
			
			echo "</li><li> > </li>";

			if (isset($category))
			{
				echo "<li><span>".ucfirst($category)."</span></li>";
			}
		}
		else
		{
			echo "<li>All Products</li>";
		}
	?>
	</ul>
</div>


<h1>
<?php
	$pageH1Category = ucfirst($category);
	switch ($category)
	{
		case 'new':
			$pageH1Category = 'New Arrivals';
			break;
			
		case "":
			$pageH1Category = "All Products";
			break;
	}
	
	echo $pageH1Category;
?>
</h1>


<?php 


echo "<div class='list-view'>";
//
// Print the products
//
echo "<div class='items'>";
foreach ($products as $product)
{
	$this->renderPartial(
		'_view',
		array(
			'data' => $product,
			'category' => $category
		)
	);
}
echo "</div>";


//
// Setup the pager links
//
$linkOptions = array();
if ($category)
{
	$linkOptions['category'] = $category;
}

$linkOptions['page'] = $page + 1;
$nextLink = CHtml::link(
				'Next >',
				$this->createUrl(
					'product/list', 
					$linkOptions
				),
				array('class'=>'next')
			);

if (1 == ($page-1))
{
	unset($linkOptions['page']);
	$prevLink = CHtml::link(
				'< Previous',
				$this->createUrl(
					'product/list', 
					$linkOptions
				),
				array('class'=>'prev')
			);
} 
else 
{
	$linkOptions['page'] = $page - 1;
	$prevLink = CHtml::link(
				'< Previous',
				$this->createUrl(
					'product/list', 
					$linkOptions
				),
				array('class'=>'prev')
			);
}


//
// Print the pager:
//
// Don't render the individual pages if showNext and showPrev
// are both disabled:
if ($showPrev || $showNext)
{
	echo "<div class='pager'><ul>";
	echo "<li>".(($showPrev) ? $prevLink : "")."</li>";
	$lastPage = ceil($numTotal / $numToDisplay);


	for ($x=1; $x<=$lastPage; $x++)
	{
		echo "<li class=\"page ".(($page == $x)?"selected":"")."\">";
		$linkOptions['page'] = $x;
		if ($category) {
			$linkOptions['category'] = $category;
		}
		echo CHtml::link(
			$x, 
			$this->createUrl(
				'product/list',
				$linkOptions
			)
		);
		echo "</li>";
	}

	echo "<li>".(($showNext) ? $nextLink : "")."</li>";
	echo "</ul></div>";
}


echo "</div>";

?>