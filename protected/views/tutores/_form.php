<?php
/* @var $this TutoresController */
/* @var $model Tutores */
/* @var $form CActiveForm */
?>

	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h5 class="mdl-card__title-text text-color--white"><?= $model->isNewRecord ? 'Crear Tutor':'Modificar Tutor'?></h5>
            </div>
            <div class="mdl-card__supporting-text">
                <form class="form form--basic">
	                <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
	                <div class="mdl-grid">
	                	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
								<?php echo $form->labelEx($model,'ci', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'ci',array('size'=>8,'maxlength'=>8, 'class'=>'mdl-textfield__input validate_ci_tutor')); ?>
								<?php echo $form->error($model,'ci'); ?>
							</div>
						</div>
						<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
	                		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
								<?php echo $form->labelEx($model,'name', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'name'); ?>
							</div>
						</div>
						<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
								<?php echo $form->labelEx($model,'surname', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'surname',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'surname'); ?>
							</div>
						</div>
						<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
								<?php echo $form->labelEx($model,'phone', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'phone',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'phone'); ?>
							</div>
						</div>
						<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
								<?php echo $form->labelEx($model,'mail', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'mail',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'mail'); ?>
							</div>
	                	</div>
	                </div>
                </form>
            </div>
        </div>
    </div>
