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
				'actions' => array('create','gallery'),
				'users' => array('?')
				),
			
			array('allow', 'users' => array('*')),
		);
	}
	

	public function actionView($id) 
	{
		$productModel = Product::model()->findByPk($id);
	
		if ( !$productModel->id)
		{
			$this->redirect(
				$this->createUrl(
					'product/list'
				),
				false, // don't terminate
				301 // status code to return: http Gone
			);
		}
		
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
			'isAdmin' => !Yii::app()->user->isGuest
		));
	}
	
	
	
	public function actionList($category=null)
	{	
		// Find the category id
		$CategoryModel = Category::model()->find(
			array(
				'select' => '*',
				'condition' => 'name=:name',
				'params' => array(':name' => $category)
			)
		);
			
		// Select any images associated with this product as well.
		$criteria = array(
			'with' => array('images'),
			'order' => 'date_inserted DESC'
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
			'categoryModel' => $CategoryModel,
		));
	}
	
	
	
	
	public function actionLookbook() 
	{
		$this->render('lookbook');
	}
	
	
	
	
	
	
	public function actionGetProductCustomForm($id=NULL, $form_id=0)
	{
		if (Yii::app()->request->isAjaxRequest || $_POST['isAjaxRequest']=='1')
		{
			// Turn off the debug logging:
			Yii::app()->log->routes[$id]->enabled=false;
			
			$product = Product::model()->findByPk($id);
			$this->renderPartial(
				'_productCustomForm', 
				array(
					'product' => $product,
					'form_id' => $form_id
				), 
				false, 
				true);
			Yii::app()->end();
		}
	}
	
	
	public function actionCustom($id=NULL)
	{
		if ($id == null)
		{
      		$product = new Product();
      	} 
      	else
      	{
      		$product = Product::model()->with('images', 'p8Tags', 'defaultImage')->findByPk($id);
      	}
      	
		$this->render(
			'custom',
			array(
				'_AllProducts' => Product::model()->with('images','p8Tags','defaultImage')->findAll(),
				'_Product' => $product
			)
		);
	}
	






	// 
	//
	// Admin Section
	//
	//
	
	
	public function actionGallery()
	{
		$_Gallery = Gallery::model()->findAll();
		
		if (isset($_POST['Gallery'])) 
		{
			// Debug output, remove for production.
			//print_r($_POST);					
			
			// Upload the images
			$uploaded_images = array();
			$images = CUploadedFile::getInstancesByName('images');
			if ( isset($images) && count($images) > 0 )
			{
				foreach ($images as $i=>$data)
				{
					// Create image record in database
					$img = new Gallery();
					//$img->product_id = $product->id; 	// Add a reference to this image for this product.
					$img->alt_description = "Description";
					$img->url = "empty_filename";
					$img->save();
					array_push($uploaded_images, $img);

					// Save file to the disk
					$filename = 'gallery-' . $img->id . '_' . $data->getName();
					$filepath = realpath(Yii::getPathOfAlias('webroot').'/images/gallery').'/'. $filename;

					if ($img->id != null && $data->saveAs($filepath))
					{
						// Image successfully uploaded and saved in the /images/product-images/ directory
						
						// Resize the image
						$img_edit = Yii::app()->YImage->load($filepath);
						$img_edit->resize(700, 525);
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
			foreach ($_Gallery as $old_img)
			{
				$old_images[$old_img->id] = $old_img;
			}
			
			// grab list of images left checked
			$new_images = array();
			if (isset($_POST['Gallery']['images']) && is_array($_POST['Gallery']['images']))
			{
				foreach ($_POST['Gallery']['images'] as $new_img_id)
				{
					$new_images[$new_img_id] = true;
				}
			}

			// Delete images that are unchecked
			foreach ($old_images as $old_img_id=>$old_image)
			{
				if (!array_key_exists($old_img_id, $new_images))
				{			
					Gallery::model()->deleteByPk($old_img_id);
			
					// Delete the file, suppressing warnings if file does not exist.
					$filepath = realpath(Yii::getPathOfAlias('webroot').'/images/gallery').'/'.$old_image->url;
					@unlink($filepath);
				}
			}
			
			$this->redirect(array('product/gallery'));
		}
		
		$this->render(
			'gallery',
			array(
				'_Gallery' => $_Gallery
			)
		);
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
			
			// Make sure the 'images' array is an empty array if there are no images
			if (empty($_POST['Product']['images']))
			{
				$_POST['Product']['images'] = array();
			}
			
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
						$img->url = "image-not-available.png";
						$img->save();
						
						// Add as a 'checked' image, so that we do not delete it
						array_push($_POST['Product']['images'], $img->id);
						array_push($uploaded_images, $img);
						
						// Save file to the disk
						$filename = '('.$product->category .')_'. $product->getSlug() . '_(p'.$product->id .'-i'.$img->id .').' . $data->getExtensionName();
						$filepath = realpath(Yii::getPathOfAlias('webroot').'/images/product-images').'/'.$filename;
						
						$saved = $data->saveAs($filepath);
						if ($img->id != null && $saved)
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
						Image::model()->deleteByPk($old_img_id);
						
						// If the deleted image was the default image, delete the default image selection from the form:
						if ($_POST['Product']['defaultImage'] == $old_img_id)
						{
							$_POST['Product']['defaultImage'] = '';
						}
						
						// Delete the file, suppressing the warning if the file does not exist.
						$filepath = realpath(Yii::getPathOfAlias('webroot').'/images/product-images').'/'.$old_image->url;
						@unlink($filepath);
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
	
	
	
	
	
	
	
	
	// Used to generate XML specific for Google's product feed
	public function actionGoogleProductFeed()
	{
		$products = Product::model()->with('images', 'p8Sizes')->findAll();
		header('Content-Type: text/xml');
		echo '<?xml version="1.0"?>';
		echo '<feed xmlns="http://www.w3.org/2005/Atom" xmlns:g="http://base.google.com/ns/1.0" xmlns:c="http://base.google.com/cns/1.0">';
	
		echo '<id>tag:piecesofeightcostumes.com,2012-04-21:/product/googleProductFeed</id>';
		echo '<title>Pieces of Eight Costumes Product Listings</title>';
		echo '<link href="http://piecesofeightcostumes.com" rel="alternate" type="text/html" />';
		//echo '<updated>2012-04-21T02:46:00Z</updated>';
		echo '<updated>'.date('Y-m-d\TH:i:s\Z').'</updated>';
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
					echo '<description>[Custom Made to Order] '.strip_tags($product->description).'</description>';
					echo '<g:google_product_category>Apparel &amp; Accessories &gt; Costumes &amp; Accessories &gt; Costumes</g:google_product_category>';
					echo '<g:product_type>'.ucfirst($product->category).'</g:product_type>';
					echo '<link>'. $product->getUrl(true).'</link>';
					
					// List the pictures
					$baseImgUrl = Yii::app()->request->hostInfo.Yii::app()->request->baseUrl.'/images/product-images/';
					$defaultImage = $product->getDefaultImage();
					echo '<g:image_link>'.$baseImgUrl.$defaultImage->url.'</g:image_link>';
					$imgs = $product->getImages();
					foreach ($imgs as $img)
					{
						if ($img->id != $defaultImage->id)
						{
							echo '<g:additional_image_link>'.$baseImgUrl.$img->url.'</g:additional_image_link>';
						}
					}
					echo '<g:condition>new</g:condition>';
					echo '<g:availability>available for order</g:availability>';
					echo '<g:price>'.$product->price.' USD</g:price>';
					// echo '<g:sale_price></g:sale_price>';
					echo '<g:brand>Pieces of Eight Costumes</g:brand>';
					
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
	
	
	
	
	
	
	
	
	// Used to generate XML specific for Google's product feed
	public function actionBingProductFeed()
	{
		$products = Product::model()->with('images', 'p8Sizes')->findAll();
		header('Content-Type: text/plain');
		
		echo "MPID\tTitle\tBrand\tProductURL\tPrice\tAvailability\tDescription\tImageURL\tShipping\tMerchantCategory\tBingCategory";
	
		// Generate each product:
		foreach ($products as $product)
		{
			echo "\n";
			echo "po8_".$product->id."\t";	// MPID
			echo $product->name."\t";		// Title
			echo "Pieces of Eight Costumes\t";	// Brand
			echo $product->getUrl(true) . "\t";	// ProductURL
			echo $product->price . "\t";		// Price
			echo "In Stock\t";			// Availability
			echo "[Custom Made to Order] ".strip_tags($product->description)."\t";	// Description
			
			$baseImgUrl = Yii::app()->request->hostInfo.Yii::app()->request->baseUrl."/images/product-images/";
			$defaultImage = $product->getDefaultImage();
			echo $baseImgUrl . $defaultImage->url."\t";	// ImageURL
			
			echo "US::Ground:8.95\t";		// Shipping
			echo "Products > ".ucfirst($product->category)."\t";	// MerchantCategory
			echo "Clothing & Accessories";	// BingCategory	
		}		
		exit();
	
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