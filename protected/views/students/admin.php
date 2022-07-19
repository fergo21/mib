<?php
/* @var $this StudentsController */
/* @var $model Students */

$this->breadcrumbs=array(
	'Students'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Students', 'url'=>array('index')),
	array('label'=>'Create Students', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	$('.mib-table').toggleClass('mdl-cell--12-col-desktop mdl-cell--9-col-desktop  mdl-cell--12-col-tablet  mdl-cell--9-col-tablet');

	return false;
});
/*$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('#students-grid', {
		data: $(this).serialize()
	});
	return false;
});*/
");
// echo "<pre>";
// print_r($model);die;
?>
<div class="mdl-grid ui-tables">
	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
		<?php echo CHtml::link('Búsqueda avanzada','#',array('class'=>'search-button')); ?>
	</div>
	<div class="search-form mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone form__article" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div><!-- search-form -->
	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article mib-table">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mib-table--title">
                <h1 class="mdl-card__title-text table">Estudiantes</h1>
                <div>
                	<a href="<?= Yii::app()->baseUrl; ?>/students/create" class="mdl-button mdl-js-button mdl-js-ripple-effect color-text--orange">Agregar estudiante</a>
                </div>
            </div>
            <div class="mdl-card__supporting-text no-padding">
            	<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'students-grid',
					'summaryText' => '',
					'itemsCssClass' => 'mdl-data-table mdl-js-data-table stripped-table',
					'dataProvider'=>$model->search(),
					'columns'=>array(
						array(
							'name' => 'name',
							'sortable' => false
						),
						array(
							'name' => 'surname',
							'sortable' => false
						),
						array(
							'name' => 'ci',
							'sortable' => false
						),
						array(
							'name' => 'email',
							'sortable' => false
						),
						array(
							'name' => 'phone',
							'sortable' => false
						),
						array(
							'name' => 'idschools',
							'sortable' => false,
							'value' => '$data->idschools0->name'
						),
						array(
							'name' => 'idyears',
							'sortable' => false,
							'value' => '$data->idyears0->year'
						),
						array(
							'name' => 'iddivision',
							'sortable' => false,
							'value' => '$data->iddivision0->division'
						),
						array(
							'name' => 'idshifts',
							'sortable' => false,
							'value' => '$data->idshifts0->shift'
						),
						array(
							'header' => 'Acciones',
							'class'=>'ButtonColumn', //esta clase se encuentra en components (es personalizada)
							'template'=>'{update}{erase}',
							'evaluateID'=>true, // esta opcion va si o si cuando se usa ButtonColumn
							'buttons'=>array(
								'update' => array(
									'label'=>'<i class="material-icons">create</i>',
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("students/update/$data->idstudents")',
									'options'=>array('title'=>'Editar'),
									'visible'=>'$data->idstudents'
								),
								'erase' => array(
									'label'=>'<i class="material-icons">delete</i>',
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("students/delete/$data->idstudents")',
									'options'=>array(
										'title'=>'Eliminar',
										'onclick'=>'deleteItem(this, "students-grid")',
									),
									'visible'=>'$data->idstudents',
								)	
							),
						),
					),
				)); ?>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		<?php if(Yii::app()->user->getFlash("success") == 'ok'){ ?>
			actionAlertPrompt("success", "Agregado con éxito", "¿Quieres cargar un pedido para el estudiante agregado?", "<?= Yii::app()->user->getFlash("redirect") ?>");
		<?php } ?>	
	});
</script>

