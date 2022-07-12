<?php
/* @var $this StudentsController */
/* @var $model Students */

$this->breadcrumbs=array(
	'Students'=>array('index'),
	$model->name=>array('view','id'=>$model->idstudents),
	'Update',
);

$this->menu=array(
	array('label'=>'List Students', 'url'=>array('index')),
	array('label'=>'Create Students', 'url'=>array('create')),
	array('label'=>'View Students', 'url'=>array('view', 'id'=>$model->idstudents)),
	array('label'=>'Manage Students', 'url'=>array('admin')),
);
?>

<div class="mdl-grid mdl-grid--no-spacing">
	<?php $this->renderPartial('_form', array('model'=>$model, 'model_tutor' => $model_tutor)); ?>
</div>