<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name=>array('view','id'=>$model->idusers),
	'Update',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'View Users', 'url'=>array('view', 'id'=>$model->idusers)),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<main class="mdl-layout__content ui-form-components">
    <div class="mdl-grid mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</main>