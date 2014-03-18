<?php

Yii::import('application.models.Option');

class PaypalSandboxOption extends Option
{
	public function rules()
	{
		return array(
			array('enabled', 'length', 'max'=>1),
			array('enabled', 'type', 'type'=>'integer'),
			array('enabled', 'safe'),
			array('optionalData', 'default', 'setOnEmpty' => true, 'value' => null),
		);
	}


	public static function loadData()
	{
		$paypalSandboxModel = self::model();

		return array (
			'enabled' => $paypalSandboxModel->isEnabled()
		);
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className)->findByPk(self::PAYPAL_SANDBOX_MODE_ID);
	}
}