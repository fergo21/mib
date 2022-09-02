<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="mdl-grid ui-tables">
	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mib-table--title">
                <h1 class="mdl-card__title-text table">Usuarios</h1>
                <div>
                	<a href="<?= Yii::app()->baseUrl; ?>/users/create" class="mdl-button mdl-js-button mdl-js-ripple-effect color-text--orange">Agregar usuario</a>
                </div>
            </div>
            <div class="mdl-card__supporting-text no-padding">
            	<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'users-grid',
					'itemsCssClass' => 'mdl-data-table mdl-js-data-table stripped-table',
					'dataProvider'=>$model->search(),
					'columns'=>array(
						array(
							'name' => 'user',
							'sortable' => false
						),
						array(
							'name' => 'name',
							'sortable' => false
						),
						array(
							'name' => 'surname',
							'sortable' => false
						),
						array(
							'name' => 'roles_idroles',
							'sortable' => false,
							'value' => '$data->rolesIdroles->type'
							//'cssClassExpression'=>'mdl-data-table__cell--non-numeric'
						),
						array(
							'name' => 'idbranch_offices',
							'sortable' => false,
							'value' => '$data->idbranchOffices->office'
							//'cssClassExpression'=>'mdl-data-table__cell--non-numeric'
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
									'url'=>'Yii::app()->createUrl("users/update/$data->idusers")',
									'options'=>array('title'=>'Editar'),
									'visible'=>'Yii::app()->user->checkAccess(\'update\')'
								),
								'erase' => array(
									'label'=>'<i class="material-icons">delete</i>',
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("users/delete/$data->idusers")',
									'options'=>array(
										'title'=>'Eliminar',
										'onclick'=>'deleteItem(this, "users-grid")',
									),
									'visible'=>'$data->idusers != Yii::app()->user->id && Yii::app()->user->checkAccess(\'delete\')'
								)	
							),
						),
					),
				)); ?>
            </div>
        </div>
    </div>
</div>
