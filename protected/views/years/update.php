<?php
/* @var $this YearsController */
/* @var $model Years */

$this->breadcrumbs=array(
	'Years'=>array('index'),
	$model->idyears=>array('view','id'=>$model->idyears),
	'Update',
);

$this->menu=array(
	array('label'=>'List Years', 'url'=>array('index')),
	array('label'=>'Create Years', 'url'=>array('create')),
	array('label'=>'View Years', 'url'=>array('view', 'id'=>$model->idyears)),
	array('label'=>'Manage Years', 'url'=>array('admin')),
);
?>

<h1>Update Years <?php echo $model->idyears; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>