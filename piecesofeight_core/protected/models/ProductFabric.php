<?php

Yii::import('application.models._base.BaseProductFabric');

class ProductFabric extends BaseProductFabric
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}