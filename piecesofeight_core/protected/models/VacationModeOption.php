<?php

Yii::import('application.models.Option');

class VacationModeOption extends Option
{
	public function rules()
	{
		return array(
			array('message', 'length', 'max'=>800),
			array('message', 'type', 'type'=>'string'),
			array('enabled', 'length', 'max'=>1),
			array('enabled', 'type', 'type'=>'integer'),
			array('enabled, message', 'safe'),
			array('optionalData', 'default', 'setOnEmpty' => true, 'value' => null),
		);
	}


	public static function loadData()
	{
		$vacationModeModel = self::model();
		$message = $vacationModeModel->message;

		// Convert newlines to <br /> tags:
		$message = str_replace("\n", "<br />", $message);

		return array (
			'enabled' => $vacationModeModel->isEnabled(),
			'message' => ("" != $message) 
				? $message
				: "Site temporarily disabled! We should be back shortly..."
		);
	}


	public function getMessage()
	{
		return (NULL != $this->optionalData)
			? unserialize(base64_decode($this->optionalData))
			: "";
	}


	public function setMessage($message)
	{
		$this->optionalData = base64_encode(serialize($message));
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className)->findByPk(self::VACATION_MODE_ID);
	}
}