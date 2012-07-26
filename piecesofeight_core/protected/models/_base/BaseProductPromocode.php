<?php

/**
 * This is the model base class for the table "p8_product_promocode".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ProductPromocode".
 *
 * Columns in table "p8_product_promocode" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $product_id
 * @property string $promocode_id
 *
 */
abstract class BaseProductPromocode extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'p8_product_promocode';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'ProductPromocode|ProductPromocodes', $n);
	}

	public static function representingColumn() {
		return array(
			'product_id',
			'promocode_id',
		);
	}

	public function rules() {
		return array(
			array('product_id, promocode_id', 'required'),
			array('product_id, promocode_id', 'length', 'max'=>10),
			array('product_id, promocode_id', 'safe', 'on'=>'search'),
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
			'promocode_id' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('product_id', $this->product_id);
		$criteria->compare('promocode_id', $this->promocode_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}