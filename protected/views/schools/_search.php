<?php
/* @var $this SchoolsController */
/* @var $model Schools */
/* @var $form CActiveForm */
$prompt = array('0' => 'Seleccionar');
$listP = CHtml::listData(Provinces::model()->findAll(), 'idprovince', 'name');
$listP = $prompt + $listP;
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

			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
					<?php echo $form->label($model,'name', array('class'=>'mdl-textfield__label')); ?>
					<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
				</div>
			</div>

			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
					<?php echo $form->label($model,'city', array('class'=>'mdl-textfield__label')); ?>
					<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>100, 'class'=>'mdl-textfield__input')); ?>
				</div>
			</div>

			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
                <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
                    <?php echo $form->labelEx($model,'idprovince', array('class'=>'mdl-selectfield__label ')); ?>
					<?php echo $form->dropDownList($model, 'idprovince', $listP, array('class'=>'mdl-selectfield__select select2')); ?>
				</div>
			</div>

			<div>
				<?php echo CHtml::submitButton('Buscar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange color-text--black pull-right')); ?>
			</div>

			<?php $this->endWidget(); ?>
		</div>
	</div>
</div><!-- search-form -->