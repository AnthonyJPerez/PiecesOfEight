<?php


$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Product::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Product::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(Product::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 