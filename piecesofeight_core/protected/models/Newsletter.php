<?php

Yii::import('application.models._base.BaseNewsletter');

class Newsletter extends BaseNewsletter
{
	public $email;
	public $confirmEmail;
	public $verifyCode;
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	
	/*
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// email is required
			array('email', 'required', 'on'=>'inline'),
			array('email, confirmEmail', 'required', 'on'=>'default'),
			
			// email is safe
			array('email, confirmEmail', 'safe'),
			
			// email must be unique
			array('email', 'unique', 'className' => 'Newsletter', 'message' => "This email is already signed up for the newsletter!"),
			
			// email has to be a valid email address
			array('email, confirmEmail', 'email', 'on'=>'default'),
			array('email', 'email', 'on'=>'inline'),
			
			// emails must match
			array('confirmEmail', 'compare', 'compareAttribute' => 'email', 'on'=>'default'),
			
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'default'),
		);
	}
}