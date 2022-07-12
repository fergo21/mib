<?php
/* @var $this DivisionsController */
/* @var $model Divisions */

$this->breadcrumbs=array(
	'Divisions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Divisions', 'url'=>array('index')),
	array('label'=>'Manage Divisions', 'url'=>array('admin')),
);
?>

<h1>Create Divisions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>