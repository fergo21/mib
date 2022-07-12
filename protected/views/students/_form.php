<?php
/* @var $this StudentsController */
/* @var $model Students */
/* @var $form CActiveForm */

$prompt = array('0'=>'Seleccionar');

$listS = CHtml::listData(Schools::model()->findAll(), 'idschools', 'name');
$listS = $prompt + $listS;

$listGY = array('0'=>'Seleccionar');
for($i = 0; $i<5; $i++){
	$listGY[date('Y', strtotime('+'.$i.' years'))] = date('Y', strtotime('+'.$i.' years'));
}


$listYC = CHtml::listData(Years::model()->findAll(), 'idyears', 'year');
$listYC = $prompt + $listYC;

$listDC = CHtml::listData(Divisions::model()->findAll(), 'iddivision', 'division');
$listDC = $prompt + $listDC;

$listTC = CHtml::listData(Shifts::model()->findAll(), 'idshifts', 'shift');
$listTC = $prompt + $listTC;

?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'students-form',
	'action'=>$model->isNewRecord ? Yii::app()->createUrl('/students/create') : Yii::app()->createUrl('/students/update/'.$model->idstudents),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div class="mdl-grid mdl-grid--no-spacing">
	<div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
		<?php $this->renderPartial('../tutores/_form', array('model'=>$model_tutor, 'form' => $form)); ?>
    </div>
	<div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">

		<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
	        <div class="mdl-card mdl-shadow--2dp">
	            <div class="mdl-card__title">
	                <h5 class="mdl-card__title-text text-color--white"><?= $model->isNewRecord ? 'Crear Estudiante':'Modificar Estudiante'?></h5>
	            </div>
	            <div class="mdl-card__supporting-text">
	                <!-- <form class="form form--basic"> -->
	                <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
	                    <div class="mdl-grid">
	                    	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
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
									<?php echo $form->labelEx($model,'ci', array('class'=>'mdl-textfield__label')); ?>
									<?php echo $form->textField($model,'ci',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
									<?php echo $form->error($model,'ci'); ?>
	                    		</div>
	                    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
	                    			<?php echo $form->labelEx($model,'email', array('class'=>'mdl-textfield__label')); ?>
									<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
									<?php echo $form->error($model,'email'); ?>
	                    		</div>
	                    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
	                    			<?php echo $form->labelEx($model,'phone', array('class'=>'mdl-textfield__label')); ?>
									<?php echo $form->textField($model,'phone',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
									<?php echo $form->error($model,'phone'); ?>
	                    		</div>
	                    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
	                    			<?php echo $form->labelEx($model,'address', array('class'=>'mdl-textfield__label')); ?>
									<?php echo $form->textField($model,'address',array('size'=>45,'maxlength'=>45, 'class'=>'mdl-textfield__input')); ?>
									<?php echo $form->error($model,'address'); ?>
	                    		</div>                    		
	                    	</div>
	                    	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
	                    		<h3 class="text-color--smooth-gray">Asociar a escuela</h3>
	                    		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size is-dirty">
	                    			<?php echo $form->labelEx($model,'idschools', array('class'=>'mdl-selectfield__label ')); ?>
									<?php echo $form->dropDownList($model, 'idschools', $listS, array('class'=>'mdl-selectfield__select select2')); ?>
									<?php echo $form->error($model,'idschools'); ?>
	                    		</div>
	                    		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
	                    			<?php echo $form->labelEx($model,'graduation_year', array('class'=>'mdl-selectfield__label ')); ?>
									<?php echo $form->dropDownList($model, 'graduation_year', $model->isNewRecord && !isset($_GET['id']) ? $prompt : $listGY, array('class'=>'mdl-selectfield__select select2')); ?>
									<?php echo $form->error($model,'graduation_year'); ?>
	                    		</div>
	                    		<h3 class="text-color--smooth-gray">Asociar a curso</h3>
	                    		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
	                    			<?php echo $form->labelEx($model,'idyears', array('class'=>'mdl-selectfield__label ')); ?>
									<?php echo $form->dropDownList($model, 'idyears', $model->isNewRecord && !isset($_GET['id']) ? $prompt : $listYC, array('class'=>'mdl-selectfield__select select2')); ?>
									<?php echo $form->error($model,'idyears'); ?>
	                    		</div>
	                    		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
	                    			<?php echo $form->labelEx($model,'iddivision', array('class'=>'mdl-selectfield__label ')); ?>
									<?php echo $form->dropDownList($model, 'iddivision', $model->isNewRecord && !isset($_GET['id']) ? $prompt : $listDC, array('class'=>'mdl-selectfield__select select2')); ?>
									<?php echo $form->error($model,'iddivision'); ?>
	                    		</div>
	                    		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
	                    			<?php echo $form->labelEx($model,'idshifts', array('class'=>'mdl-selectfield__label ')); ?>
									<?php echo $form->dropDownList($model, 'idshifts', $model->isNewRecord && !isset($_GET['id']) ? $prompt : $listTC, array('class'=>'mdl-selectfield__select select2')); ?>
									<?php echo $form->error($model,'idshifts'); ?>
	                    		</div>
	                    	</div>
	                    </div>
						<div class="row buttons">
							<?php echo CHtml::link('Cancelar', Yii::app()->baseUrl.'/students', array('class'=>'btn btn-default buttonAction')); ?>
							<?php echo CHtml::submitButton('Guardar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange')); ?>
						</div>
	                <!-- </form> -->
	            </div>
	        </div>
	    </div>
    </div>
</div><!-- form -->
<?php $this->endWidget(); ?>
