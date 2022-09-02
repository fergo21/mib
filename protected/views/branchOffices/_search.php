<?php
/* @var $this BranchOfficesController */
/* @var $model BranchOffices */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idbranch_offices'); ?>
		<?php echo $form->textField($model,'idbranch_offices'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office'); ?>
		<?php echo $form->textField($model,'office',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idprovinces'); ?>
		<?php echo $form->textField($model,'idprovinces'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->