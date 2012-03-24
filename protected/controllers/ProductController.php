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
					$this->createUrl(
						'cart/add', 
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
			'model' => Product::model()->with('p8Sizes')->findByPk($id),
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
	




	/*
Array
(
    [Product] => Array
        (
            [name] => Product Name
            [price] => 100
            [description] => Description
            [category_id] => 1
        )

    [duplicate_image] => Array
        (
            [duplicate_image] => Array
                (
                    [0] => Array
                        (
                            [Product[image] => 
                        )

                )

        )

    [Size] => Array
        (
            [size] => Array
                (
                    [0] => 1
                    [1] => 5
                )

        )

    [SizeProduct] => Array
        (
            [size_chart] => Array
                (
                    [0] => size_chart_XS
                    [1] => 
                    [2] => 
                    [3] => 
                    [4] => size_chart_XL
                )

        )

    [Tag] => Array
        (
            [name] => Array
                (
                    [0] => 2
                )

        )

    [yt0] => Save
	*/
	public function actionCreate() 
	{
      	$product = new Product();

		if (isset($_POST['Product'])) 
		{
			$product->setAttributes($_POST['Product']);
			$product->date_inserted = new CDbExpression('now()');
			
			if ($product->save())
			{
				// Upload the images
				$images_to_upload = array();
				$images = CUploadedFile::getInstancesByName('images');
				if ( isset($images) && count($images) > 0 )
				{
					$counter = 0;
					foreach ($images as $i=>$data)
					{
						$filename = 'product-'.$product->id .'_'.$counter.'.'.$data->getExtensionName();
						$counter++;
						if ($data->saveAs(Yii::getPathOfAlias('webroot').'/images/products/'.$filename))
						{
							// Successfully saved to the folder, now add it to be saved in the database
							$img = new Image();
							$img->url = $filename;
							$img->product_id = $product->id;
							array_push($images_to_upload, $img);
						}
					}
				}
				
				
				$product->p8Tags = $_POST['Product']['p8Tags'] === '' ? null : $_POST['Product']['p8Tags'];
				$product->p8Sizes = $_POST['Product']['p8Sizes'] === '' ? null : $_POST['Product']['p8Sizes'];
				$product->images = $images_to_upload;
				if ( $product->saveWithRelated(array('images','p8Tags','p8Sizes')) )
				{					
					if (Yii::app()->getRequest()->getIsAjaxRequest())
						Yii::app()->end();
					else
						$this->redirect(array('view', 'id' => $product->id));
				}	
			}
		}
		
		// TEST
		//echo "<pre>";
		//echo print_r($images, true);
		//echo print_r($relatedData, true);
		//echo print_r($_POST, true);
		//echo "</pre>";
		
		$this->render(
			'create', 
			array( 
				'_Product' => $product,
				'_Image' => new Image,
				'_Size' => new Size,
				'_SizeProduct' => new SizeProduct,
				'_Tag' => new Tag,
				//'_TagProduct' => new TagProduct
			)
		);
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