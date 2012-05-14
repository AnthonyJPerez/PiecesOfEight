<?php

Yii::import('application.models._base.BaseGallery');

class Gallery extends BaseGallery
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}