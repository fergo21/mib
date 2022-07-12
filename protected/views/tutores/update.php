<?php
/* @var $this TutoresController */
/* @var $model Tutores */

$this->breadcrumbs=array(
	'Tutores'=>array('index'),
	$model->name=>array('view','id'=>$model->idtutores),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tutores', 'url'=>array('index')),
	array('label'=>'Create Tutores', 'url'=>array('create')),
	array('label'=>'View Tutores', 'url'=>array('view', 'id'=>$model->idtutores)),
	array('label'=>'Manage Tutores', 'url'=>array('admin')),
);
?>

<h1>Update Tutores <?php echo $model->idtutores; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>