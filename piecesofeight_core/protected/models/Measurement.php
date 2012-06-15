<?php

Yii::import('application.models._base.BaseMeasurement');

class Measurement extends BaseMeasurement
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}