<?php
	
?>

<h1>Check Orders</h1>

<div>
<?php
	foreach ($orders as $Order)
	{
		echo "<hr />";
		echo "<h2>Order: ".$Order->id."</h2>";
		echo "<div><span>Total Amount: </span><span>".$Order->total_amt."</span></div>";
		echo "<div><span>Paypal Fee: </span><span>".$Order->paypalfee_amt."</span></div>";
		echo "<div><span>Tax Amt: </span><span>".$Order->tax_amt."</span></div>";
		echo "<div><span>Confirmation Code: </span><span>".$Order->confirmation_code."</span></div>";
		echo "<div><span>Order Date: </span><span>".$Order->order_date."</span></div>";
		
		echo "<div><span>Email: </span><span>".$Order->email."</span></div>";
		echo "<div><span>First Name: </span><span>".$Order->first_name."</span></div>";
		echo "<div><span>Last Name: </span><span>".$Order->last_name."</span></div>";
		echo "<div><span>Shipto Name: </span><span>".$Order->shipto_name."</span></div>";
		echo "<div><span>Shipto Street: </span><span>".$Order->shipto_street."</span></div>";
		echo "<div><span>Shipto City: </span><span>".$Order->shipto_city."</span></div>";
		echo "<div><span>Shipto State: </span><span>".$Order->shipto_state."</span></div>";
		echo "<div><span>Shipto Zip: </span><span>".$Order->shipto_zip."</span></div>";
		echo "<div><span>Shipto CountryCode: </span><span>".$Order->shipto_countrycode."</span></div>";
		echo "<div><span>Shipto CountryName: </span><span>".$Order->shipto_countryname."</span></div>";
		echo "<div><span>Shipping Amt: </span><span>".$Order->shipping_amt."</span></div>";
		echo "<div><span>Shipping Type: </span><span>".$Order->shipping_type."</span></div>";
		echo "<div><span>Discount Amt: </span><span>".$Order->discount_amt."</span></div>";
		echo "<div><span>Discount Msg: </span><span>".$Order->discount_msg."</span></div>";
							
		echo "<div><span>Order Details: </span><div>".print_r(unserialize(base64_decode($Order->order_details)), true)."</div></div>";
		
	}
?>
</div>
