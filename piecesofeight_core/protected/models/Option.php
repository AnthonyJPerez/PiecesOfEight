<?php

Yii::import('application.models._base.BaseOption');

class Option extends BaseOption
{
	// Option IDs
	const VACATION_MODE_ID = 1;  // Vacation Mode option has the primary key of 0.

	// constants
	const OPTION_ENABLED = 1;
	const OPTION_DISABLED = 0;


	public function isEnabled()
	{
		return (self::OPTION_ENABLED == $this->enabled);
	}


	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}