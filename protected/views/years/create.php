<?php
/* @var $this YearsController */
/* @var $model Years */

$this->breadcrumbs=array(
	'Years'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Years', 'url'=>array('index')),
	array('label'=>'Manage Years', 'url'=>array('admin')),
);
?>

<h1>Create Years</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>