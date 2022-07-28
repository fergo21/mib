<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
$prompt = array('' => 'Seleccionar');
$listS = CHtml::listData(Schools::model()->findAll(), 'name', 'name');
$listS = $prompt + $listS;

$listYP = CHtml::listData(Promos::model()->findAll(), 'year_promo', 'year_promo');
$listYP = $prompt + $listYP;

$listY = CHtml::listData(Years::model()->findAll(), 'year', 'year');
$listY = $prompt + $listY;

$listD = CHtml::listData(Divisions::model()->findAll(), 'division', 'division');
$listD = $prompt + $listD;

$listST = CHtml::listData(Shifts::model()->findAll(), 'shift', 'shift');
$listST = $prompt + $listST;
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

			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
				<?php echo $form->label($modelSchool,'name', array('class'=>'mdl-selectfield__label ')); ?>
				<?php echo $form->dropDownList($modelSchool,'name', $listS, array('class'=>'mdl-selectfield__select select2')); ?>
			</div>
			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
				<?php echo $form->label($modelPromo,'year_promo', array('class'=>'mdl-selectfield__label ')); ?>
				<?php echo $form->dropDownList($modelPromo,'year_promo', $listYP, array('class'=>'mdl-selectfield__select select2')); ?>
			</div>
			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
				<?php echo $form->label($modelYear,'year', array('class'=>'mdl-selectfield__label ')); ?>
				<?php echo $form->dropDownList($modelYear,'year', $listY, array('class'=>'mdl-selectfield__select select2')); ?>
			</div>
			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
				<?php echo $form->label($modelDivision,'division', array('class'=>'mdl-selectfield__label ')); ?>
				<?php echo $form->dropDownList($modelDivision,'division', $listD, array('class'=>'mdl-selectfield__select select2')); ?>
			</div>
			<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
				<?php echo $form->label($modelShift,'shift', array('class'=>'mdl-selectfield__label')); ?>
				<?php echo $form->dropDownList($modelShift,'shift',$listST, array('maxlength'=>45,'class'=>'mdl-selectfield__select select2')); ?>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				<?php echo $form->label($model,'idstudents', array('class'=>'mdl-textfield__label ')); ?>
				<?php echo $form->textField($model,'idstudents',array('class'=>'mdl-textfield__input')); ?>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				<?php echo $form->labelEx($model,'status', array('class'=>'mdl-textfield__label ')); ?>
				<?php echo $form->textField($model,'status',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				<?php echo $form->labelEx($model,'date', array('class'=>'mdl-textfield__label ')); ?>
				<?php echo $form->textField($model,'date',array('class'=>'mdl-textfield__input')); ?>
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
				<?php echo $form->labelEx($model,'date_delivery', array('class'=>'mdl-textfield__label ')); ?>
				<?php echo $form->textField($model,'date_delivery',array('class'=>'mdl-textfield__input')); ?>
			</div>
			<div>
				<?php echo CHtml::link('Limpiar', '#', array('class'=>'mdl-button color-text--orange btn btn-default actionClear')); ?>
				<?php echo CHtml::submitButton('Buscar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange color-text--black pull-right')); ?>
			</div>

			<?php $this->endWidget(); ?>
		</div>
	</div>
</div><!-- search-form -->