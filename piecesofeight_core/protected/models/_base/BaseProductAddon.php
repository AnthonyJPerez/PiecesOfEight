<?php

/**
 * This is the model base class for the table "p8_product_addon".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ProductAddon".
 *
 * Columns in table "p8_product_addon" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $product_id
 * @property string $addon_id
 * @property string $price
 *
 */
abstract class BaseProductAddon extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'p8_product_addon';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'ProductAddon|ProductAddons', $n);
	}

	public static function representingColumn() {
		return array(
			'product_id',
			'addon_id',
		);
	}

	public function rules() {
		return array(
			array('product_id, addon_id, price', 'required'),
			array('product_id, addon_id', 'length', 'max'=>10),
			array('price', 'length', 'max'=>6),
			array('product_id, addon_id, price', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'product_id' => null,
			'addon_id' => null,
			'price' => Yii::t('app', 'Price'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('product_id', $this->product_id);
		$criteria->compare('addon_id', $this->addon_id);
		$criteria->compare('price', $this->price, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}