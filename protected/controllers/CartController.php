<?php

class CartController extends Controller
{
	public $defaultAction = 'view';
	
	
	

	public function actionAdd($product_id=null, $quantity=1)
	{		
		if ( is_null($product_id) )
		{
			// @todo throw an error!
		}
		
		$products = $this->_getSession();
				
		// Add a product to the cart. Create the product in the cart
		// if it does not exist
		if ( array_key_exists($product_id, $products) )
		{
			$products[$product_id] += $quantity;
		}
		else
		{
			$products[$product_id] = $quantity;
		}
		
		// Flush the data back into the session
		$this->_setSession($products);
		
		$this->redirect(array('cart/view'));
	}
	

	public function actionCheckout()
	{
		// Upload the cart to paypal, then redirect to paypal.
		// ...
	}
	

	public function actionEmpty()
	{
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		
		$this->redirect(array('cart/view'));
	}
	

	public function actionRemove($product_id)
	{
		if ( is_null($product_id) )
		{
			// @todo throw an error!
		}
		
		$products = $this->_getSession();
		
		// Unset the product listing in the session.
		unset($products[$product_id]);
		
		$this->_setSession($products);
		
		$this->redirect(array('cart/view'));
	}


	public function actionUpdate($product_id, $quantity)
	{
		if ( is_null($product_id) )
		{
			// @todo throw an error!
		}
		
		$products = $this->_getSession();
		
		// Set the quantity to whatever the user specified
		$products[$product_id] = $quantity;
		
		// Flush the data back into the session
		$this->_setSession($products);
		
		$this->redirect(array('cart/view'));
	}
	

	public function actionView()
	{
		$products_session = $this->_getSession();
		
		$products = array();
		$subTotal = 0;
		foreach ($products_session as $pid=>$quantity)
		{
			$products[$pid] = array();
			$products[$pid]['quantity'] = $quantity;
			$products[$pid]['product'] = Product::model()->with('images')->findByPk($pid);
			
			// Calculate the running subtotal
			$subTotal += $products[$pid]['product']->price * $quantity;
		}
		
		$this->render(
			'view',
			array(
				'products' => $products,
				'subTotal' => $subTotal
			)
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