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
	
	
	public function actionView()
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
		
		$this->render(
			'view',
			array(
				'products' => $products,
				'shipping' => number_format($shipping, 2),
				'subTotal' => number_format($subTotal,2), // converts $x to $x.00
				'AddcartModel' => new AddcartForm,
			)
		);
	}
	
	
	
	public function actionCheckout()
	{
		$this->_emptyCart();
	
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