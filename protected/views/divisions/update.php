<?php
/* @var $this DivisionsController */
/* @var $model Divisions */

$this->breadcrumbs=array(
	'Divisions'=>array('index'),
	$model->iddivision=>array('view','id'=>$model->iddivision),
	'Update',
);

$this->menu=array(
	array('label'=>'List Divisions', 'url'=>array('index')),
	array('label'=>'Create Divisions', 'url'=>array('create')),
	array('label'=>'View Divisions', 'url'=>array('view', 'id'=>$model->iddivision)),
	array('label'=>'Manage Divisions', 'url'=>array('admin')),
);
?>

<h1>Update Divisions <?php echo $model->iddivision; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>