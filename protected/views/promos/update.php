<?php
/* @var $this PromosController */
/* @var $model Promos */

// echo "<pre>";
// print_r($modelStudents);die;
?>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
		<?php $this->renderPartial('../students/adminPartial', array('model'=>$modelStudents, 'promoId'=>$model->idpromos)); ?>
	</div>
</div>