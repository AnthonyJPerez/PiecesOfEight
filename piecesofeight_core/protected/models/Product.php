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
			//array('default_image_id', 'exist', 'attributeName'=>'id', 'className'=>'Image'), <-- can use this, but must support null as well
			array('date_inserted, description, size_chart, care_information', 'safe'),
			array('date_inserted, description, size_chart, care_information', 'default', 'setOnEmpty' => true, 'value' => null),
		);
	}
	
	
	// Creates a url with the product name in the url:
	// /product/[id]/[name-of-product]
	public function getUrl($absolute=false)
	{
		$params = array('id' => $this->id);
		
		// add the name parameter to the URL
		if ($this->hasAttribute('name'))
		{
			//$slug = preg_replace('@[\s!:;_\?=\\\+\*/%&#]+@', '-', $this->name);
				//this will replace all non alphanumeric char with '-'
			//$slug = mb_strtolower($slug);
				//convert string to lowercase
			//$slug = trim($slug, '-');
				//trim whitespaces
				
			$slug = preg_replace("/[^A-Za-z0-9\s\s+]/",'', $this->name);
			$slug = preg_replace("/[\s]+/", '-', $slug);
				
			$params['name'] = strtolower($slug);
		}
		
		if ($absolute === true)
		{
			return Yii::app()->createAbsoluteUrl('product/view', $params);
		}
		else
		{
			return Yii::app()->urlManager->createUrl('product/view', $params);
		}
	}
}