<?php

Yii::import('application.models._base.BaseAddon');

class Addon extends BaseAddon
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}