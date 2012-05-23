<?php

Yii::import('application.models._base.BaseNewsletter');

class Newsletter extends BaseNewsletter
{
	public $email;
	
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
			array('email', 'required'),
			
			// email is safe
			array('email', 'safe'),
			
			// email must be unique
			array('email', 'unique', 'className' => 'Newsletter', 'message' => "This email is already signed up for the newsletter!"),
			
			// email has to be a valid email address
			array('email', 'email')
		);
	}
}