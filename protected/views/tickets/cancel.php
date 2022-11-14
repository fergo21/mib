<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-cell--top">
	<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'tickets-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>
		<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
		    <div class="mdl-card mdl-shadow--2dp">
		        <div class="mdl-card__title">
		            <h5 class="mdl-card__title-text text-color--white">Anular Factura</h5>
		        </div>
		        <div class="mdl-card__supporting-text">
		            <form class="form form--basic">
		            	<div class="mdl-grid" style="align-items: start;">
		                	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
		                		<div class="mib-actions" style="align-items: center;">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
										<?php echo $form->labelEx($model,'idtickets', array('class'=>'mdl-textfield__label ')); ?>
										<?php echo $form->textField($model,'idtickets', array('class'=>'mdl-textfield__input')); ?>
										<?php echo $form->error($model,'idtickets'); ?>
									</div>
									<button class="mdl-button mdl-js-button mdl-button--icon mdl-button--raised mdl-js-ripple-effect button--colored-orange" id="search-tickets">
	                                    <i class="material-icons">search</i>
	                                </button>
		                		</div>
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label full-size">
									<?php echo $form->labelEx($model,'obs_canceled', array('class'=>'mdl-textfield__label ')); ?>
									<?php echo $form->textArea($model,'obs_canceled',array('rows'=>3, 'cols'=>50, 'class'=>'mdl-textfield__input')); ?>
									<?php echo $form->error($model,'obs_canceled'); ?>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone form__article">
								<div id="fill-data-ticket"></div>
							</div>
						</div>
						<div class="row buttons">
							<?php echo CHtml::link('Cancelar', Yii::app()->baseUrl.'/tickets', array('class'=>'btn btn-default buttonAction')); ?>
							<?php echo CHtml::submitButton('Anular', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange', 'id'=>'submitTicket')); ?>
						</div>
		            </form>
		        </div>
		    </div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		let urlparams = window.location.href.split("/")[6];
		if(isFinite(urlparams)){
			document.querySelector("#search-tickets").click();
		}
	});
</script>