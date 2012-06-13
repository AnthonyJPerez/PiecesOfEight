<?php

Yii::import('application.models._base.BaseProduct');

class Product extends BaseProduct
{
	public $imgNotAvailable = "image-not-available.png";
	

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
			array('name, price, category_id, description, care_information', 'required'),
			array('name', 'length', 'max'=>75),
			array('name,description,size_chart,care_information', 'type', 'type'=>'string'),
			array('name', 'unique', 'className' => 'Product'),
			array('price', 'length', 'max'=>7),
			array('price', 'type', 'type'=>'float'),
			array('category_id', 'exist', 'attributeName'=>'id', 'className'=>'Category'),
			//array('default_image_id', 'exist', 'attributeName'=>'id', 'className'=>'Image'), <-- can use this, but must support null as well
			array('date_inserted, description, care_information', 'safe'),
			array('date_inserted, description, care_information', 'default', 'setOnEmpty' => true, 'value' => null),
		);
	}
	
	
	
	
	
	public function getSlug()
	{
		$slug = preg_replace("/[^A-Za-z0-9\s\s+]/",'', $this->name);
		$slug = preg_replace("/[\s]+/", '-', $slug);
				
		return strtolower($slug);
	}
	
	
	public function getProductImgAltDescription()
	{
		// Returns a description suitable for the 'alt' tag for a product's image
		$name = preg_replace("/[^A-Za-z0-9\s\s+]/",'', $this->name);
		return strtolower($name) . " found in " . $this->category;
	}
	
	
	// Creates a url with the product name in the url:
	// /product/[id]/[name-of-product]
	public function getUrl($absolute=false)
	{
		$params = array('id' => $this->id);
		
		// add the name parameter to the URL
		if ($this->hasAttribute('name'))
		{		
			$params['name'] = $this->getSlug();
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
	
	
	
	private function _getImageNotAvailable()
	{
		$img = new Image();
		$img->url = "image-not-available.png";
		$img->id = 0;
		return $img;
	}
	
	
	
	
	public function getImages()
	{
		$images = $this->images;
		
		if ($images != null)
		{
			return $images;
		}
		else
		{
			return array(
				$this->_getImageNotAvailable()
			);
		}
	}
	
	
	
	
	public function getDefaultImage()
	{
		$image = $this->defaultImage;
		
		
		if ($image != null)
		{
			return $image;
		}
		else
		{
			return $this->_getImageNotAvailable();
		}
	}
}