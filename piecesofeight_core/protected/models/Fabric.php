<?php

Yii::import('application.models._base.BaseFabric');

class Fabric extends BaseFabric
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}