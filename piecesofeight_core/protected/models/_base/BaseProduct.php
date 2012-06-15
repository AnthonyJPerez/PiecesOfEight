<?php

/**
 * This is the model base class for the table "p8_product".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Product".
 *
 * Columns in table "p8_product" available as properties of the model,
 * followed by relations of table "p8_product" available as properties of the model.
 *
 * @property string $id
 * @property string $name
 * @property string $price
 * @property string $date_inserted
 * @property string $description
 * @property string $category_id
 * @property string $size_chart
 * @property string $care_information
 * @property string $default_image_id
 *
 * @property Gallery[] $galleries
 * @property Image[] $images
 * @property Category $category
 * @property Image $defaultImage
 * @property Measurement[] $p8Measurements
 * @property Size[] $p8Sizes
 * @property Tag[] $p8Tags
 */
abstract class BaseProduct extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'p8_product';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Product|Products', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name, price, category_id', 'required'),
			array('name', 'length', 'max'=>255),
			array('price', 'length', 'max'=>6),
			array('category_id, default_image_id', 'length', 'max'=>10),
			array('date_inserted, description, size_chart, care_information', 'safe'),
			array('date_inserted, description, size_chart, care_information, default_image_id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, price, date_inserted, description, category_id, size_chart, care_information, default_image_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'galleries' => array(self::HAS_MANY, 'Gallery', 'product_id'),
			'images' => array(self::HAS_MANY, 'Image', 'product_id'),
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'defaultImage' => array(self::BELONGS_TO, 'Image', 'default_image_id'),
			'p8Measurements' => array(self::MANY_MANY, 'Measurement', 'p8_product_measurement(product_id, measurement_id)'),
			'p8Sizes' => array(self::MANY_MANY, 'Size', 'p8_size_product(product_id, size_id)'),
			'p8Tags' => array(self::MANY_MANY, 'Tag', 'p8_tag_product(product_id, tag_id)'),
		);
	}

	public function pivotModels() {
		return array(
			'p8Measurements' => 'ProductMeasurement',
			'p8Sizes' => 'SizeProduct',
			'p8Tags' => 'TagProduct',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'name' => Yii::t('app', 'Name'),
			'price' => Yii::t('app', 'Price'),
			'date_inserted' => Yii::t('app', 'Date Inserted'),
			'description' => Yii::t('app', 'Description'),
			'category_id' => null,
			'size_chart' => Yii::t('app', 'Size Chart'),
			'care_information' => Yii::t('app', 'Care Information'),
			'default_image_id' => null,
			'galleries' => null,
			'images' => null,
			'category' => null,
			'defaultImage' => null,
			'p8Measurements' => null,
			'p8Sizes' => null,
			'p8Tags' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('price', $this->price, true);
		$criteria->compare('date_inserted', $this->date_inserted, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('size_chart', $this->size_chart, true);
		$criteria->compare('care_information', $this->care_information, true);
		$criteria->compare('default_image_id', $this->default_image_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}