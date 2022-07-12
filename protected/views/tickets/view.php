<?php
/* @var $this TicketsController */
/* @var $model Tickets */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	$model->idtickets,
);

$this->menu=array(
	array('label'=>'List Tickets', 'url'=>array('index')),
	array('label'=>'Create Tickets', 'url'=>array('create')),
	array('label'=>'Update Tickets', 'url'=>array('update', 'id'=>$model->idtickets)),
	array('label'=>'Delete Tickets', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idtickets),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tickets', 'url'=>array('admin')),
);
?>

<h1>View Tickets #<?php echo $model->idtickets; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idtickets',
		'code',
		'date',
		'idorders',
		'iddetails',
	),
)); ?>
