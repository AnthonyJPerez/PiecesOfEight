<?php

Yii::import('application.models._base.BaseProduct');

class Product extends BaseProduct
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function behaviors()
	{
		return array(
			'ESaveRelatedBehavior' => array(
				'class' => 'application.components.ESaveRelatedBehavior'
			)
		);
	}
	
	
	public function rules()
	{
		return array(
			array('name, price, category_id, description, size_chart, care_information', 'required'),
			array('name', 'length', 'max'=>75),
			array('name,description,size_chart,care_information', 'type', 'type'=>'string'),
			array('name', 'unique', 'className' => 'Product'),
			array('price', 'length', 'max'=>7),
			array('price', 'type', 'type'=>'float'),
			array('category_id', 'exist', 'attributeName'=>'id', 'className'=>'Category'),
			array('date_inserted, description, size_chart, care_information', 'safe'),
			array('date_inserted, description, size_chart, care_information', 'default', 'setOnEmpty' => true, 'value' => null),
		);
	}
}