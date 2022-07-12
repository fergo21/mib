<?php
/* @var $this SchoolsController */
/* @var $model Schools */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	$model->name=>array('view','id'=>$model->idschools),
	'Update',
);

$this->menu=array(
	array('label'=>'List Schools', 'url'=>array('index')),
	array('label'=>'Create Schools', 'url'=>array('create')),
	array('label'=>'View Schools', 'url'=>array('view', 'id'=>$model->idschools)),
	array('label'=>'Manage Schools', 'url'=>array('admin')),
);
?>


<div class="mdl-grid mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">
	<?php $this->renderPartial('_form', array('model'=>$model, 'modelPromo' => $modelPromo, 'mpromo' => $mpromo)); ?>
</div>
