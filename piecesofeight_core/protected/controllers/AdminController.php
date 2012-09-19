<?php

class AdminController extends GxController 
{


	public function filters()
	{
		return array(
			'accessControl',
		);
	}
	
	public function accessRules()
	{
		return array(
			// Only accessable if not a guest
			array('allow', 'users' => array('@')),
			array('deny', 'users' => array('*')),
		);
	}
	



	// 
	//
	// Admin Section
	//
	//
	
	function actionIndex()
	{

		$this->render('index');
	}


	function actionOrder($id)
	{
		$order = Order::model()->findByPk($id);

		if (isset($_POST['Order'])) 
		{
			$order->order_status = $_POST['Order']['order_status'];
			$order->save();
			
			$this->redirect(array('admin/orders'));
		}

		$this->render(
			'order',
			array(
				'order' => $order
			)
		);
	}


	// @todo: Would be nice in the future to track when orders are shipped, etc..
	function actionOrders()
	{
		$orders_list = Order::model()->findAll(
			array(
				'order' => 'order_date ASC'
			)
		);

		$orders = array();

		// Setup the orders to have an entry for each order state
		foreach (array('open','active','ready','shipped','completed') as $enum_value)
		{
			$orders[$enum_value] = array();
		}

		// Fill in the orders array
		foreach ($orders_list as $order)
		{
			array_push($orders[$order->order_status], $order);
		}

		// Reverse the order of the completed list
		$orders['completed'] = array_reverse($orders['completed']);

		$this->render(
			'orders',
			array(
				'orders' => $orders
			)
		);
	}
}