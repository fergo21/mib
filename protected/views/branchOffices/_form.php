<?php
/* @var $this BranchOfficesController */
/* @var $model BranchOffices */
/* @var $form CActiveForm */
$prompt = array('0' => 'Seleccionar');
$listP = CHtml::listData(Provinces::model()->findAll(), 'idprovince', 'name');
$listP = $prompt + $listP;
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'branch-offices-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text text-color--white"><?= $model->isNewRecord ? 'Crear sucursal':'Modificar sucursal'?></h5>
        </div>
        <div class="mdl-card__supporting-text">
            <form class="form form--basic">
                <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
                <div class="mdl-grid">
                	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
							<?php echo $form->labelEx($model,'office', array('class'=>'mdl-textfield__label')); ?>
							<?php echo $form->textField($model,'office',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
							<?php echo $form->error($model,'office'); ?>
						</div>

						<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
                			<?php echo $form->labelEx($model,'idprovinces', array('class'=>'mdl-selectfield__label ')); ?>
							<?php echo $form->dropDownList($model, 'idprovinces', $listP, array('class'=>'mdl-selectfield__select select2')); ?>
							<?php echo $form->error($model,'idprovinces'); ?>
                		</div>
                	</div>
                </div>
				<div class="row buttons">
					<?php echo CHtml::link('Cancelar', Yii::app()->baseUrl.'/branchoffices', array('class'=>'btn btn-default buttonAction')); ?>
					<?php echo CHtml::submitButton('Guardar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange')); ?>
				</div>
			</form>
		</div>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->