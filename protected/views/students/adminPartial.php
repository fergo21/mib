<?php
/* @var $this StudentsController */
/* @var $model Students */

?>
<div class="mdl-grid ui-tables">
	<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article mib-table">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mib-table--title">
                <h1 class="mdl-card__title-text table">Estudiantes</h1>
                <div>
                	<a href="<?= Yii::app()->baseUrl; ?>/students/create/<?= $promoId ?>" class="mdl-button mdl-js-button mdl-js-ripple-effect color-text--orange">Agregar estudiante</a>
                </div>
            </div>
            <div class="mdl-card__supporting-text no-padding">
            	<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'students-grid',
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

