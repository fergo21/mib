<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Orders', 'url'=>array('index')),
	array('label'=>'Create Orders', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	$('.mib-table').toggleClass('mdl-cell--12-col-desktop mdl-cell--9-col-desktop  mdl-cell--12-col-tablet  mdl-cell--9-col-tablet');
	$('.mdl-selectfield.full-size').addClass('is-dirty');
	return false;
});
/*$('.search-form form').submit(function(e){
	e.preventDefault();
	searchData();
	$.fn.yiiGridView.update('#orders-grid', {
		data: $(this).serialize()
	});
	return false;
});*/

$('[type=checkbox]').change(function(){
	console.log($(this)[0].checked);
	let idpromos = $(this).attr('data-id');
	let check = $(this)[0].checked;

	    $.ajax({
	        url: `".Yii::app()->baseUrl."/orders/out`,
	        dataType: 'json',
	        type: 'POST',
	        data: {q:idpromos, i: check ? 1 : 0}
	    })
	    .done(function(data){
	        if(data.status){
	        	window.location.reload();
	   			//  $.fn.yiiGridView.update('orders-grid',{
				// 	data: $(this).serialize()
				// });
	        }
	    })
	    .fail(function(err){
	        console.log(err);
	    });
});

$('#downloadFile').click(function(){
	$.ajax({
		url: `".Yii::app()->baseUrl."/orders/downloadlist`,
		dataType: 'json',
		contentType: 'application/json; charset=utf-8',
		type: 'POST',
		data:{q:1}
	})
	.done(function(data){
		console.log(data);
		
	})
	.fail(function(err){
		console.log(err);
	});
});

");
?>
<div class="mdl-grid ui-tables">
	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
		<?php echo CHtml::link('Búsqueda avanzada','#',array('class'=>'search-button')); ?>
	</div>
	<div class="search-form mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone form__article" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
		'modelSchool'=>$modelSchool,
		'modelYear'=>$modelYear,
		'modelDivision'=>$modelDivision,
		'modelShift'=>$modelShift,
		'modelPromo'=>$modelPromo,
	)); ?>
	</div><!-- search-form -->
	<div class="mdl-cell mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article mib-table">
		<div class="mdl-grid ui-tables">
			<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
		        <div class="mdl-card mdl-shadow--2dp">
		            <div class="mdl-card__title mib-table--title mib-content-actions">
			            <h1 class="mdl-card__title-text table">Pedido</h1>
		                <div class="mib-actions">
		                	<a href="<?= Yii::app()->baseUrl; ?>/orders/create" class="mdl-button mdl-js-button mdl-js-ripple-effect color-text--orange">Agregar Pedido</a>
		                	<form action="<?= Yii::app()->baseUrl.'/orders/downloadlist' ?>" method="post">
		                		<input type="hidden" id="downloadFileData" name="data_download">
			                	<button title="Descargar listado para producción" id="downloadFile" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange">
	                                <i class="material-icons">file_download</i>
	                                Descargar
	                            </button>
		                	</form>
		                </div>
		            </div>
		            <div class="mdl-card__supporting-text no-padding">
						<?php $this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'orders-grid',
							'summaryText' => '',
							'dataProvider'=>$model->search(),
							// 'filter'=>$model,
							'itemsCssClass' => 'mdl-data-table mdl-js-data-table stripped-table',
							'columns'=>array(
								array(
									'name' => 'idorders',
									'sortable' => false
								),
								array(
									'header' => 'Escuela',
									'sortable' => true,
									'type' => 'raw',
									'value' => 'Schools::model()->findByPk($data->idstudents0->idschools)->name',
									// 'headerHtmlOptions'=>array('style'=>'display:none'),
									// 'htmlOptions'=>array('style'=>'display:none')
								),
								array(
									'header' => 'Promo',
									'sortable' => false,
									'type' => 'raw',
									'value' => '$data->idstudents0->graduation_year',
									'headerHtmlOptions'=>array('style'=>'width:3%;')
								),
								array(
									'header' => 'Curso',
									'sortable' => false,
									'type' => 'raw',
									'value' => 'Years::model()->findByPk($data->idstudents0->idyears)->year',
									'headerHtmlOptions'=>array('style'=>'width:3%;')
								),
								array(
									'header' => 'División',
									'sortable' => false,
									'type' => 'raw',
									'value' => 'Divisions::model()->findByPk($data->idstudents0->iddivision)->division',
									'headerHtmlOptions'=>array('style'=>'width:3%;')
								),
								array(
									'header' => 'Turno',
									'sortable' => false,
									'type' => 'raw',
									'value' => 'Shifts::model()->findByPk($data->idstudents0->idshifts)->shift',
									'headerHtmlOptions'=>array('style'=>'width:3%;')
								),
								array(
									'name' => 'idstudents',
									'sortable' => false,
									'type' => 'raw',
									'value' => 'Utils::renderStudent($data, true)'
								),
								array(
									'header' => 'Estado de pago',
									'type' => 'raw',
									'value' => 'Utils::statusPaid($data)',
									'headerHtmlOptions'=>array('style'=>'width:10%;')
									// 'sortable'=>false,
								),
								array(
									'name' => 'date',
									'sortable' => false,
									'value' => 'date("d-m-Y", strtotime($data->date))',
									'headerHtmlOptions'=>array('style'=>'width:10%;')
								),
								array(
									'name' => 'date_delivery',
									'sortable' => false,
									'value' => 'date("d-m-Y", strtotime($data->date_delivery))',
									'headerHtmlOptions'=>array('style'=>'width:10%;')
								),
								array(
									'name' => 'total_amount',
									'sortable' => false
								),
								// array(
								// 	'name' => 'dues',
								// 	'sortable' => false,
								// 	'headerHtmlOptions'=>array('style'=>'width:5%;')
								// ),
								array(
									'header' => '<span>Fuera de producción</span>',
									'type' => 'raw',
									'value' => 'Utils::renderSwitch($data)',
									'headerHtmlOptions'=>array('style'=>'width:5px;white-space:pre-wrap;')
								),
								// array(
								// 	'name' => 'status',
								// 	'sortable' => false
								// ),
								/*
								'idusers'
								*/
								array(
									'header' => 'Acciones',
									'class'=>'ButtonColumn', //esta clase se encuentra en components (es personalizada)
									'template'=>'{update}{erase}',
									'evaluateID'=>true, // esta opcion va si o si cuando se usa ButtonColumn
									'headerHtmlOptions'=>array('style'=>'width:10%;'),
									'buttons'=>array(
										'update' => array(
											'label'=>'<i class="material-icons">create</i>',
											'imageUrl'=>false,
											'url'=>'Yii::app()->createUrl("orders/update/$data->idorders")',
											'options'=>array('title'=>'Editar'),
											'visible'=>'Yii::app()->user->checkAccess(\'update\')'
										),
										'erase' => array(
											'label'=>'<i class="material-icons">delete</i>',
											'imageUrl'=>false,
											'url'=>'Yii::app()->createUrl("orders/delete/$data->idorders")',
											'options'=>array(
												'title'=>'Eliminar',
												'onclick'=>'deleteItem(this, "orders-grid")',
											),
											'visible'=>'Yii::app()->user->checkAccess(\'delete\')'
										)	
									),
								),
							),
						)); ?>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		<?php if(Yii::app()->user->getFlash("warning") == 'ok'){ ?>
			actionAlert("No se encontraron registros para descargar.", "warning");
		<?php } ?>
		<?php if(Yii::app()->user->getFlash("success") == 'ok'){ ?>
			actionAlertPrompt("success", "Agregado con éxito", "¿Quieres cargar otro estudiante para el misma promo?", "<?= Yii::app()->user->getFlash("redirect") ?>");
		<?php } ?>	
	});
</script>
