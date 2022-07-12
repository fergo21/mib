<?php
/* @var $this OrdersController */
/* @var $data Orders */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idorders')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idorders), array('view', 'id'=>$data->idorders)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_delivery')); ?>:</b>
	<?php echo CHtml::encode($data->date_delivery); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_amount')); ?>:</b>
	<?php echo CHtml::encode($data->total_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dues')); ?>:</b>
	<?php echo CHtml::encode($data->dues); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idstudents')); ?>:</b>
	<?php echo CHtml::encode($data->idstudents); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idusers')); ?>:</b>
	<?php echo CHtml::encode($data->idusers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcombo_products')); ?>:</b>
	<?php echo CHtml::encode($data->idcombo_products); ?>
	<br />

	*/ ?>

</div>