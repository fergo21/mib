<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text text-color--white">Buscar por:</h5>
        </div>
        <div class="mdl-card__supporting-text overflow-y--hidden">
        	<?php $form=$this->beginWidget('CActiveForm', array(
				'action'=>Yii::app()->createUrl($this->route),
				'method'=>'get',
			)); ?>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				<?php echo $form->labelEx($model,'idorders', array('class'=>'mdl-textfield__label ')); ?>
				<?php echo $form->textField($model,'idorders',array('class'=>'mdl-textfield__input')); ?>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				<?php echo $form->labelEx($model,'date', array('class'=>'mdl-textfield__label ')); ?>
				<?php echo $form->textField($model,'date',array('class'=>'mdl-textfield__input')); ?>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				<?php echo $form->labelEx($model,'date_delivery', array('class'=>'mdl-textfield__label ')); ?>
				<?php echo $form->textField($model,'date_delivery',array('class'=>'mdl-textfield__input')); ?>
			</div>

			<!-- <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				<?php echo $form->labelEx($model,'total_amount', array('class'=>'mdl-textfield__label ')); ?>
				<?php echo $form->textField($model,'total_amount',array('size'=>10,'maxlength'=>10, 'class'=>'mdl-textfield__input')); ?>
			</div> -->

<!-- 			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				<?php echo $form->labelEx($model,'dues', array('class'=>'mdl-textfield__label ')); ?>
				<?php echo $form->textField($model,'dues',array('class'=>'mdl-textfield__input')); ?>
			</div> -->

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				<?php echo $form->labelEx($model,'status', array('class'=>'mdl-textfield__label ')); ?>
				<?php echo $form->textField($model,'status',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				<?php echo $form->label($model,'idstudents', array('class'=>'mdl-textfield__label ')); ?>
				<?php echo $form->textField($model,'idstudents',array('class'=>'mdl-textfield__input')); ?>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				<?php echo $form->label($modelSchool,'idschools', array('class'=>'mdl-textfield__label ')); ?>
				<?php echo $form->textField($modelSchool,'idschools',array('class'=>'mdl-textfield__input')); ?>
			</div>

			<div>
				<?php echo CHtml::submitButton('Buscar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange color-text--black pull-right')); ?>
			</div>

			<?php $this->endWidget(); ?>
		</div>
	</div>
</div><!-- search-form -->