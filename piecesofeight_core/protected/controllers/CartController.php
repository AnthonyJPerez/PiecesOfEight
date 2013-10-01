<?php
//require_once('paypal/CallerService.php');

	function cmp_domestic($productA, $productB)
	{
		if ($productA->ship_domestic_primary == $productB->ship_domestic_primary)
		{
			return 0;
		}

		// Highest to Lowest
		return ($productA->ship_domestic_primary > $productB->ship_domestic_primary) ? -1 : 1;
	}


	function cmp_international($productA, $productB)
	{
		if ($productA->ship_international_primary == $productB->ship_international_primary)
		{
			return 0;
		}

		// Highest to Lowest
		return ($productA->ship_international_primary > $productB->ship_international_primary) ? -1 : 1;
	}


class CartController extends GxController
{
	public $defaultAction = 'view';
	
	

	
	public function actionAdd($product_id, $size, $quantity)
	{		
		$products = $this->_getSession();
		
		$pid = $product_id.'-'.$size;
		$products[$pid] = $this->_getProduct($pid);
		$products[$pid]['quantity'] += $quantity;
		$products[$pid]['size'] = $size;
		
		$this->_setSession($products);
		
		$this->redirect(array('cart/view'));
	}
	

	public function actionEmpty()
	{
		$this->_emptyCart();
		
		$this->redirect(array('cart/view'));
	}
	
	
	public function actionRemove()
	{
		$model = new AddcartForm;
		
		if (isset($_POST['AddcartForm']))
		{
			$model->attributes = $_POST['AddcartForm'];
			
			if ($model->validate())
			{
				$products = $this->_getSession();
				// Unset the product listing in the session
				unset($products[$model->product_id.'-'.$model->size]);
				$this->_setSession($products);
			}
		}
		
		$this->redirect(array('cart/view'));
	}


	/*public function actionUpdate($product_id, $size, $quantity)
	{
		if ( is_null($product_id) )
		{
			// @todo throw an error!
		}
		
		$products = $this->_getSession();
		
		// Set the quantity to whatever the user specified
		$products[$product_id.'-'.$size]['quantity'] = $quantity;
		
		// Flush the data back into the session
		$this->_setSession($products);
		
		
		// @todo: if the quantity is zero, just redirect to the actionRemove
		$this->redirect(array('cart/view'));
	}*/
	
	
	
	function _getPriceDetails()
	{
		$products_session = $this->_getSession();
		
		$products = array();
		$flat_products = array();
		$subTotal = 0.00;
		$totalQuantity = 0;
		foreach ($products_session as $pid=>$data)
		{
			$product = Product::model()->with('images')->findByPk($pid);
			$products[$pid]['product'] = $product;
			$products[$pid]['quantity'] = $data['quantity'];
			$products[$pid]['size'] = $data['size'];

			for ($a=0; $a<$products[$pid]['quantity']; $a++)
			{
				array_push($flat_products, $product);
			}
			
			// Calculate the running subtotal
			$subTotal += $products[$pid]['product']->price * $data['quantity'];
		}
		
		return array(
			'products' => $products,
			'flat_products' => $flat_products,	// each individual item takes up a unique position in the list
			'subTotal' => number_format($subTotal, 2),
			'totalQuantity' => $totalQuantity
		);
	}
	
	
	
	public function actionView()
	{
		$details = $this->_getPriceDetails();
		$quantity = $this->_getShippingQuantity($details);
		$domesticShipping = $this->_calculateShipping(true, $details['flat_products']);
		$internationalShipping = $this->_calculateShipping(false, $details['flat_products']);
		
		$shippingOptions = array(
			$domesticShipping['name'] . ' - $' . number_format($domesticShipping['amount'],2),
			$internationalShipping['name'] . ' - $' . number_format($internationalShipping['amount'],2)
		);
		
		$this->render(
			'view',
			array(
				'products' => $details['products'],
				'subTotal' => $details['subTotal'],
				'shipping' => $domesticShipping['amount'],
				'AddcartModel' => new AddcartForm,
				'shippingOptions' => $shippingOptions
			)
		);
	}
	
	
	public function actionError($error)
	{
		/*
		PAYMENTREQUEST_n_SH
ORTMESSAGE
xs:string
Payment error short message. You can specify up to 10 payments, where n is a digit 
between 0 and 9, inclusive.
PAYMENTREQUEST_n_LO
NGMESSAGE
xs:string
Payment error long message. You can specify up to 10 payments, where n is a digit 
between 0 and 9, inclusive.
PAYMENTREQUEST_n_ER
RORCODE
xs:string
Payment error code. You can specify up to 10 payments, where n is a digit between 0 
and 9, inclusive.
PAYMENTREQUEST_n_SE
VERITYCODE
xs:string
Payment error severity code. You can specify up to 10 payments, where n is a digit 
between 0 and 9, inclusive.




PAYMENTINFO_n_PAYME
NTSTATUS
PAYMENTSTATUS
(deprecated)
The status of the payment. You can specify up to 10 payments, where n is a digit 
between 0 and 9, inclusive. It is one of the following values:
 None – No status.
 Canceled-Reversal – A reversal has been canceled; for example, when you 
win a dispute and the funds for the reversal have been returned to you.
 Completed – The payment has been completed, and the funds have been added 
successfully to your account balance.
 Denied – You denied the payment. This happens only if the payment was 
previously pending because of possible reasons described for the 
PendingReason element.
 Expired – the authorization period for this payment has been reached.
 Failed – The payment has failed. This happens only if the payment was made 
from your buyer’s bank account.
 In-Progress – The transaction has not terminated, e.g. an authorization may be 
awaiting completion.
 Partially-Refunded – The payment has been partially refunded.
 Pending – The payment is pending. See the PendingReason field for more 
information.
 Refunded – You refunded the payment.
 Reversed – A payment was reversed due to a chargeback or other type of 
reversal. The funds have been removed from your account balance and returned to 
the buyer. The reason for the reversal is specified in the ReasonCode element.
 Processed – A payment has been accepted.
 Voided – An authorization for this transaction has been voided.
 Completed-Funds-Held – The payment has been completed, and the funds 
have been added successfully to your pending balance. 
See the PAYMENTINFO_n_HOLDDECISION field for more information.

PAYMENTINFO_n_PENDI
NGREASON
PENDINGREASON
(deprecated)
Reason the payment is pending. You can specify up to 10 payments, where n is a digit 
between 0 and 9, inclusive. It is one of the following values:
 none – No pending reason.
 address – The payment is pending because your buyer did not include a 
confirmed shipping address and your Payment Receiving Preferences is set such 
that you want to manually accept or deny each of these payments. To change your 
preference, go to the Preferences section of your Profile.
 authorization – The payment is pending because it has been authorized but 
not settled. You must capture the funds first.
 echeck – The payment is pending because it was made by an eCheck that has not 
yet cleared.
 intl – The payment is pending because you hold a non-U.S. account and do not 
have a withdrawal mechanism. You must manually accept or deny this payment 
from your Account Overview.
 multi-currency – You do not have a balance in the currency sent, and you do 
not have your Payment Receiving Preferences set to automatically 
convert and accept this payment. You must manually accept or deny this payment.
 order – The payment is pending because it is part of an order that has been 
authorized but not settled.
 paymentreview – The payment is pending while it is being reviewed by PayPal 
for risk.
 unilateral – The payment is pending because it was made to an email address 
that is not yet registered or confirmed.
 verify – The payment is pending because you are not yet verified. You must 
verify your account before you can accept this payment.
 other – The payment is pending for a reason other than those listed above. For 
more information, contact PayPal customer service.
NOTE: PendingReason is returned in the response only if PaymentStatus is 
Pending.
PENDINGREASON is deprecated since version 6
		*/
		$this->render(
			'error',
			array(
				'error' => $error
			)
		);
	}
	
	
	private function _getShippingQuantity($details)
	{
		$quantity = 0;
		foreach ($details['products'] as $product)
		{
			if ($product['product']->shippable == 1)
			{
				$quantity += $product['quantity'];
			}
		}
		
		return $quantity;
	}
	

	private function _calculateShipping_fixed($domestic, $quantity)
	{
		$shipping = 8.95;
		$name = 'U.S. Ground';
				
		if ($domestic)
		{
			$name = 'U.S. Ground';
			if ($quantity >= 8)
			{
				$shipping = 35.95;
			}
			else if ($quantity >= 5)
			{
				$shipping = 24.95;
			}
			else if ($quantity >= 3)
			{
				$shipping = 18.95;
			}
			else if ($quantity >= 2)
			{
				$shipping = 12.95;
			}
			else if ($quantity >= 1)
			{
				$shipping = 8.95;
			}
			else
			{
				$shipping = 0.00;
			}
		}
		else
		{
			$name = 'International Air';
			if ($quantity >= 10)
			{
				$shipping = 150.00;
			}
			else if ($quantity >= 7)
			{
				$shipping = 99.95;
			}
			else if ($quantity >= 4)
			{
				$shipping = 79.95;
			}
			else if ($quantity >= 2)
			{
				$shipping = 59.95;
			}
			else if ($quantity >= 1)
			{
				$shipping = 49.95;
			}
			else
			{
				$shipping = 0.00;
			}
		}
		
		return array(
			'amount' => $shipping,
			'name' => $name
		);
	}


	private function _calculateShipping($domestic, $products)
	{
		$shipping = 0;
		$name = 'U.S. Ground';
				
		if ($domestic)
		{
			$name = 'U.S. Ground';
			uasort($products, 'cmp_domestic');
			$baseElement = array_shift($products);
			$shipping = $baseElement->ship_domestic_primary;
			foreach ($products as $product)
			{
				$shipping += $product->ship_domestic_secondary;
			}
		}
		else
		{
			$name = 'International Air';
			uasort($products, 'cmp_international');
			$baseElement = array_shift($products);
			$shipping = $baseElement->ship_international_primary;
			foreach ($products as $product)
			{
				$shipping += $product->ship_international_secondary;
			}
		}
		
		return array(
			'amount' => $shipping,
			'name' => $name
		);
	}


	public function actionPaypalShippingCallback()
	{
		$quantity = 0;
		$domestic = true;
		$products = array();
		
		if (strcmp($this->_getValue($_POST, 'SHIPTOCOUNTRY'), "US") != 0)
		{
			$domestic = false;
		}

		// Grab each product, including their quantities, out of the list
		$quantityKey = 'L_QTY';
		$descriptionKey = 'L_DESC';
		$productIdKey = 'L_NUMBER';
		$c = 0;
		while (true)
		{
			$pid = intval($this->_getValue($_POST, $productIdKey.$c));
			if ($pid == false)
			{
				break;
			}

			$quantity = intval($this->_getValue($_POST, $quantityKey.$c));
				
			// Only add shippable products
			$description = "";
			if ( ($description = $this->_getValue($_POST, $descriptionKey.$c)) == false || strpos($description, '[Shipping]') == false)
			{
				// Push each item individually into the array.
				for ($a = 0; $a < $quantity; $a++)
				{
					array_push($product);
				}
			}

			$c += 1;
		}
		
		$shippingInfo = $this->_calculateShipping($domestic, $products);
		
		$nvp = array();
		$nvp['OFFERINSURANCEOPTION'] = 'false';
		$nvp['L_SHIPPINGOPTIONLABEL0'] = urlencode($shippingInfo['name']);
		$nvp['L_SHIPPINGOPTIONAMOUNT0'] = urlencode($shippingInfo['amount']);
		$nvp['L_SHIPPINGOPTIONISDEFAULT0'] = 'true';
		$nvp['L_TAXAMT0'] = urlencode('0.00');
		$nvp['L_INSURANCEAMOUNT'] = urlencode('0.00');
	
		// format the nvp string as url parameters
		$nvpString = "&";
		foreach ($nvp as $key=>$value)
		{
			$nvpString .= $key.'='.$value.'&';
		}
		$nvpString = rtrim($nvpString, '&');
		
		// Call the SetExpressCheckout action
		$nvpString = "METHOD=CallbackResponse" . $nvpString;
		
		echo $nvpString;	
	}
	
	
	public function actionPaypalShippingCallback_old()
	{
		$quantity = 0;
		$domestic = true;
		
				
		if (strcmp($this->_getValue($_POST, 'SHIPTOCOUNTRY'), "US") != 0)
		{
			$domestic = false;
		}

		// Calculate quantity
		$productKey = 'L_QTY';
		$shippingKey = 'L_DESC';
		foreach ($_POST as $key=>$value)
		{
			if (strpos($key, $productKey) !== false)
			{
				$quantity += intval($value);
			}
			
			// Remove products that are not shippable
			if (strpos($key, 'L_DESC') !== false && strpos($value, '[Shipping]') !== false)
			{
				$quantity -= 1;
			}
		}
		
		// For security:
		if ($quantity < 0)
		{
			$quantity = 0;
		}
		
		$shippingInfo = $this->_calculateShipping($domestic, $quantity);
		
		$nvp = array();
		$nvp['OFFERINSURANCEOPTION'] = 'false';
		$nvp['L_SHIPPINGOPTIONLABEL0'] = urlencode($shippingInfo['name']);
		$nvp['L_SHIPPINGOPTIONAMOUNT0'] = urlencode($shippingInfo['amount']);
		$nvp['L_SHIPPINGOPTIONISDEFAULT0'] = 'true';
		$nvp['L_TAXAMT0'] = urlencode('0.00');
		$nvp['L_INSURANCEAMOUNT'] = urlencode('0.00');
	
		// format the nvp string as url parameters
		$nvpString = "&";
		foreach ($nvp as $key=>$value)
		{
			$nvpString .= $key.'='.$value.'&';
		}
		$nvpString = rtrim($nvpString, '&');
		
		// Call the SetExpressCheckout action
		$nvpString = "METHOD=CallbackResponse" . $nvpString;
		
		echo $nvpString;	
	}
	
	
	public function actionDoCheckout()
	{
		// Paypal Checkout methods: https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/library_documentation
		// Paypal developer guide: https://cms.paypal.com/cms_content/US/en_US/files/developer/PP_NVPAPI_DeveloperGuide.pdf
		// Express Checkout advanced features: https://cms.paypal.com/cms_content/US/en_US/files/developer/PP_ExpressCheckout_AdvancedFeaturesGuide.pdf
		// google for: paypal setexpresscheckout, etc..
		
		//
		// SetExpressCheckout
		//
		if(! isset($_REQUEST['token'])) 
		{
			$details = $this->_getPriceDetails();
			
			if (count($details['products']) <= 0)
			{
				// There is nothing in the cart, so redirect the user:
				$this->redirect(
					$this->createUrl('cart/view')
				);
			}
			$nvp = array();
			$nvp['PAYMENTREQUEST_0_CURRENCYCODE'] = 'USD';
			$nvp['NOSHIPPING'] = 0; // Force display of shipping address on paypal pages.
			$nvp['REQCONFIRMSHIPPING'] = '1';
			$nvp['ALLOWNOTE'] = 0; // The buyer is not able to enter a note to the merchant.
			$nvp['RETURNURL'] = urlencode($this->createAbsoluteUrl('cart/doCheckout'));
			$nvp['CANCELURL'] = urlencode($this->createAbsoluteUrl('cart/view'));
			$nvp['SOLUTIONTYPE'] = "Sole";
			$nvp['LANDINGPAGE'] = "Billing";
			$nvp['PAYMENTREQUEST_0_PAYMENTACTION'] = "Sale";			
			$nvp['CALLBACK'] = urlencode("https://secure679.hostgator.com/~sperez8/index.php?r=cart/paypalShippingCallback");
			$nvp['CALLBACKTIMEOUT'] = 6;
						
			// Add each product
			$count = 0;
			$nvp['PAYMENTREQUEST_0_ITEMAMT'] = 0;
			$flat_products = array();
			foreach ($details['products'] as $pid=>$value)
			{
				$nvp['L_PAYMENTREQUEST_0_NAME'.$count] = urlencode($value['product']->name);
				$nvp['L_PAYMENTREQUEST_0_NUMBER'.$count] = urlencode($value['product']->id);
				
				$desc = ($value['product']->shippable == 1) 
					? "[Size: ".$value['size']."] "
					: "[Shipping] ";
				$desc .= $value['product']->description;
				$nvp['L_PAYMENTREQUEST_0_DESC'.$count] = urlencode(substr($desc, 0, 127));
				
				$nvp['L_PAYMENTREQUEST_0_ITEMURL'.$count] = urlencode($value['product']->getUrl(true));
				$nvp['L_PAYMENTREQUEST_0_AMT'.$count] = number_format($value['product']->price, 2);
				$nvp['L_PAYMENTREQUEST_0_QTY'.$count] = $value['quantity'];
				$nvp['L_PAYMENTREQUEST_0_ITEMCATEGORY'.$count] = "Physical";
				$count++;
				$nvp['PAYMENTREQUEST_0_ITEMAMT'] += number_format($value['product']->price, 2) * number_format($value['quantity'], 2);
			
				// Add products to a "flat_product" array, to make it easier to calculate the shipping
				for ($a=0; $a<$value['quantity']; $a++)
				{
					array_push($flat_products, $value['product']);
				}
			}

			$domestic = $this->_calculateShipping(true, $flat_products);
			$international = $this->_calculateShipping(false, $flat_products);

			$nvp['L_SHIPPINGOPTIONISDEFAULT0'] = 'TRUE';
			$nvp['L_SHIPPINGOPTIONNAME0'] = urlencode('U.S. Ground');
			$nvp['L_SHIPPINGOPTIONAMOUNT0'] = urlencode($domestic['amount']);
			$nvp['L_SHIPPINGOPTIONNAME1'] = urlencode('International Air');
			$nvp['L_SHIPPINGOPTIONAMOUNT1'] = urlencode($international['amount']);
			$nvp['L_SHIPPINGOPTIONISDEFAULT1'] = 'FALSE';
			$nvp['PAYMENTREQUEST_0_INSURANCEOPTIONSOFFERED'] = 'FALSE';
			$nvp['PAYMENTREQUEST_0_SHIPPINGAMT'] = number_format($domestic['amount'],2);

			// Required for security reasons
			$nvp['MAXAMT'] = number_format($nvp['PAYMENTREQUEST_0_ITEMAMT'], 2) + 149.95;
			$nvp['PAYMENTREQUEST_0_AMT'] = number_format($nvp['PAYMENTREQUEST_0_ITEMAMT'], 2) + $domestic['amount'];

			// format the nvp string as url parameters
			$nvpString = "&";
			foreach ($nvp as $key=>$value)
			{
				$nvpString .= $key.'='.$value.'&';
			}
			$nvpString = rtrim($nvpString, '&');
						
			// Call the SetExpressCheckout action
			$resArray = hash_call("SetExpressCheckout",$nvpString);			
			$ack = strtoupper($resArray["ACK"]);
			
			if ($ack == "SUCCESS")
			{
				// Redirect to paypal.com here
				$token = urldecode($resArray["TOKEN"]);
				$payPalURL = PAYPAL_URL.$token;
				header("Location: ".$payPalURL);
			} 
			else  
			{
				// SetExpressCheckout error
				/*echo "<div><div>ResArray:</div>";
				print_r($resArray);
				echo "</div>";*/
				$this->redirect(
					$this->createUrl('cart/error', array('error'=>'set'))
				);
			}
		}
		
		//
		// GetExpressCheckoutDetails
		//
		else
		{
			$token =urlencode( $_REQUEST['token']);
			$nvpstr="&TOKEN=".$token;
			
			// Do the GetExpressCheckoutDetails action
			$resArray=hash_call("GetExpressCheckoutDetails",$nvpstr);
			
			// Grab a copy of the details, so we can use them later.
			$ack = strtoupper($resArray["ACK"]);
			$getOrderDetails = $resArray;
			
			if($ack != 'SUCCESS' && $ack != 'SUCCESSWITHWARNING')
			{
				// GetExpressCheckoutDetails error
				$this->redirect(
					$this->createUrl(array('cart/error', array('error'=>'get')))
				);
			}
			
			//
			// DoExpressCheckout
			//
			else
			{								
				// Perform the DoExpressCheckout action
				$nvp = array();
				$nvp['TOKEN'] = $resArray['TOKEN'];
				$nvp['PAYERID'] = $resArray['PAYERID'];
				$nvp['PAYMENTREQUEST_0_AMT'] = $resArray['PAYMENTREQUEST_0_AMT'];
				$nvp['PAYMENTREQUEST_0_CURRENCYCODE'] = 'USD';
				$nvp['PAYMENTREQUEST_0_PAYMENTACTION'] = "Sale";
				
				// format the nvp string as url parameters
				$nvpString = "&";
				foreach ($nvp as $key=>$value)
				{
					$nvpString .= $key.'='.$value.'&';
				}
				$nvpString = rtrim($nvpString, '&');
				
				// Do the DoExpressCheckoutPayment action
				$resArray=hash_call("DoExpressCheckoutPayment",$nvpString);
			
				$ack = strtoupper($resArray["ACK"]);	
				if($ack != 'SUCCESS' && $ack != 'SUCCESSWITHWARNING')
				{
					// GetExpressCheckoutDetails error
					$this->redirect(
						$this->createUrl(array('cart/error', array('error'=>'do')))
					);
				}
				else
				{
					$debug = true;
					if (!defined('YII_DEBUG') || constant('YII_DEBUG') == false)
					{
						$debug = false;
					}
					
					// create a new order in the database
					$d = $getOrderDetails;
					//print_r($getOrderDetails);
					//echo "<br /><br />";
					//print_r($resArray);
					$Order = new Order;
					$Order->total_amt = number_format($this->_getValue($resArray, 'PAYMENTINFO_0_AMT'), 2);
					$Order->paypalfee_amt = number_format($this->_getValue($resArray, 'PAYMENTINFO_0_FEEAMT'), 2);
					$Order->tax_amt = number_format($this->_getValue($resArray, 'PAYMENTINFO_0_TAXAMT'), 2);
					$Order->confirmation_code = $this->_getValue($resArray, 'PAYMENTINFO_0_TRANSACTIONID');
					$Order->order_date = $this->_getValue($resArray, 'PAYMENTINFO_0_ORDERTIME');
					
					$Order->email = $this->_getValue($d, 'EMAIL');
					$Order->first_name = $this->_getValue($d, 'FIRSTNAME');
					$Order->last_name = $this->_getValue($d, 'LASTNAME');
					$Order->shipto_name = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTONAME');
					$Order->shipto_street = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTOSTREET');
					$Order->shipto_city = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTOCITY');
					$Order->shipto_state = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTOSTATE');
					$Order->shipto_zip = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTOZIP');
					$Order->shipto_countrycode = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE');
					$Order->shipto_countryname = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME');
					$Order->shipping_amt = number_format($this->_getValue($d, 'PAYMENTREQUEST_0_SHIPPINGAMT'), 2);
					$Order->shipping_type = $this->_getValue($d, 'SHIPPINGOPTIONNAME');
					$Order->discount_amt = number_format($this->_getValue($d, 'PAYMENTREQUEST_0_SHIPDISCAMT'), 2);
					$Order->discount_msg = "n/a";
										
					$details = $this->_getPriceDetails();
					$Order->order_details = base64_encode(serialize($details['products'])); //To unserialize this:  unserialize(base64_decode($encoded_serialized_string));
					$Order->save();

					// Iterate the products that were purchased. Mark each "Custom" product 
					// as out of stock.
					foreach ($details['products'] as $pid => $productDetails)
					{
						// Grab this product from the database
						$product = Product::model()->findByPk($pid);
						if ($product->custom_order)
						{
							$product->out_of_stock = 1;
							$product->save();
						}
					}
										
					// Send the confirmation emails
					// Email the form to the customer
					$msg = new YiiMailMessage;
					$msg->view = 'customerCheckout';
					$msg->addTo(($debug) ? Yii::app()->params['adminEmail'] : $Order->email);
					$msg->setFrom(array(Yii::app()->params['checkoutEmail'] => "Pieces of Eight Costumes"));
					$msg->setSender(array(Yii::app()->params['checkoutEmail'] => "Pieces of Eight Costumes"));
					$msg->setSubject("Thank you for your order with Pieces of Eight Costumes!");
					$msg->setBody(array('model'=>$Order), 'text/html');
					Yii::app()->mail->send($msg);
					
					// Email the form to the admin
					$msg = new YiiMailMessage;
					$msg->view = 'adminCheckout';
					$msg->addTo(Yii::app()->params['adminEmail']);
					$msg->setFrom(array(Yii::app()->params['checkoutEmail']=>"Pieces of Eight Costumes"));
					$msg->setSender(array(Yii::app()->params['checkoutEmail']=>"Pieces of Eight Costumes"));
					$msg->setSubject("Order Notification");
					$msg->setBody(array('model'=>$Order), 'text/html');			
					Yii::app()->mail->send($msg);
					
					Yii::app()->session['confirmCode'] = $Order->confirmation_code;
					
					$this->redirect(
						$this->createUrl('cart/checkout')
					);
				}
			}
		}
	}
	
	public function actionCheckout()
	{
		$confirmCode = Yii::app()->session['confirmCode'];
		
		// Empty the cart!
		$this->_emptyCart();
				
		$this->render(
			'checkout',
			array(
				'confirmCode' => $confirmCode
			)
		);
	}
	
	public function actionTestEmail()
	{
		$this->render(
			'testEmail',
			array(
				'model' => Order::model()->findByPk(1)
			)
		);
	}
	
	private function _getValue($arr, $key)
	{
		if (array_key_exists($key, $arr))
		{
			return $arr[$key];
		}
		
		return "0";
	}
	
	
	private function _createConfirmationCode()
	{
		$charpool = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$code = "";
		$max = strlen($charpool) - 1;
		for ($x=0; $x<8; $x++)
		{
			$code .= $charpool[rand(0, $max)];
		}
		
		// @todo make sure this is unique in database before returning
		return $code;
	}
	
	private function _getSession()
	{
		// Initialize the products map, if it does not exist.
		if ( !isset(Yii::app()->session['products']) )
		{
			Yii::app()->session['products'] = array();	
		}
		
		return Yii::app()->session['products'];
	}
	
	
	private function _setSession($data)
	{
		Yii::app()->session['products'] = $data;
	}
	
	
	private function _getProduct($pid)
	{
		if ( isset(Yii::app()->session['products'][$pid]) )
		{
			return Yii::app()->session['products'][$pid];
		}

		return array (
			'quantity' => 0,
			'size' => 'M'
		);
	}
	
	
	private function _emptyCart()
	{
		unset(Yii::app()->session['products']);
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
	}
	
	/*
	public function actionCheckOrders()
	{
		$orders = Order::model()->findAll();
		$this->render(
			'checkOrders',
			array(
				'orders' => $orders
			)
		);
	}*/

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}