<?php

class ProductController extends GxController 
{
	public $layout = '//layouts/column1';




	public function actionView($id) 
	{
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Product'),
			'formModel' => new AddcartForm,
		));
	}
	
	
	public function actionList($category=null)
	{	
		// @todo: clean this parameter!
		// ...
		
		// Find the category id
		$CategoryModel = Category::model()->find(
			array(
				'select' => 'id',
				'condition' => 'name=:name',
				'params' => array(':name' => $category)
			)
		);
			
		// Select any images associated with this product as well.
		$criteria = array(
			'with' => array('images'),
		);
		
		// If the data is a valid category, then only show that category.
		// else default to showing all products
		if ( !is_null($CategoryModel) )
		{	
			$criteria['condition'] = 'category_id='.$CategoryModel->id;
		}
		
		$this->render('list', array(
			'dataProvider' => new CActiveDataProvider('Product', 
				array(
					'criteria' => $criteria,
					'pagination' => array(
						'pageSize' => 12
					),
				)
			),
			'category' => $category,
		));
	}
	
	
	public function actionIndex() 
	{
		$dataProvider = new CActiveDataProvider('Product');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}
	

	/*public function actionCreate() {
		$model = new Product;


		if (isset($_POST['Product'])) {
			$model->setAttributes($_POST['Product']);
			$relatedData = array(
				'p8Tags' => $_POST['Product']['p8Tags'] === '' ? null : $_POST['Product']['p8Tags'],
				);

			if ($model->saveWithRelated($relatedData)) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Product');


		if (isset($_POST['Product'])) {
			$model->setAttributes($_POST['Product']);
			$relatedData = array(
				'p8Tags' => $_POST['Product']['p8Tags'] === '' ? null : $_POST['Product']['p8Tags'],
				);

			if ($model->saveWithRelated($relatedData)) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Product')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	

	public function actionAdmin() {
		$model = new Product('search');
		$model->unsetAttributes();

		if (isset($_GET['Product']))
			$model->setAttributes($_GET['Product']);

		$this->render('admin', array(
			'model' => $model,
		));
	}*/

}