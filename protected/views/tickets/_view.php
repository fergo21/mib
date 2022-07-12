<?php
/* @var $this TicketsController */
/* @var $data Tickets */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idtickets')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idtickets), array('view', 'id'=>$data->idtickets)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idorders')); ?>:</b>
	<?php echo CHtml::encode($data->idorders); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iddetails')); ?>:</b>
	<?php echo CHtml::encode($data->iddetails); ?>
	<br />


</div>