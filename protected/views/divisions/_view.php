<?php
/* @var $this DivisionsController */
/* @var $data Divisions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('iddivision')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->iddivision), array('view', 'id'=>$data->iddivision)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('division')); ?>:</b>
	<?php echo CHtml::encode($data->division); ?>
	<br />


</div>