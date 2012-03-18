<?php

class CartController extends Controller
{
	public $defaultAction = 'view';
	
	

	
	public function actionAdd()
	{
		$model = new AddcartForm;
		
		if (isset($_POST['AddcartForm']))
		{
			$model->attributes = $_POST['AddcartForm'];
			
			if ($model->validate())
			{
				$products = $this->_getSession();
				$products[$model->product_id] += $model->quantity;
				$this->_setSession($products);
			}
		}
		
		$this->redirect(array('cart/view'));
	}
	

	public function actionEmpty()
	{
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		
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
				unset($products[$model->product_id]);
				$this->_setSession($products);
			}
		}
		
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
		$subTotal = 0.00;
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
				'subTotal' => number_format($subTotal,2), // converts $x to $x.00
				'AddcartModel' => new AddcartForm,
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