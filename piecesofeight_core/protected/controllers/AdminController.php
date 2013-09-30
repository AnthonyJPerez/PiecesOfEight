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
		$this->render(
			'index',
			array(
				'totalOpenOrders' => Order::model()->count(
					array(
						'condition' => 'order_status=:status',
						'params' => array(':status' => 'open')
					)
				),
				'totalOrders' => Order::model()->count(),
				'totalOrdersMonth' => Order::model()->count(
					array(
						'condition' => 'MONTH(CURDATE()) = MONTH(order_date) AND YEAR(CURDATE()) = YEAR(order_date)',

					)
				)
			)
		);
	}


	function actionFeedback($id=null)
	{
      	$feedback = ($id == null)
      		? new Feedback()
      		: Feedback::model()->findByPk($id);

      	// Was data posted?
		if (isset($_POST['Feedback'])) 
		{
			// Debug output, remove for production.
			//print_r($_POST);
		
			$feedback->setAttributes($_POST['Feedback']);

			$date = new DateTime($feedback->date_inserted);
			$feedback->date_inserted = $date->format('Y-m-d');

			if ($feedback->save())
			{
				$this->redirect($this->createUrl('admin/index'));
			}
		}

		$this->render(
			'feedback',
			array(
				'_Products' => Product::model()->findAll(),
				'_Feedback' => $feedback
			)
		);
	}


	// Shows details of one order
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
	// Lists all orders in the system
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