<?php
/* @var $this TicketsController */
/* @var $model Tickets */
/* @var $form CActiveForm */
$listFormOfPayment = array('CE' => 'Efectivo', 'CT' =>'Transferencia', 'CC'=>'Tarjeta de crédito', 'DC' => 'Tarjeta de débito');

$listOrders = array();
array_unshift($listOrders, 'Seleccionar');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tickets-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text text-color--white"><?= $model->isNewRecord ? 'Crear Factura':'Modificar Factura'?></h5>
        </div>
        <div class="mdl-card__supporting-text">
            <form class="form form--basic">
            	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
                <div class="mdl-grid">
                	<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--6-col-phone form__article">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
							<?php echo $form->labelEx($model,'code', array('class'=>'mdl-textfield__label ')); ?>
							<?php echo $form->textField($model,'code', array('class'=>'mdl-textfield__input')); ?>
							<?php echo $form->error($model,'code'); ?>
						</div>
						<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
							<?php echo $form->labelEx($model,'idorders', array('class'=>'mdl-selectfield__label')); ?>
							<?php echo $form->dropDownList($model,'idorders', $listOrders, array('class'=>'mdl-selectfield__select select-orders select2')); ?>
							<?php echo $form->error($model,'idorders'); ?>
						</div>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size" style="display:none;">
							<?php // echo $form->labelEx($model,'dues', array('class'=>'mdl-textfield__label ')); ?>
							<?php echo $form->hiddenField($model,'dues', array('class'=>'mdl-textfield__input')); ?>
							<?php // echo $form->error($model,'dues'); ?>
						</div>
					</div>
					<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--6-col-phone form__article">
						<div class="mdl-cell--12-col input-group">
	                		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
								<?php echo $form->labelEx($model,'date', array('class'=>'mdl-textfield__label')); ?>
								<!-- <?php echo $form->dateField($model,'date', array('class'=>'mdl-textfield__input', 'value'=>date('Y-m-d'))); ?> -->

								<?php
									$this->widget('zii.widgets.jui.CJuiDatePicker',array(
										'model' => $model,
										'attribute' => 'date',
										'language' => 'es',
										'options' => array(
											'showAnim' => 'fold',
											'minDate' => '0',
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
									          		// var selectedDate=$("#'.CHtml::activeId($model,'date').'").datepicker("getDate");
									          		// $(this).datepicker("option","maxDate",selectedDate);
								      			}'
											),
										'htmlOptions' => array(
											'style' => 'height:20px;',
											'class' => 'mdl-textfield__input',
											'placeholder'=> '',
											'value' => date('d/m/Y')
										),
								   ));
								?>
								<?php echo $form->error($model,'date'); ?>
							</div>
							<i class="material-icons pull-right">event</i>
						</div>

						<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
							<?php echo $form->labelEx($model,'form_payment', array('class'=>'mdl-selectfield__label')); ?>
							<?php echo $form->dropDownList($model,'form_payment', $listFormOfPayment, array('class'=>'mdl-selectfield__select select2')); ?>
							<?php echo $form->error($model,'form_payment'); ?>
						</div>
					</div>
					<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
						<h6 class="text-color--gray">Detalle de la compra</h6>
						<div style="overflow: auto;">
							<table class="mdl-data-table mdl-js-data-table table-products-selected" style="width:100%">
		                        <thead>
		                            <tr>
		                                <th class="mdl-data-table__cell--non-numeric">Producto</th>
		                                <th class="mdl-data-table__cell--non-numeric">Cantidad</th>
		                                <th class="mdl-data-table__cell--non-numeric">Talle</th>
		                                <th class="mdl-data-table__cell--non-numeric">Apodo</th>
		                                <th class="mdl-data-table__cell--non-numeric">Precio U.</th>
		                            </tr>
		                        </thead>
		                        <tbody id="mib-tbody">
		                        </tbody>
		                    </table>
						</div>
					</div>
					
					<div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone form__article">
						<div id="ticket_dues_paid" class="ui-components">
	                        <h6 class="text-color--gray">Seleccione la cuota</h6>
							<ul class="mdl-list" style="display:flex; justify-content: space-around; width: 100%;">
                        	</ul>
						</div>
					</div>
					<div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone form__article">
						<input type="hidden" value="" id="total_order">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
							<?php echo $form->labelEx($model,'amount', array('class'=>'mdl-textfield__label ')); ?>
							<?php echo $form->textField($model,'amount', array('class'=>'mdl-textfield__input')); ?>
							<?php echo $form->error($model,'amount'); ?>
							<span id="saldo_ticket"></span>
						</div>
						<hr>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
							<?php echo $form->labelEx($model,'paid', array('class'=>'mdl-textfield__label ')); ?>
							<?php echo $form->textField($model,'paid', array('class'=>'mdl-textfield__input')); ?>
							<?php echo $form->error($model,'paid'); ?>
						</div>
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size" style="display:none;">
							<?php //echo $form->labelEx($model,'saldo', array('class'=>'mdl-textfield__label ')); ?>
							<?php echo $form->hiddenField($model,'saldo', array('class'=>'mdl-textfield__input')); ?>
							<?php //echo $form->error($model,'saldo'); ?>
						</div>
						<div class="mib-box">
							<div class="mdl-card__supporting-text">
								<span id="vuelto_ticket" class="mib-vuelto"></span>
								<diV>
									<label class="mdl-switch mdl-js-switch mdl-js-ripple-effect switch--colored-green" for="save_saldo">
			                            <input type="checkbox" id="save_saldo" class="mdl-switch__input">
			                            <span class="mdl-switch__label">Guardar saldo</span>
			                        </label>
			                   	</diV>
							</div>
						</div>
					</div>
				</div>
				<div class="row buttons">
					<?php echo CHtml::link('Cancelar', Yii::app()->baseUrl.'/tickets', array('class'=>'btn btn-default buttonAction')); ?>
					<?php echo CHtml::submitButton('Guardar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange')); ?>
				</div>
			</form>
    	</div>
	</div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->