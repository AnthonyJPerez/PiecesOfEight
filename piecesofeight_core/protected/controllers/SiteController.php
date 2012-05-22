<?php

class SiteController extends GxController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render(
			'index',
			array(
				'isAdmin' => !Yii::app()->user->isGuest
			)
		);
	}
	
	public function actionSitemap()
	{
		header('Content-Type: text/xml');
		exit();
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
	public function actionComments()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('comments');
	}
	
	public function actionEvents()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('events');
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact($pid=null)
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to your email as soon as we can!');
				$this->refresh();
			}
		}
		$this->render(
			'contact',
			array(
				'model'=>$model,
				'product'=> ($pid) ? Product::model()->findByPk($pid) : null
			)
		);
	}
	
	
	//
	// Adds a user to the newsletter list and displays the 
	// confirmation page.
	public function actionNewsletter()
	{
		$model=new Newsletter;
		$success = false;
		if(isset($_POST['NewsletterForm']))
		{
			$model->attributes=$_POST['NewsletterForm'];
			
			if($model->save())
			{
				$success = true;
			}
		}
		
		$this->render(
			'newsletter',
			array ('success' => $success)
		);
	}
	
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				//$this->redirect(Yii::app()->user->returnUrl);
				$this->redirect($this->createUrl('product/list'));
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}