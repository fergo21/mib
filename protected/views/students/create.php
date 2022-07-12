<?php
/* @var $this StudentsController */
/* @var $model Students */

$this->breadcrumbs=array(
	'Students'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Students', 'url'=>array('index')),
	array('label'=>'Manage Students', 'url'=>array('admin')),
);
?>

<div class="mdl-grid mdl-grid--no-spacing">
	<?php $this->renderPartial('_form', array('model'=>$model, 'model_tutor' => $model_tutor)); ?>
</div>