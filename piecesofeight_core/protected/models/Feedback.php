<?php

Yii::import('application.models._base.BaseFeedback');

class Feedback extends BaseFeedback
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function rules()
	{
		return array(
			array('comment, geo_location, web_location, date_inserted, product_id', 'required'),
			array('comment,geo_location,web_location', 'type', 'type'=>'string'),
			array('date_inserted', 'date', 'format'=>'yyyy-MM-dd'),
			array('product_id', 'exist', 'attributeName'=>'id', 'className'=>'Product'),
			array('comment, geo_location, web_location, date_inserted, product_id', 'safe'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'geo_location' => 'City / State',
			'web_location' => 'Website',
			'date_inserted' => 'Comment Date',
			'product_id' => 'Referenced Product'
		);
	}
}