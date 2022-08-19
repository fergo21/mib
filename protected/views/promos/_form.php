<?php
/* @var $this PromosController */
/* @var $model Promos */
/* @var $form CActiveForm */
$prompt = array('0'=>'Seleccionar');

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
	'id'=>'promos-form',
	// 'action'=>Yii::app()->createUrl('/promos/create'),
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h5 class="mdl-card__title-text text-color--white title-promo"><?= $model->isNewRecord ? 'Crear promo':'Modificar promo'?></h5>
            </div>
            <div class="mdl-card__supporting-text">
                <form class="form form--basic">
                <p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
                    <div class="mdl-grid">
                    	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
							<?php echo $form->hiddenField($model,'idschools',array('class'=>'mdl-textfield__input')); ?>
							<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
                    			<?php echo $form->labelEx($model,'year_promo', array('class'=>'mdl-selectfield__label ')); ?>
								<?php echo $form->dropDownList($model, 'year_promo', $listGY, array('class'=>'mdl-selectfield__select select2')); ?>
								<?php echo $form->error($model,'year_promo'); ?>
                    		</div>

                    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
                    			<?php echo $form->labelEx($model,'tel_manager', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'tel_manager',array('class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'tel_manager'); ?>
                    		</div>

                    		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
                    			<?php echo $form->labelEx($model,'name_manager', array('class'=>'mdl-textfield__label')); ?>
								<?php echo $form->textField($model,'name_manager',array('class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'name_manager'); ?>
                    		</div>

                    		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
                    			<?php echo $form->labelEx($model,'idyears', array('class'=>'mdl-selectfield__label ')); ?>
								<?php echo $form->dropDownList($model, 'idyears', $listYC, array('class'=>'mdl-selectfield__select select2')); ?>
								<?php echo $form->error($model,'idyears'); ?>
                    		</div>
                    		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
                    			<?php echo $form->labelEx($model,'iddivision', array('class'=>'mdl-selectfield__label ')); ?>
								<?php echo $form->dropDownList($model, 'iddivision', $listDC, array('class'=>'mdl-selectfield__select select2')); ?>
								<?php echo $form->error($model,'iddivision'); ?>
                    		</div>
                    		<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
                    			<?php echo $form->labelEx($model,'idshifts', array('class'=>'mdl-selectfield__label ')); ?>
								<?php echo $form->dropDownList($model, 'idshifts', $listTC, array('class'=>'mdl-selectfield__select select2')); ?>
								<?php echo $form->error($model,'idshifts'); ?>
                    		</div>
						</div>
						<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
							<div class="mdl-list__item">
								<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect checkbox--colored-green">
								<?php echo $form->checkBox($model, 'price_old',array('value' => '1', 'uncheckValue'=>'0', 'class'=>'mdl-checkbox__input')); ?>
									<span class="mdl-checkbox__label">Mantener precio</span>
								</label>
								<?php echo $form->error($model,'price_old'); ?>
                    		</div>
							<div class="mdl-cell--12-col input-group">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
									<?php echo $form->labelEx($model,'date_contract', array('class'=>'mdl-textfield__label')); ?>
									
									<?php
										$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'model' => $model,
											'attribute' => 'date_contract',
											'language' => 'es',
											'options' => array(
												'showAnim' => 'fold',
												// 'minDate' => '0',
												'showButtonPanel' => false,
												'changeMonth' => true,
												'changeYear' => true,
												'constrainInput' => false,
												'dateFormat' => 'dd/mm/yy',
												'monthNames' => array('Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre'),
												'monthNamesShort' => array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
												'dayNames' => array('Domingo,Lunes,Martes,Miercoles,Jueves,Viernes,Sabado'),
												'dayNamesMin' => array('Do','Lu','Ma','Mi','Ju','Vi','Sa'),
												'beforeShow' => 'js:function(){
										          		// var selectedDate=$("#'.CHtml::activeId($model,'date_contract').'").datepicker("getDate");
										          		// $(this).datepicker("option","maxDate",selectedDate);
									      			}'
												),
											'htmlOptions' => array(
												'style' => 'height:20px;',
												'class' => 'mdl-textfield__input',
												'placeholder' => '',
												'autocomplete' => 'off',
												'value' => $model->date_contract ? Utils::format_date($model->date_contract, 'es') : ''
											),
									   ));
									?>
									<?php echo $form->error($model,'date_contract'); ?>
								</div>
								<i class="material-icons pull-right">event</i>
							</div>
							<div class="mdl-cell--12-col input-group">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
									<?php echo $form->labelEx($model,'date_delivery', array('class'=>'mdl-textfield__label')); ?>
									
									<?php
										$this->widget('zii.widgets.jui.CJuiDatePicker',array(
											'model' => $model,
											'attribute' => 'date_delivery',
											'language' => 'es',
											'options' => array(
												'showAnim' => 'fold',
												'minDate' => '+1',
												'showButtonPanel' => false,
												'changeMonth' => true,
												'changeYear' => true,
												'constrainInput' => false,
												'dateFormat' => 'dd/mm/yy',
												'monthNames' => array('Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre'),
												'monthNamesShort' => array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"),
												'dayNames' => array('Domingo,Lunes,Martes,Miercoles,Jueves,Viernes,Sabado'),
												'dayNamesMin' => array('Do','Lu','Ma','Mi','Ju','Vi','Sa'),
												'beforeShow' => 'js:function(){
										          		// var selectedDate=$("#'.CHtml::activeId($model,'date_delivery').'").datepicker("getDate");
										          		// $(this).datepicker("option","maxDate",selectedDate);
									      			}'
												),
											'htmlOptions' => array(
												'style' => 'height:20px;',
												'class' => 'mdl-textfield__input',
												'placeholder' => '',
												'autocomplete' => 'off',
												'value' => $model->date_delivery ? Utils::format_date($model->date_delivery, 'es') : ''
											),
									   ));
									?>
									<?php echo $form->error($model,'date_delivery'); ?>
								</div>
								<i class="material-icons pull-right">event</i>
							</div>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
								<?php echo $form->labelEx($model,'image_promo', array('class'=>'mdl-textfield__label')); ?>
								<?php echo  CHtml::activeFileField($model,'image_promo',array('class'=>'mdl-textfield__input')); ?>
								<?php echo $form->error($model,'image_promo'); ?>
							</div>
							<div class="image-promo">
								<img src="" class="mib-order-img" id="data-image_promo"/>
							</div>
						</div>
					</div>
					<div class="row buttons">
						<?php echo CHtml::link('Cancelar', '#', array('class'=>'btn btn-default buttonAction close')); ?>
						<?php echo CHtml::submitButton('Guardar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange')); ?>
					</div>
                </form>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>