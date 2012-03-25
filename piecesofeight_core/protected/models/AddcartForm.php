<?php


class AddcartForm extends CFormModel
{
	public $product_id;
	public $quantity=1;
	public $size;
	
	
	
	
	public function rules()
	{
		return array(
			array('product_id, quantity, size', 'required'),
			array('product_id', 'exist', 'attributeName'=>'id', 'className'=> 'Product'),
			array('size', 'exist', 'attributeName'=>'size', 'className'=>'Size'),
			array('quantity', 'numerical', 'integerOnly'=>true, 'max'=>10, 'min'=>1),
		);
	}
	
	
	public function attributeLabels()
	{
		return array(
			'product_id' => 'Prouct ID',
			'quantity' => 'Quantity',
			'size' => 'Size',
		);
	}
}


?>