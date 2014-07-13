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
		$this->render(
			'comments',
			array(
				'_Comments' => Feedback::model()->findAll(array('order'=>'date_inserted DESC'))
			)
		);
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
				// Email the form
				$msg = new YiiMailMessage;
				$msg->view = 'contact';
				$msg->addTo(Yii::app()->params['adminEmail']);
				$name = ucfirst($model->name);
				$msg->setFrom(array($model->email => $name));
				$msg->setSubject($model->subject);

				// Append the user's email to the body.
				$fromEmailMsg = "[Email from \"".$name."\" ".$model->email." ]";
				$model->body = $fromEmailMsg . "<br /><br />" . $model->body;

				$msg->setBody(array('model'=>$model), 'text/html');

				try
				{
					// Mail it!
					$result = Yii::app()->mail->send($msg);
					Yii::trace(CVarDumper::dumpAsString($result));
				
					Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to your email as soon as we can!');
					$this->refresh();
				}
				catch (Exception $e)
				{
					Yii::trace(CVarDumper::dumpAsString($e));
				}
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
	
	public function actionWebmasterContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				// Email the form
				$msg = new YiiMailMessage;
				$msg->view = 'contact';
				$msg->addTo(Yii::app()->params['webmasterEmail']);
				$name = ucfirst($model->name);
				$msg->setFrom(array($model->email => $name));
				$msg->setSubject("[Webmaster Inquiry] " . $model->subject);
				$msg->setBody(array('model'=>$model), 'text/html');
	
				// Mail it!
				Yii::app()->mail->send($msg);
				
				Yii::app()->user->setFlash('contact','Thank you for contacting our Webmaster!');
				$this->refresh();
			}
		}
		$this->render(
			'webmasterContact',
			array(
				'model' => $model
			)
		);
	}
	
	
	//
	// Adds a user to the newsletter list and displays the 
	// confirmation page.
	public function actionNewsletter()
	{
		$model=new Newsletter('default');
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='newsletter')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		else if (isset($_POST['Newsletter']))
		{
			$model->attributes=$_POST['Newsletter'];
			$model->date_enrolled = new CDbExpression('now()');
			
			if($model->save())
			{
				Yii::app()->user->setFlash('newsletter','Thank you for subscribing to our newsletter! Please add .... to your contacts to ensure you get our emails.');
				$this->refresh();
			}
		}
		
		$this->render(
			'newsletter',
			array (
				'model' => $model,
			)
		);
	}
	
	//
	// Adds a user to the newsletter list and displays the 
	// confirmation page.
	public function actionNewsletterInline()
	{
		$model=new Newsletter('inline');
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='newsletter')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		else if (isset($_POST['Newsletter']))
		{
			$model->attributes=$_POST['Newsletter'];
			$model->date_enrolled = new CDbExpression('now()');
			
			if($model->save())
			{
				Yii::app()->user->setFlash('newsletter','Thank you for subscribing to our newsletter! Please add .... to your contacts to ensure you get our emails.');
				$this->refresh();
			}
		}
		
		$this->render(
			'newsletter',
			array (
				'model' => $model,
			)
		);
	}
	
	public function actionSizeChart()
	{
		echo "<html><body style='padding: 0; margin: 0;'>";
		echo CHtml::image(
			Yii::app()->baseUrl . '/images/Size-Chart.png',
			'Size Chart',
			array(
				'width' => 800,
				'height' => 1340
			)
		);
		echo "</body></html>";
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
				$this->redirect($this->createUrl('admin/index'));
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