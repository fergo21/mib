<?php
/* @var $this YearsController */
/* @var $dataProvider CActiveDataProvider */
?>
<div class="mdl-grid ui-tables">
	<?php 
		$this->renderPartial('admin', array('model'=>$model));
		$this->renderPartial('../divisions/admin', array('model'=>$model_division));
	?>
</div>

<div class="mib-background-modal"></div>
<div class="mdl-dialog">
	<div class="mdl-dialog__content">
		<div id="content-year" style="display:none">
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
		<div id="content-division" style="display:none">
			<?php $this->renderPartial('../divisions/_form', array('model'=>$model_division)); ?>
		</div>
	</div>
</div>




