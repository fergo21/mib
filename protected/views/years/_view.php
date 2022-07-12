<?php
/* @var $this YearsController */
/* @var $data Years */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idyears')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idyears), array('view', 'id'=>$data->idyears)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />


</div>