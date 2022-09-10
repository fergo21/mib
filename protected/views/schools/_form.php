<?php
/* @var $this SchoolsController */
/* @var $model Schools */
/* @var $form CActiveForm */
$prompt = array('0' => 'Seleccionar');
$listP = CHtml::listData(Provinces::model()->findAll(), 'idprovince', 'name');
$listP = $prompt + $listP;

$setting = Utils::readJson('settings');

$listED = array($setting['expiration_day'] => $setting['expiration_day'], $setting['expiration_day_2'] => $setting['expiration_day_2']);

?>

<div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'schools-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>	

	<!-- <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone"> -->
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h5 class="mdl-card__title-text text-color--white"><?= $model->isNewRecord ? 'Crear Escuela':'Modificar Escuela'?></h5>
            </div>
            <div class="mdl-card__supporting-text">
                <form class="form form--basic">
                <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
                    <div class="mdl-grid">
                    	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
                    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
                    			<?php echo $form->labelEx($model,'name', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'name'); ?>
                    		</div>
                    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
                    			<?php echo $form->labelEx($model,'city', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>100, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'city'); ?>
                    		</div>
                    		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
                    			<?php echo $form->labelEx($model,'idprovince', array('class'=>'mdl-selectfield__label ')); ?>
								<?php echo $form->dropDownList($model, 'idprovince', $listP, array('class'=>'mdl-selectfield__select select2')); ?>
								<?php echo $form->error($model,'idprovince'); ?>
                    		</div>
                    		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
                    			<?php echo $form->labelEx($model,'expiration_day', array('class'=>'mdl-selectfield__label ')); ?>
								<?php echo $form->dropDownList($model, 'expiration_day', $listED, array('class'=>'mdl-selectfield__select select2')); ?>
								<?php echo $form->error($model,'expiration_day'); ?>
                    		</div>
                    	</div>
                    </div>
					<div class="row buttons">
						<?php echo CHtml::link('Cancelar', Yii::app()->baseUrl.'/schools', array('class'=>'btn btn-default buttonAction')); ?>
						<?php echo CHtml::submitButton('Guardar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange')); ?>
					</div>
                </form>
            </div>
        </div>
   <!--  </div> -->
<?php $this->endWidget(); ?>

</div>
<?php if(!$model->isNewRecord) { ?>
	<div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
		<?php $this->renderPartial('../promos/admin', array('modelPromo'=>$modelPromo)); ?>
	</div>
	<div class="mib-background-modal"></div>
	<div class="mdl-dialog">
		<div class="mdl-dialog__content">
			<?php $this->renderPartial('../promos/_form', array('model'=>$mpromo)); ?>
		</div>
	</div>
	<?php $this->renderPartial('../students/_formMassive');  ?>
<?php } ?>
<!-- form -->