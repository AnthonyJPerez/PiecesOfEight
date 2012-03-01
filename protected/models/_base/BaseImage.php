<?php

/**
 * This is the model base class for the table "p8_image".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Image".
 *
 * Columns in table "p8_image" available as properties of the model,
 * followed by relations of table "p8_image" available as properties of the model.
 *
 * @property string $id
 * @property string $url
 * @property string $product_id
 *
 * @property Product $product
 */
abstract class BaseImage extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'p8_image';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Image|Images', $n);
	}

	public static function representingColumn() {
		return 'url';
	}

	public function rules() {
		return array(
			array('url, product_id', 'required'),
			array('url', 'length', 'max'=>255),
			array('product_id', 'length', 'max'=>10),
			array('id, url, product_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'url' => Yii::t('app', 'Url'),
			'product_id' => null,
			'product' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('product_id', $this->product_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}