<?php

class ProductController extends GxController 
{


	public function filters()
	{
		return array(
			'accessControl',
		);
	}
	
	public function accessRules()
	{
		return array(
			// Only accessable if not a guest
			array(
				'deny', 
				'actions' => array('create'),
				'users' => array('?')
				),
			
			array('allow', 'users' => array('*')),
		);
	}
	

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
	
	
	// Used to generate XML specific for Google's product feed
	public function actionGoogleProductFeed()
	{
		$products = Product::model()->with('images', 'p8Sizes')->findAll();
		header('Content-Type: text/xml');
		echo '<?xml version="1.0"?>';
		echo '<feed xmlns="http://www.w3.org/2005/Atom" xmlns:g="http://base.google.com/ns/1.0" xmlns:c="http://base.google.com/cns/1.0">';
	
		echo '<id>tag:piecesofeightcostumes.com,2012-04-21:/index.php?r=product/googleProductFeed</id>';
		echo '<title>Pieces of Eight Product Listings</title>';
		echo '<link href="http://piecesofeightcostumes.com" rel="alternate" type="text/html" />';
		echo '<updated>2012-04-21T02:46:00Z</updated>';
		echo '<author><name>Pieces of Eight Costumes</name></author>';
	
		// Generate each product:
		$group_id = 0;
		foreach ($products as $product)
		{
			$group_id++;
			$variant_id = 0;
			// Size Variants
			foreach ($product->p8Sizes as $size)
			{
				$variant_id++;
				echo '<entry>';
					echo '<g:id>po8_'.$product->id.'_'.$variant_id.'</g:id>';
					echo '<g:item_group_id>'.$group_id.'</g:item_group_id>';
					echo '<title>'.$product->name.'</title>';
					echo '<description>[Custom Made to Order] '.$product->description.'</description>';
					echo '<g:google_product_category>Apparel &amp; Accessories &gt; Costumes &amp; Accessories &gt; Costumes</g:google_product_category>';
					echo '<g:product_type>'.ucfirst($product->category).'</g:product_type>';
					echo '<link>http://piecesofeightcostumes.com/index.php?r=product/view&amp;id='.$product->id.'</link>';
					
					// List the pictures
					echo '<g:image_link>http://piecesofeightcostumes.com/images/product-images/'.$product->defaultImage->url.'</g:image_link>';
					foreach ($product->images as $img)
					{
						if ($img->id != $product->defaultImage->id)
						{
							echo '<g:additional_image_link>http://piecesofeightcostumes.com/images/product-images/'.$img->url.'</g:additional_image_link>';
						}
					}
					echo '<g:condition>new</g:condition>';
					echo '<g:availability>available for order</g:availability>';
					echo '<g:price>'.$product->price.' USD</g:price>';
					// echo '<g:sale_price></g:sale_price>';
					echo '<g:brand></g:brand>';
					
					// Update when products specify their gender
					echo '<g:gender>unisex</g:gender>';
					echo '<g:age_group>Adult</g:age_group>';
					
					// Update when products specify their colors
					echo '<g:color>Custom</g:color>';
					
					echo '<g:size>'.$size.'</g:size>';
					
					
					// Update if taxes change
					echo '<g:tax>';
						echo '<g:country>US</g:country>';
						echo '<g:region>OR</g:region>';
						echo '<g:rate>0</g:rate>';
						echo '<g:tax_ship>n</g:tax_ship>';
					echo '</g:tax>';
					
					// Update if shipping info changes:
					echo '<g:shipping>';
						echo '<g:country>US</g:country>';
						echo '<g:service>Ground</g:service>';
						echo '<g:price>8.95 USD</g:price>';
					echo '</g:shipping>';
					
				echo '</entry>';
			}
		}
		
		echo '</feed>';
		exit();
	
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
      		$product = Product::model()->with('p8Sizes', 'images', 'p8Tags', 'defaultImage')->findByPk($id);
      	}
      	
		if (isset($_POST['Product'])) 
		{
			// Debug output, remove for production.
			//print_r($_POST);
		
			$product->setAttributes($_POST['Product']);
			$product->date_inserted = new CDbExpression('now()');
			
			if ($product->save())
			{
				// Upload the images
				$uploaded_images = array();
				$images = CUploadedFile::getInstancesByName('images');
				if ( isset($images) && count($images) > 0 )
				{
					foreach ($images as $i=>$data)
					{
						// Create image record in database
						$img = new Image();
						$img->product_id = $product->id; 	// Add a reference to this image for this product.
						$img->url = "empty_filename";
						$img->save();
						array_push($uploaded_images, $img);
						
						// Save file to the disk
						$filename = 'product-'.$product->id .'_'.$img->id.'.'.$data->getExtensionName();
						$filepath = realpath(Yii::getPathOfAlias('webroot').'/images/product-images').'/'.$filename;
						if ($img->id != null && $data->saveAs($filepath))
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
							$img->save();
						}
					}
				}
				
				
				//
				// Delete any unchecked images:
				//
				
				// grab list of current images IDs
				$old_images = array();
				foreach ($product->images as $old_img)
				{
					$old_images[$old_img->id] = $old_img;
				}
				
				// grab list of images left checked
				$new_images = array();
				if (isset($_POST['Product']['images']) && is_array($_POST['Product']['images']))
				{
					foreach ($_POST['Product']['images'] as $new_img_id)
					{
						$new_images[$new_img_id] = true;
					}
				}

				// Delete images that are unchecked
				foreach ($old_images as $old_img_id=>$old_image)
				{
					if (!array_key_exists($old_img_id, $new_images))
					{
						$filepath = realpath(Yii::getPathOfAlias('webroot').'/images/product-images').'/'.$old_image->url;
						if ( unlink($filepath) )
						{
							Image::model()->deleteByPk($old_img_id);
							
							// If the deleted image was the default image, delete the default image selection from the form:
							if ($_POST['Product']['defaultImage'] == $old_img_id)
							{
								$_POST['Product']['defaultImage'] = '';
							}
						}
					}
				}
								
				
				$product->p8Tags = $_POST['Product']['p8Tags'] === '' ? null : $_POST['Product']['p8Tags'];
				$product->p8Sizes = $_POST['Product']['p8Sizes'] === '' ? null : $_POST['Product']['p8Sizes'];
				
				if ($_POST['Product']['defaultImage'] === '')
				{
					// No default image selected, perhaps there were none to choose from.
					// If any images were uploaded, make the first one the default image:
					if (!empty($product->images))
					{
						$conditions = new CDbCriteria(array(
							'condition' => 'product_id=:productId',
							'params' => array(':productId'=>$product->id)
						));
						$current_images = Image::model()->findAll($conditions);
						$product->default_image_id = $current_images[0]->id;
					}
					else if (!empty($uploaded_images))
					{
						$product->default_image_id = $uploaded_images[0]->id;
					}
					else
					{
						$product->default_image_id = null;
					}
				}
				else
				{
					// Default image was selected
					$product->default_image_id = $_POST['Product']['defaultImage'];
				}
				
				// Save the image, and its related data.
				if ( $product->saveWithRelated(array('p8Tags','p8Sizes')) )
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