<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Products', 'url'=>array('index')),
	array('label'=>'Create Products', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	$('.mib-table').toggleClass('mdl-cell--12-col-desktop mdl-cell--9-col-desktop  mdl-cell--12-col-tablet  mdl-cell--9-col-tablet');
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('#products-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="mdl-grid ui-tables">
	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
		<?php echo CHtml::link('Búsqueda avanzada','#',array('class'=>'search-button')); ?>
	</div>
	<div class="search-form mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone form__article" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div><!-- search-form -->
	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article mib-table">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mib-table--title">
                <h1 class="mdl-card__title-text table">Productos</h1>
                <div>
                	<a href="<?= Yii::app()->baseUrl; ?>/products/create" class="mdl-button mdl-js-button mdl-js-ripple-effect color-text--orange">Agregar producto</a>
                </div>
            </div>
            <div class="mdl-card__supporting-text no-padding">
				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'products-grid',
					'dataProvider'=>$model->search(),
					'itemsCssClass' => 'mdl-data-table mdl-js-data-table stripped-table',
					// 'filter'=>$model,
					'columns'=>array(
						array(
							'name' => 'name',
							'sortable' => false
						),
						array(
							'name' => 'price',
							'sortable' => false
						),
						array(
							'name' => 'description',
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
									'url'=>'Yii::app()->createUrl("products/update/$data->idproducts")',
									'options'=>array('title'=>'Editar'),
									'visible'=>'$data->idproducts'
								),
								'erase' => array(
									'label'=>'<i class="material-icons">delete</i>',
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("products/delete/$data->idproducts")',
									'options'=>array(
										'title'=>'Eliminar',
										'onclick'=>'deleteItem(this, "products-grid")',
									),
									'visible'=>'$data->idproducts',
								)	
							),
						),
					),
				)); ?>
			</div>
		</div>
	</div>
</div>
