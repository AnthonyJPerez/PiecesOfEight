<?php

class ProductController extends GxController 
{
	public $layout = '//layouts/column1';




	public function actionView($id) 
	{
		$model = new AddcartForm;
		
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
	

	public function actionCreate($id=null) 
	{
		if ($id == null)
		{
      		$product = new Product();
      	} 
      	else
      	{
      		$product = Product::model()->with('p8Sizes', 'images', 'p8Tags')->findByPk($id);
      	}

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
					foreach ($images as $i=>$data)
					{
						// Create image record in database
						$img = new Image();
						$img->product_id = $product->id; 	// Add a reference to this image for this product.
						$img->save();
						
						// Save file to the disk
						$filename = 'product-'.$product->id .'_'.$img->id.'.'.$data->getExtensionName();
						$filepath = realpath(Yii::getPathOfAlias('webroot').'/images/product-images').'/'.$filename;
						if ($data->saveAs($filepath))
						{
							// Image successfully uploaded and saved in the /images/product-images/ directory
							
							// Resize the image
							$img_edit = Yii::app()->YImage->load($filepath);
							$img_edit->resize(600, 800);
							$img_edit->save();
							
							// Make a thumbnail version as well
							//$img_edit->resize(.., ..);
							//$img_edit->save();
							
							// Add this img to a list of images to be added to the product
							// This list will auto-save any changes, or create any new, Image records in the database:
							$img->url = $filename;
							array_push($images_to_upload, $img);
						}
					}
				}
				
				
				$product->p8Tags = $_POST['Product']['p8Tags'] === '' ? null : $_POST['Product']['p8Tags'];
				$product->p8Sizes = $_POST['Product']['p8Sizes'] === '' ? null : $_POST['Product']['p8Sizes'];
				
				
				$old_images = (isset($product->images) && count($product->images) > 0) ? $product->images : array();
				$product->images = array_merge($old_images, $images_to_upload);
				
				//$product->images = $images_to_upload;
				
				if ( $product->saveWithRelated(array('images','p8Tags','p8Sizes')) )
				{					
					if (Yii::app()->getRequest()->getIsAjaxRequest())
						Yii::app()->end();
					else
						$this->redirect(array('view', 'id' => $product->id));
				}	
			}
		}
		
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
	
	
	
	
	
	
	
	
	
	

    	public function actionUpdate($id) 
	{
      	$this->actionCreate($id);
	}
/*
    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Product')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }*/
}