<?php
/* @var $this StudentsController */
/* @var $data Students */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idstudents')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idstudents), array('view', 'id'=>$data->idstudents)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('surname')); ?>:</b>
	<?php echo CHtml::encode($data->surname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idschool_courses')); ?>:</b>
	<?php echo CHtml::encode($data->idschool_courses); ?>
	<br />


</div>