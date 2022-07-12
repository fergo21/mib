<?php
/* @var $this SchoolsController */
/* @var $model Schools */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Schools', 'url'=>array('index')),
	array('label'=>'Create Schools', 'url'=>array('create')),
	array('label'=>'Update Schools', 'url'=>array('update', 'id'=>$model->idschools)),
	array('label'=>'Delete Schools', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idschools),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Schools', 'url'=>array('admin')),
);
?>

<h1>View Schools #<?php echo $model->idschools; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idschools',
		'name',
		'city',
	),
)); ?>
