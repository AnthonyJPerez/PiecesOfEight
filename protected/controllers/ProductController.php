<?php

class ProductController extends GxController 
{
	public $layout = '//layouts/column1';




	public function actionView($id) 
	{
		$model = new AddcartForm;
		
		/*if(isset($_POST['ajax']) && $_POST['ajax']==='add-cart-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}*/
		
		if (isset($_POST['AddcartForm']))
		{
			$model->attributes = $_POST['AddcartForm'];
			
			if ($model->validate())
			{
				$this->redirect(
					$this->createUrl('cart/add', 
						array(
							'product_id'=>$model->product_id,
							'size' => $model->size,
							'quantity' => $model->quantity
						)
					)
				);
			}
		}
		
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Product'),
			'formModel' => $model,
		));
	}
	
	
	public function actionList($category=null)
	{	
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
		/*// If the category is 'new', then only show products posted within the last 6 months.
		else if ($category === 'new')
		{
			// @todo THIS DOES NOT WORK, FIX IT!!!!
			$date_SixMonthsOld = mktime(0, 0, 0, date("m")-6, date("d"),   date("Y"));
			$criteria['condition'] = 'date_inserted > ' . $date_SixMonthsOld;
		}*/
		
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
	
	
	public function actionLookbook() 
	{
		$this->render('lookbook');
	}
	

	public function actionCreate() 
	{
      	$model = new Product;


		if (isset($_POST['Product'])) 
		{
			$model->setAttributes($_POST['Product']);
			$model->date_inserted = new CDbExpression('now()');
			
			$relatedData = array(
		    		'p8Tags' => $_POST['Product']['p8Tags'] === '' ? null : $_POST['Product']['p8Tags'],
		    	);
		
			if ($model->saveWithRelated($relatedData)) 
			{
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
}