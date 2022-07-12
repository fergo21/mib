<?php
/* @var $this YearsController */
/* @var $model Years */

$this->breadcrumbs=array(
	'Years'=>array('index'),
	$model->idyears,
);

$this->menu=array(
	array('label'=>'List Years', 'url'=>array('index')),
	array('label'=>'Create Years', 'url'=>array('create')),
	array('label'=>'Update Years', 'url'=>array('update', 'id'=>$model->idyears)),
	array('label'=>'Delete Years', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idyears),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Years', 'url'=>array('admin')),
);
?>

<h1>View Years #<?php echo $model->idyears; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idyears',
		'year',
	),
)); ?>
