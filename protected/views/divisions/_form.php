<?php
/* @var $this DivisionsController */
/* @var $model Divisions */
/* @var $formDivision CActiveForm */
?>

<?php $formDivision=$this->beginWidget('CActiveForm', array(
	'id'=>'divisions-form',
	'action'=>Yii::app()->baseUrl.'/divisions/create',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h5 class="mdl-card__title-text text-color--white title-promo"><?= $model->isNewRecord ? 'Crear división':'Modificar división'?></h5>
            </div>
            <div class="mdl-card__supporting-text">
                <form class="form form--basic">
                <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
                    <div class="mdl-grid">
                    	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
                    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
								<?php echo $formDivision->labelEx($model,'division', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $formDivision->textField($model,'division',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $formDivision->error($model,'division'); ?>
							</div>
						</div>
					</div>
					<div class="row buttons">
						<?php echo CHtml::link('Cancelar', '#', array('class'=>'btn btn-default buttonAction close-division')); ?>
						<?php echo CHtml::submitButton('Guardar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange')); ?>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>
