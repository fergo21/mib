<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	
	
	<?php echo $form->errorSummary($model); ?>


	<div class="mdl-cell mdl-cell--7-col-desktop mdl-cell--7-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h5 class="mdl-card__title-text text-color--white"><?= $model->isNewRecord ? 'Crear Usuario':'Modificar Usuario'?></h5>
            </div>
            <div class="mdl-card__supporting-text">
                <form class="form form--basic">
                <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone form__article">
                            <h3 class="text-color--smooth-gray">Info Ingreso</h3>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
                            	<?php echo $form->labelEx($model,'user', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'user',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'user'); ?>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
                                <?php echo $form->labelEx($model,'password', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->passwordField($model,'password',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'password'); ?>
                            </div>
                        </div>
                        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone form__article">
                            <h3 class="text-color--smooth-gray">Info Usuario</h3>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
                                <?php echo $form->labelEx($model,'name', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'name'); ?>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
                                <?php echo $form->labelEx($model,'surname', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'surname',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'surname'); ?>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
                                <?php echo $form->labelEx($model,'roles_idroles', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'roles_idroles', array('class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'roles_idroles'); ?>
                            </div>
                        </div>
                    </div>
					<div class="row buttons">
                        <?php echo CHtml::link('Cancelar', Yii::app()->baseUrl.'/users/admin', array('class'=>'btn btn-default buttonAction')); ?>
						<?php echo CHtml::submitButton('Guardar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange')); ?>
					</div>
                </form>
            </div>
        </div>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->