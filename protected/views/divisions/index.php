<?php
/* @var $this DivisionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Divisions',
);

$this->menu=array(
	array('label'=>'Create Divisions', 'url'=>array('create')),
	array('label'=>'Manage Divisions', 'url'=>array('admin')),
);
?>

<h1>Divisions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
