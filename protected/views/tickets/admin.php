<?php
/* @var $this TicketsController */
/* @var $model Tickets */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('#tickets-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="mdl-grid ui-tables">
	<div class="mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article mib-table">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mib-table--title">
                <h1 class="mdl-card__title-text table">Facturación</h1>
                <div>
                	<a href="#" id="show-dialog-promo" class="mdl-button mdl-js-button mdl-js-ripple-effect color-text--orange">Agregar Factura</a>
                </div>
            </div>
            <div class="mdl-card__supporting-text no-padding">
				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'tickets-grid',
					'itemsCssClass' => 'mdl-data-table mdl-js-data-table stripped-table',
					'dataProvider'=>$model->search(),
					'columns'=>array(
						array(
							'name'=>'code',
							'sortable'=>false
						),
						array(
							'name'=>'amount',
							'sortable'=>false
						),
						array(
							'header'=>'Estado',
							'type' => 'raw',
							'value' => 'Utils::renderStatusPaid()',
							'sortable'=>false,

						),
						array(
							'name'=>'date',
							'sortable'=>false,
							'value' => 'date("d-m-Y", strtotime($data->date))'
						),
						// array(
						// 	'header' => 'Acciones',
						// 	'class'=>'ButtonColumn', //esta clase se encuentra en components (es personalizada)
						// 	'template'=>'{view}{create}{update}{erase}',
						// 	'evaluateID'=>true, // esta opcion va si o si cuando se usa ButtonColumn
						// 	'buttons'=>array(
						// 		'view' => array(
						// 			'label'=>'<i class="material-icons">visibility</i>',
						// 			'imageUrl'=>false,
						// 			'url'=>'Yii::app()->createUrl("promos/view/$data->idpromos")',
						// 			'options'=>array('title'=>'Ver promo'),
						// 			'visible'=>'$data->idpromos'
						// 		),
						// 		'create' => array(
						// 			'label'=>'<i class="material-icons">group</i>',
						// 			'imageUrl'=>false,
						// 			'url'=>'Yii::app()->createUrl("students/create/$data->idpromos")',
						// 			'options'=>array('title'=>'Cargar Alumno'),
						// 			'visible'=>'$data->idpromos'
						// 		),
						// 		'update' => array(
						// 			'label'=>'<i class="material-icons">create</i>',
						// 			'imageUrl'=>false,
						// 			'url'=>'Yii::app()->createUrl("promos/update/$data->idpromos")',
						// 			'click'=>'function(e){
						// 				e.preventDefault();
						// 				let idpromos = this.href.slice(-1);
										
						// 			        $.ajax({
						// 			            url: `${homeUrl}/promos/getPromoUpdate`,
						// 			            dataType: "json",
						// 			            type: "POST",
						// 			            data: {q:idpromos}
						// 			        })
						// 			        .done(function(data){
						// 			            if(data){
						// 			            	$("form#promos-form").attr("action","'.Yii::app()->createUrl("promos/update").'/"+data.idpromos)
						// 			            	$(".title-promo").html("Modificar promo");
						// 			            	$("#Promos_tel_manager").val(data.tel_manager);
						// 			            	$("#Promos_year_promo").val(data.year_promo);
						// 			            	$("#Promos_date_delivery").val(data.date_delivery);
						// 			            	$("#Promos_date_contract").val(data.date_contract);
						// 			            	$("#Promos_iddivision").val(data.iddivision);
						// 			            	$("#Promos_idyears").val(data.idyears);
						// 			            	$("#Promos_idshifts").val(data.idshifts);
						// 			            	$("#data-image_promo").attr("src", data.image_promo);

						// 			            	$("#Promos_tel_manager").parent().addClass("is-dirty");
						// 			            	$("#Promos_year_promo, #Promos_iddivision, #Promos_idyears, #Promos_idshifts").trigger("change");
						// 			            }
						// 			        })
						// 			        .fail(function(err){
						// 			            console.log(err);
						// 			        });
						// 					$(".mdl-dialog").show();
						// 					$(".mib-background-modal").show();
										

						// 			}',
						// 			'options'=>array('title'=>'Editar'),
						// 			// 'visible'=>'$data->idpromos'
						// 		),
						// 		'erase' => array(
						// 			'label'=>'<i class="material-icons">delete</i>',
						// 			'imageUrl'=>false,
						// 			'url'=>'Yii::app()->createUrl("promos/delete/$data->idpromos")',
						// 			'options'=>array(
						// 				'title'=>'Eliminar',
						// 				'onclick'=>'deleteItem(this, "promos-grid")',
						// 			),
						// 			'visible'=>'$data->idpromos',
						// 		),
						// 	),
						// ),
					),
				)); ?>
			</div>
        </div>
	</div>
</div>
