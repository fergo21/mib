<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
$listDues = array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6');
array_unshift($listDues, 'Seleccionar');

$listStatus = array('Pedido'=>'Pedido', 'Proceso'=>'En proceso', 'Terminado'=>'Terminado', 'Garantia' => 'Garantía');
array_unshift($listStatus, 'Seleccionar');

$listStudents = array();
// $listStudents =  CHtml::listData(Students::model()->findAll(), 'idstudents', 'name');
array_unshift($listStudents, 'Seleccionar');

$listTallesArriba = array("4"=>"4", "6"=>"6", "8"=>"8", "10"=>"10", "12"=>"12", "14"=>"14", "16"=>"16", "xs"=>"XS", "s"=>"S", "m"=>"M", "l"=>"L", "xl"=>"XL", "xxl"=>"XXL", "xxxl"=>"XXXL", "especial"=>"Especial");
array_unshift($listTallesArriba, 'Seleccionar');

$listTallesAbajo = array("4"=>"4", "6"=>"6", "8"=>"8", "10"=>"10", "12"=>"12", "14"=>"14", "16"=>"16", "34"=>"34", "36"=>"36", "38"=>"38", "40"=>"40", "42"=>"42", "44"=>"44", "46"=>"46", "48"=>"48", "50"=>"50", "52"=>"52", "54"=>"54", "56"=>"56", "58"=>"58", "60"=>"60", "especial"=>"Especial");
array_unshift($listTallesAbajo, 'Seleccionar');

// var_dump($model->isNewRecord);
// var_dump($model->isNewRecord && $isPresupuesto);die;

if($model->isNewRecord && !$isPresupuesto){
	$title = 'Crear Pedido';
}else if($model->isNewRecord && $isPresupuesto){
	$title = 'Presupuesto';
}else{
	$title = 'Modificar Pedido';
}

?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orders-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div class="mdl-grid mdl-grid--no-spacing">
	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
		<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
		    <div class="mdl-card mdl-shadow--2dp">
		        <div class="mdl-card__title">
		            <h5 class="mdl-card__title-text text-color--white">
		            	<?= $title; ?>
		            </h5>
		        </div>
		        <div class="mdl-card__supporting-text">
		            <form class="form form--basic">
		            	<p class="note">Los campos con <span class="required">*</span> son requeridos.</p>
		                <div class="mdl-grid">
		                	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
									<?php if(!$isPresupuesto){ ?>
										<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
											<?php echo $form->labelEx($model,'idstudents', array('class'=>'mdl-selectfield__label ')); ?>
											<?php echo $form->dropDownList($model,'idstudents', $listStudents,array('class'=>'mdl-selectfield__select select-student select2', 'data-ci'=>!$model->isNewRecord || $model->idstudents ? Students::model()->find('idstudents=:idstudents', array(':idstudents'=>$model->idstudents))->idstudents : '')); ?>
											<?php echo $form->error($model,'idstudents'); ?>
										</div>
									<?php  }else{ ?>
										<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
											<input class="mdl-textfield__input" type="text" id="school-name" name="Orders[school-name]" value=""/>
	                                    	<label class="mdl-textfield__label" for="school-name">Escuela</label>
	                                    </div>
									<?php } ?>
								

		                		<div class="mdl-cell--12-col input-group">
			                		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
										<?php echo $form->labelEx($model,'date', array('class'=>'mdl-textfield__label')); ?>

										<?php
											$this->widget('zii.widgets.jui.CJuiDatePicker',array(
												'model' => $model,
												'attribute' => 'date',
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
											          		// var selectedDate=$("#'.CHtml::activeId($model,'date').'").datepicker("getDate");
											          		// $(this).datepicker("option","maxDate",selectedDate);
										      			}'
													),
												'htmlOptions' => array(
													'style' => 'height:20px;',
													'class' => 'mdl-textfield__input',
													'placeholder'=> '',
													'autocomplete' => 'off',
													'value' => $model->date ? Utils::format_date($model->date, 'es') : date('d/m/Y')
												),
										   ));
										?>
										<?php echo $form->error($model,'date'); ?>
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
													// 'minDate' => '+1',
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
									<?php echo $form->hiddenField($model,'size',array('rows'=>3, 'cols'=>50, 'class'=>'mdl-textfield__input')); ?>
									<?php echo $form->error($model,'size'); ?>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
									<?php echo $form->labelEx($model,'description', array('class'=>'mdl-textfield__label ')); ?>
									<?php echo $form->textArea($model,'description',array('rows'=>3, 'cols'=>50, 'class'=>'mdl-textfield__input')); ?>
									<?php echo $form->error($model,'description'); ?>
								</div>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
									<?php echo $form->labelEx($model,'extra_amount', array('class'=>'mdl-textfield__label ')); ?>
									<?php echo $form->textField($model,'extra_amount',array('size'=>10,'maxlength'=>10, 'class'=>'mdl-textfield__input')); ?>
									<?php echo $form->error($model,'extra_amount'); ?>
								</div>
								
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
									<?php echo $form->labelEx($model,'total_amount', array('class'=>'mdl-textfield__label ')); ?>
									<?php echo $form->textField($model,'total_amount',array('size'=>10,'maxlength'=>10, 'class'=>'mdl-textfield__input')); ?>
									<?php echo $form->error($model,'total_amount'); ?>
								</div>

								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
									<?php echo $form->labelEx($model,'percent', array('class'=>'mdl-textfield__label ')); ?>
									<?php echo $form->textField($model,'percent',array('size'=>10,'maxlength'=>10, 'class'=>'mdl-textfield__input')); ?>
									<?php echo $form->error($model,'percent'); ?>
								</div>

								<?php if(!$isPresupuesto){ ?>
								<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
									<?php echo $form->labelEx($model,'dues', array('class'=>'mdl-selectfield__label ')); ?>
									<?php echo $form->dropDownList($model,'dues', $listDues, array('class'=>'mdl-selectfield__select select2')); ?>
									<?php echo $form->error($model,'dues'); ?>
								</div>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
									<?php echo $form->labelEx($model,'advance_payment', array('class'=>'mdl-textfield__label ')); ?>
									<?php echo $form->textField($model,'advance_payment', array('class'=>'mdl-textfield__input')); ?>
									<?php echo $form->error($model,'advance_payment'); ?>
								</div>
								<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
									<?php echo $form->labelEx($model,'status', array('class'=>'mdl-selectfield__label ')); ?>
									<?php echo $form->dropDownList($model,'status', $listStatus, array('class'=>'mdl-selectfield__select')); ?>
									<?php echo $form->error($model,'status'); ?>
								</div>
								<?php } ?>

							</div>
						</div>
						<div class="row buttons">
							<?php echo CHtml::link('Cancelar', Yii::app()->baseUrl.'/tickets', array('class'=>'btn btn-default buttonAction'));?>
							<div>
								
								<?php if(!$isPresupuesto){
								    echo CHtml::submitButton('Guardar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange')); 
								}else{ ?> 
									<?php echo CHtml::submitButton('Imprimir', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange', 'id' => 'print-order')); ?>
								<?php } ?>
							</div>
						</div>
					</form>
		    	</div>
			</div>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
		<div class="mdl-grid ui-tables">
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
				<div class="mdl-card mdl-shadow--2dp">
					<div class="mdl-card__title mib-table--title">
			            <h5 class="mdl-card__title-text">Prods. Seleccionados</h5>
			            <div style="display: block; width: 153px; text-align: right;">
		                	<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect color-text--orange show-dialog"><i class="material-icons">add</i> producto</a>
			            	<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect checkbox--colored-green" for="Check_priceOld">
	                            <input type="checkbox" id="Check_priceOld" class="mdl-checkbox__input">
	                            <span class="mdl-checkbox__label">Precio anterior</span>
	                        </label>
		                </div>
			        </div>
			        <div class="mdl-card__supporting-text no-padding">
	                    <table class="mdl-data-table mdl-js-data-table table-products-selected">
	                        <thead>
	                            <tr>
	                                <th class="mdl-data-table__cell--non-numeric">Producto</th>
	                                <th class="mdl-data-table__cell--non-numeric">Cantidad</th>
	                                <th class="mdl-data-table__cell--non-numeric">Talle</th>
	                                <th class="mdl-data-table__cell--non-numeric">Apodo</th>
	                                <th class="mdl-data-table__cell--non-numeric">Precio U.</th>
	                                <th class="mdl-data-table__cell--non-numeric"></th>
	                            </tr>
	                        </thead>
	                        <tbody id="mib-tbody">
	                        </tbody>
	                    </table>
	                </div>
				</div>
			</div>
			<?php if(!$isPresupuesto){ ?>
				<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
					<div class="mdl-card mdl-shadow--2dp">
				        <div class="mdl-card__title">
				            <h5 class="mdl-card__title-text">Datos del estudiante</h5>
				        </div>
				        <div class="mib-grid mdl-card__supporting-text no-padding">
				            <div class="mdl-cell--6-col-desktop mdl-card__supporting-text">
				                <b>Escuela:</b> <span id="data-school"></span>
				                <br>
				                <b>Ciudad:</b> <span id="data-city"></span>
				                <br>
				                <b>Año:</b> <span  id="data-year"></span>
				                <br>
				                <b>División:</b> <span  id="data-division"></span>
				                <br>
				                <b>Turno:</b> <span  id="data-shift"></span>
				                <br>
				                <b>Promo:</b> <span  id="data-year_promo"></span>
				            </div>
				            <div class="mdl-cell--6-col-desktop mdl-card__supporting-text">
				                <img src="" class="mib-order-img" id="data-image_promo">
				            </div>
				        </div>
				    </div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>

<div class="mib-background-modal"></div>
<div class="mdl-dialog">
	<div class="mdl-dialog__content">
		<div class="mdl-card mdl-shadow--2dp">
			<form id="formAddProduct">
				<div class="mdl-card__title">
			        <h2 class="mdl-card__title-text">Seleccionar productos</h2>
			    </div>
			    <div class="mdl-grid">
			    	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
			    		<span class="errorForm color-text--red"></span>
			    	</div>
			    </div>
			    <div class="mdl-grid dialog">
			    	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
						<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size">
							<label class="mdl-selectfield__label" for="productos">Productos</label>
					    	<select class="mib-field mdl-selectfield__select select2" id="productos">
					    		<?php foreach(Products::model()->findAll() as $key => $product) { ?>
					    			<option value="<?= $product->idproducts; ?>"><?= $product->name; ?></option>
					    		<?php } ?>
					    	</select>
					    </div>
					</div>
					<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
	                        <input class="mib-field mdl-textfield__input" type="number" min="1" value="1" id="order-product-cantidad" name="Order_products">
	                        <label class="mdl-textfield__label" for="order-product-cantidad">Cantidad</label>
	                    </div>
					</div>
					<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
						<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size product-ltab">
							<label class="mdl-selectfield__label" for="talles-tab">Talles</label>
	                        <select class="mib-field mdl-selectfield__select select2" name="Order_products" id="talles-tab">
	                    		<?php foreach($listTallesAbajo as $k => $ltab){ ?>
	                    			<option value="<?= $ltab ?>"><?= $ltab?></option>
	                    		<?php } ?>
	                        </select>
						</div>
						<div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label getmdl-select full-size product-ltar">
							<label class="mdl-selectfield__label" for="talles-tar">Talles</label>
							<select class="mib-field mdl-selectfield__select select2" name="Order_products" id="talles-tar">
	                        	<?php foreach($listTallesArriba as $k => $ltar){ ?>
	                    			<option value="<?= $ltar ?>"><?= $ltar?></option>
	                    		<?php } ?>
	                        </select>
						</div>
					</div>
					<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
	                        <input class="mib-field mdl-textfield__input" type="text" id="order-product-apodo" name="Order_products" data-emoji="emoji">
	                        <label class="mdl-textfield__label" for="order-product-apodo">Apodo</label>
	                    </div>
					</div>
					<input class="mib-field mdl-textfield__input hidden" type="text" id="order-product-price" name="Order_products">
			    </div>
			    <div class="mdl-dialog__actions">
				    <button type="button" class="mdl-button add-product">Agregar</button>
				    <button type="button" class="mdl-button modify-product hidden">Modificar</button>
				    <button type="button" class="mdl-button close">Cancelar</button>
				</div>
				
			</form>
		</div>
	</div>
</div>
