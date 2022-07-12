<?php
/* @var $this TutoresController */
/* @var $model Tutores */

$this->breadcrumbs=array(
	'Tutores'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tutores', 'url'=>array('index')),
	array('label'=>'Manage Tutores', 'url'=>array('admin')),
);

?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>