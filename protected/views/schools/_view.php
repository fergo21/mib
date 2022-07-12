<?php
/* @var $this SchoolsController */
/* @var $data Schools */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idschools')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idschools), array('view', 'id'=>$data->idschools)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />


</div>