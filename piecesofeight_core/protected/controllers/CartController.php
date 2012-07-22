<?php
//require_once('paypal/CallerService.php');

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
		$subTotal = 0.00;
		$totalQuantity = 0;
		foreach ($products_session as $pid=>$data)
		{
			$products[$pid]['quantity'] = $data['quantity'];
			$products[$pid]['product'] = Product::model()->with('images')->findByPk($pid);
			$products[$pid]['size'] = $data['size'];
			
			// Calculate the running subtotal
			$subTotal += $products[$pid]['product']->price * $data['quantity'];
			$totalQuantity += $data['quantity'];
		}
		
		//$shipping = ($totalQuantity > 1) ? 12.95 : 8.95;
		if ($totalQuantity >= 8)
		{
			$shipping = 35.95;
		}
		else if ($totalQuantity >= 5)
		{
			$shipping = 24.95;
		}
		else if ($totalQuantity >= 3)
		{
			$shipping = 18.95;
		}
		else if ($totalQuantity == 2)
		{
			$shipping = 12.95;
		}
		else
		{
			$shipping = 8.95;
		}
		
		return array(
			'products' => $products,
			'shipping' => number_format($shipping, 2), // converts $x to $x.00
			'subTotal' => number_format($subTotal, 2)
		);
	}
	
	
	
	public function actionView()
	{
		$details = $this->_getPriceDetails();
		
		$this->render(
			'view',
			array(
				'products' => $details['products'],
				'shipping' => $details['shipping'],
				'subTotal' => $details['subTotal'],
				'AddcartModel' => new AddcartForm,
			)
		);
	}
	
	
	public function actionError($error)
	{
		$this->render(
			'error',
			array(
				'error' => $error
			)
		);
	}
	
	
	public function actionCheckout()
	{
		// NVP API Reference: https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/howto_api_reference		
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
			$nvp['PAYMENTREQUEST_0_AMT'] = $details['subTotal'];
			$nvp['PAYMENTREQUEST_0_CURRENCYCODE'] = 'USD';
			$nvp['NOSHIPPING'] = 0; // Force display of shipping address on paypal pages.
			$nvp['ALLOWNOTE'] = 1; // The buyer is able to enter a note to the merchant.
			$nvp['RETURNURL'] = urlencode($this->createAbsoluteUrl('cart/checkout'));
			$nvp['CANCELURL'] = urlencode($this->createAbsoluteUrl('cart/view'));
			$nvp['PAYMENTREQUEST_0_PAYMENTACTION'] = "Sale";
			
			// Add each product
			$count = 0;
			$nvp['PAYMENTREQUEST_0_ITEMAMT'] = 0;
			foreach ($details['products'] as $pid=>$value)
			{
				$nvp['L_PAYMENTREQUEST_0_NAME'.$count] = urlencode($value['product']->name);
				$nvp['L_PAYMENTREQUEST_0_AMT'.$count] = $value['product']->price;
				$nvp['L_PAYMENTREQUEST_0_QTY'.$count] = $value['quantity'];
				$nvp['L_PAYMENTREQUEST_0_ITEMCATEGORY'.$count] = "Physical";
				$count++;
				$nvp['PAYMENTREQUEST_0_ITEMAMT'] += $value['product']->price * $value['quantity'];
			}
			
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
				$this->redirect(
					$this->createUrl(array('cart/error', array('error'=>'set')))
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
					
					// create a new order in the database
					$d = $getOrderDetails;
					print_r($getOrderDetails);
					$Order = new Order;
					$Order->confirmation_code = $this->_createConfirmationCode();
					$Order->email = $getOrderDetails['EMAIL'];
					$Order->order_date = new CDbExpression('NOW()');
					$Order->first_name = $this->_getValue($d, 'FIRSTNAME');
					$Order->last_name = $this->_getValue($d, 'LASTNAME');
					$Order->shipto_name = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTONAME');
					$Order->shipto_street = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTOSTREET');
					$Order->shipto_city = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTOCITY');
					$Order->shipto_state = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTOSTATE');
					$Order->shipto_zip = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTOZIP');
					$Order->shipto_countrycode = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE');
					$Order->shipto_countryname = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME');
					$Order->total_amt = $this->_getValue($d, 'PAYMENTREQUEST_0_AMT');
					$Order->subtotal_amt = $this->_getValue($d, 'PAYMENTREQUEST_0_ITEMAMT');
					$Order->shipping_amt = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPPINGAMT');
					$Order->shipping_type = $this->_getValue($d, 'SHIPPINGOPTIONNAME');
					$Order->tax_amt = $this->_getValue($d, 'PAYMENTREQUEST_0_TAXAMT');
					$Order->discount_amt = $this->_getValue($d, 'PAYMENTREQUEST_0_SHIPDISCAMT');
					$Order->discount_msg = "n/a";
					
					$details = $this->_getPriceDetails();
					$Order->order_details = base64_encode(serialize($details['products'])); //To unserialize this:  unserialize(base64_decode($encoded_serialized_string));
					$Order->save();
					
					// Send the confirmation emails
						// send one to adminEmail
						// send one to customerEmail
					// ...
					
					// Empty the cart!
					$this->_emptyCart();
					
					$this->render(
						'checkout'
					);
				}
			}
		}
	}
	
	private function _getValue($arr, $key)
	{
		if (array_key_exists($key, $arr))
		{
			return $arr[$key];
		}
		
		return "n/a";
	}
	
	
	private function _createConfirmationCode()
	{
		$charpool = "ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890abcdefghijklmnopqrstuvwxyz";
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