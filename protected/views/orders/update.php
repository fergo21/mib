<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->idorders=>array('view','id'=>$model->idorders),
	'Update',
);

$this->menu=array(
	array('label'=>'List Orders', 'url'=>array('index')),
	array('label'=>'Create Orders', 'url'=>array('create')),
	array('label'=>'View Orders', 'url'=>array('view', 'id'=>$model->idorders)),
	array('label'=>'Manage Orders', 'url'=>array('admin')),
);
?>

<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-cell--top">
	<?php $this->renderPartial('_form', array('model'=>$model, 'isPresupuesto' => $isPresupuesto)); ?>
</div>