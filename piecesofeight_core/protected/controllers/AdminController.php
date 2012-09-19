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


	function actionOrders()
	{
		$this->render('orders');
	}
}