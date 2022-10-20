<?php
/* @var $this PromosController */
/* @var $model Promos */

// $this->breadcrumbs=array(
// 	'Promoses'=>array('index'),
// 	'Manage',
// );

// $this->menu=array(
// 	array('label'=>'List Promos', 'url'=>array('index')),
// 	array('label'=>'Create Promos', 'url'=>array('create')),
// );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('#promos-grid', {
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
                <h1 class="mdl-card__title-text table">Promos</h1>
                <div>
                	<a href="#" id="show-dialog-promo" class="mdl-button mdl-js-button mdl-js-ripple-effect color-text--orange">Agregar promo</a>
                </div>
            </div>
            <div class="mdl-card__supporting-text no-padding">
				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'promos-grid',
					'summaryText' => '',
					'itemsCssClass' => 'mdl-data-table mdl-js-data-table stripped-table',
					'dataProvider'=>$modelPromo->search(),
					'columns'=>array(
						// array(
						// 	'name'=>'image_promo',
						// 	'sortable'=>false
						// ),
						array(
							'name'=>'year_promo',
							'sortable'=>false
						),
						array(
							'name'=>'idyears',
							'sortable'=>false,
							'value' => '$data->idyears0->year'
						),
						array(
							'name'=>'iddivision',
							'sortable'=>false,
							'value' => '$data->iddivision0->division'
						),
						array(
							'name'=>'idshifts',
							'sortable'=>false,
							'value' => '$data->idshifts0->shift'
						),
						array(
							'name'=>'name_manager',
							'sortable'=>false
						),
						array(
							'name'=>'tel_manager',
							'sortable'=>false
						),
						array(
							'header'=>'Cant. de estudiantes',
							'type' => 'raw',
							'value' => 'Utils::quantityStudents($data)',
						),
						// array(
						// 	'name'=>'idschools',
						// 	'sortable'=>false,
						// 	'value' => '$data->idschools0->name'
						// ),
						array(
							'header' => 'Acciones',
							'class'=>'ButtonColumn', //esta clase se encuentra en components (es personalizada)
							'template'=>'{view}{create}{massive}{update}{erase}',
							'evaluateID'=>true, // esta opcion va si o si cuando se usa ButtonColumn
							'buttons'=>array(
								'view' => array(
									'label'=>'<i class="material-icons">visibility</i>',
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("promos/view/$data->idpromos")',
									'options'=>array('title'=>'Ver promo'),
									'visible'=>'Yii::app()->user->checkAccess(\'view\')'
								),
								'create' => array(
									'label'=>'<i class="material-icons">group</i>',
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("students/create/$data->idpromos")',
									'options'=>array('title'=>'Cargar Alumno'),
									'visible'=>'Yii::app()->user->checkAccess(\'create\')'
								),
								'massive' => array(
									'label'=>'<i class="material-icons">file_upload</i>',
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("students/importar/$data->idpromos")',
									'options'=>array('title'=>'Cargar Masiva'),
									'visible'=>'Yii::app()->user->checkAccess(\'create\')',
									'click'=>'function(e){
										e.preventDefault();
										$("#urlMassive").val(this.href);
										$(".massive-dialog").show();
										$(".massive-modal").show();

									}'
								),
								'update' => array(
									'label'=>'<i class="material-icons">create</i>',
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("promos/update/$data->idpromos")',
									'click'=>'function(e){
										e.preventDefault();
										let idpromos = this.href.match(/(\d+)/g).pop();
										
									        $.ajax({
									            url: `${homeUrl}/promos/getPromoUpdate`,
									            dataType: "json",
									            type: "POST",
									            data: {q:idpromos}
									        })
									        .done(function(data){
									            if(data){
									            	$("form#promos-form").attr("action","'.Yii::app()->createUrl("promos/update").'/"+data.idpromos)
									            	$(".title-promo").html("Modificar promo");
									            	$("#Promos_tel_manager").val(data.tel_manager);
									            	$("#Promos_name_manager").val(data.name_manager);
									            	$("#Promos_year_promo").val(data.year_promo);
									            	$("#Promos_date_delivery").val(data.date_delivery);
									            	$("#Promos_date_contract").val(data.date_contract);
									            	$("#Promos_iddivision").val(data.iddivision);
									            	$("#Promos_idyears").val(data.idyears);
									            	$("#Promos_idshifts").val(data.idshifts);
									            	$("#data-image_promo").attr("src", data.image_promo);

									            	$("#Promos_tel_manager, #Promos_name_manager").parent().addClass("is-dirty");
									            	$("#Promos_year_promo, #Promos_iddivision, #Promos_idyears, #Promos_idshifts").trigger("change");
													$(".mdl-dialog").show();
													$(".mib-background-modal").show();
													$(".massive-dialog").hide();
													$(".massive-modal").hide();
									            }
									        })
									        .fail(function(err){
									            console.log(err);
									        });
										

									}',
									'options'=>array('title'=>'Editar'),
									'visible'=>'Yii::app()->user->checkAccess(\'update\')'
								),
								'erase' => array(
									'label'=>'<i class="material-icons">delete</i>',
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("promos/delete/$data->idpromos")',
									'options'=>array(
										'title'=>'Eliminar',
										'onclick'=>'deleteItem(this, "promos-grid")',
									),
									'visible'=>'Yii::app()->user->checkAccess(\'delete\')'
								),
							),
						),
					),
				)); ?>
			</div>
        </div>
	</div>
</div>
