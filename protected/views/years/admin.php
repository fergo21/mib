<?php
/* @var $this YearsController */
/* @var $model Years */
?>

<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--6-col-phone form__article mib-table">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title mib-table--title">
            <h1 class="mdl-card__title-text table">Curso</h1>
            <div>
            	<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect color-text--orange button-year">Agregar curso</a>
            </div>
        </div>
        <div class="mdl-card__supporting-text no-padding">
			<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'years-grid',
				'summaryText' => '',
				'itemsCssClass' => 'mdl-data-table mdl-js-data-table stripped-table',
				'dataProvider'=>$model->search(),
				// 'filter'=>$model,
				'columns'=>array(
					'year',
					array(
						'header' => 'Acciones',
						'class'=>'ButtonColumn', //esta clase se encuentra en components (es personalizada)
						'template'=>'{erase}',
						'evaluateID'=>true, // esta opcion va si o si cuando se usa ButtonColumn
						'buttons'=>array(
							'erase' => array(
								'label'=>'<i class="material-icons">delete</i>',
								'imageUrl'=>false,
								'url'=>'Yii::app()->createUrl("years/delete/$data->idyears")',
								'options'=>array(
									'title'=>'Eliminar',
									'onclick'=>'deleteItem(this, "years-grid")',
								),
								'visible'=>'$data->idyears',
							)	
						),
					),
				),
			)); ?>
		</div>
	</div>
</div>

