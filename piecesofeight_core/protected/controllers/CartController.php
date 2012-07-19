<?php

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
		
		$shipping = ($totalQuantity > 1) ? 12.95 : 8.95;
		
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
	
	
	public function actionAPIError()
	{
		$this->render(
			'apiError'
		);
	}
	
	
	public function actionCheckout()
	{
		// NVP API Reference: https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/howto_api_reference
		
		//$this->_emptyCart();
		require_once('paypal/CallerService.php');
		
		//print_r($_REQUEST);
		
		if(! isset($_REQUEST['token'])) 
		{
			$details = $this->_getPriceDetails();
			$nvp = array();
			$nvp['PAYMENTREQUEST_0_AMT'] = $details['subTotal'];
			$nvp['RETURNURL'] = $this->createAbsoluteUrl('cart/checkout');
			$nvp['CANCELURL'] = $this->createAbsoluteUrl('cart/checkout');
			$nvp['PAYMENTREQUEST_0_PAYMENTACTION'] = "Sale";
			
			$nvpString = "";
			foreach ($nvp as $key=>$value)
			{
				$nvpString .= $key.'='.$value.'&';
			}
			$nvpString = rtrim($nvpString, '&');
			//$nvpString = http_build_query($nvp); // or urlencode
			
			/* Make the call to PayPal to set the Express Checkout token
			If the API call succeded, then redirect the buyer to PayPal
			to begin to authorize payment.  If an error occured, show the
			resulting errors
			*/
			//print_r("NVP: " . $nvpString);
			$resArray = hash_call("SetExpressCheckout",$nvpString);
			$_SESSION['reshash'] = $resArray;
			
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
				print_r($_SESSION);
				// Redirecting to APIError.php to display errors.
				$location = "APIError.php";
				header("Location: $location");
			}
		}
		else
		{
			echo "2";
		}
	
		$this->render(
			'checkout'
		);
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