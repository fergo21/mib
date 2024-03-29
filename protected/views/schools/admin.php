<?php
/* @var $this SchoolsController */
/* @var $model Schools */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Schools', 'url'=>array('index')),
	array('label'=>'Create Schools', 'url'=>array('create')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	$('.mib-table').toggleClass('mdl-cell--12-col-desktop mdl-cell--9-col-desktop  mdl-cell--12-col-tablet  mdl-cell--9-col-tablet');

	return false;
});
/*$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('#schools-grid', {
		data: $(this).serialize()
	});
	return false;
});*/
");
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
	            <h1 class="mdl-card__title-text table">Escuelas</h1>
	            <div>
	            	<a href="<?= Yii::app()->baseUrl; ?>/schools/create" class="mdl-button mdl-js-button mdl-js-ripple-effect color-text--orange">Agregar escuela</a>
	            </div>
	        </div>
	        <div class="mdl-card__supporting-text no-padding">
	        	<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'schools-grid',
					'summaryText' => '',
					'itemsCssClass' => 'mdl-data-table mdl-js-data-table stripped-table',
					'dataProvider'=>$model->search(),
					'columns'=>array(
						// array(
						// 	'name' => 'idschools',
						// 	'sortable' => false
						// ),
						array(
							'name' => 'name',
							'sortable' => false
						),
						array(
							'name' => 'city',
							'sortable' => false
						),
						array(
							'name' => 'idprovince',
							'sortable' => false,
							'value' => '$data->idprovince0->name'
						),
						array(
							'name' => 'expiration_day',
							'sortable' => false
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
									'url'=>'Yii::app()->createUrl("schools/update/$data->idschools")',
									'options'=>array('title'=>'Editar'),
									'visible'=>'Yii::app()->user->checkAccess(\'update\')'
								),
								'erase' => array(
									'label'=>'<i class="material-icons">delete</i>',
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("schools/delete/$data->idschools")',
									'options'=>array(
										'title'=>'Eliminar',
										'onclick'=>'deleteItem(this, "schools-grid")',
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
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		<?php if(Yii::app()->user->getFlash("success") == 'ok'){ ?>
			actionAlert("Creado con éxito!", "success");
		<?php } ?>	
	});
</script>
