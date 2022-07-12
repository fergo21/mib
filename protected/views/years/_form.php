<?php
/* @var $this YearsController */
/* @var $model Years */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'years-form',
	'action'=>Yii::app()->baseUrl.'/years/create',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h5 class="mdl-card__title-text text-color--white title-promo"><?= $model->isNewRecord ? 'Crear curso':'Modificar curso'?></h5>
            </div>
            <div class="mdl-card__supporting-text">
                <form class="form form--basic">
                <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
                    <div class="mdl-grid">
                    	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
                    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
								<?php echo $form->labelEx($model,'year', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'year',array('size'=>1,'maxlength'=>1, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'year'); ?>
							</div>
						</div>
					</div>
					<div class="row buttons">
						<?php echo CHtml::link('Cancelar', '#', array('class'=>'btn btn-default buttonAction close-year')); ?>
						<?php echo CHtml::submitButton('Guardar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange')); ?>
					</div>
				</form>
			</div>
		</div>
	</div>


<?php $this->endWidget(); ?>
