<?php
/* @var $this BranchOfficesController */
/* @var $model BranchOffices */

$this->breadcrumbs=array(
	'Branch Offices'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BranchOffices', 'url'=>array('index')),
	array('label'=>'Manage BranchOffices', 'url'=>array('admin')),
);
?>


<div class="mdl-grid mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-cell--top">
	<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>