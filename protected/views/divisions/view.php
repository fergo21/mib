<?php
/* @var $this DivisionsController */
/* @var $model Divisions */

$this->breadcrumbs=array(
	'Divisions'=>array('index'),
	$model->iddivision,
);

$this->menu=array(
	array('label'=>'List Divisions', 'url'=>array('index')),
	array('label'=>'Create Divisions', 'url'=>array('create')),
	array('label'=>'Update Divisions', 'url'=>array('update', 'id'=>$model->iddivision)),
	array('label'=>'Delete Divisions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->iddivision),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Divisions', 'url'=>array('admin')),
);
?>

<h1>View Divisions #<?php echo $model->iddivision; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'iddivision',
		'division',
	),
)); ?>
