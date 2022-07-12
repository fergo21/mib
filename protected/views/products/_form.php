<?php
/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
  <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h5 class="mdl-card__title-text text-color--white"><?= $model->isNewRecord ? 'Crear Producto':'Modificar Producto'?></h5>
            </div>
            <div class="mdl-card__supporting-text">
                <form class="form form--basic">
                <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
                    <div class="mdl-grid">
                    	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
                    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
								<?php echo $form->labelEx($model,'name', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'name'); ?>
							</div>
						</div>
						<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
								<?php echo $form->labelEx($model,'price', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'price',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'price'); ?>
							</div>
						</div>
						<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
								<?php echo $form->labelEx($model,'description', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'description',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'description'); ?>
							</div>
						</div>
					</div>
					<div class="row buttons">
						<?php echo CHtml::link('Cancelar', Yii::app()->baseUrl.'/products', array('class'=>'btn btn-default buttonAction')); ?>
						<?php echo CHtml::submitButton('Guardar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange')); ?>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>
