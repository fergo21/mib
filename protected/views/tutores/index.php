<?php
/* @var $this TutoresController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tutores',
);

$this->menu=array(
	array('label'=>'Create Tutores', 'url'=>array('create')),
	array('label'=>'Manage Tutores', 'url'=>array('admin')),
);
?>

<h1>Tutores</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
