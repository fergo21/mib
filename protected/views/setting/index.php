<?php
/* @var $this SettingController */

$this->breadcrumbs=array(
	'Setting',
);

?>

<div class="mdl-card mdl-shadow--2dp employer-form" action="#">
    <div class="mdl-card__title">
        <h2>Más Configuraciones</h2>
    </div>

    <div class="mdl-card__supporting-text">
        <form action="<?= Yii::app()->baseUrl ?>/setting/update" class="form" method="POST">
            <div class="form__article">
                <div class="mdl-grid">
                	<div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" max="30" id="setting_expiration_day" name="setting_expiration_day" value="<?= $setting['expiration_day']; ?>"/>
                        <label class="mdl-textfield__label" for="setting_expiration_day">Plazo de pago</label>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="setting_percent_cc" name="setting_percent_cc" value="<?= Utils::formatPercent($setting['percent_cc'], false); ?>"/>
                        <label class="mdl-textfield__label" for="setting_percent_cc">% de Tarjeta de Crédito</label>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="setting_percent_expiration" name="setting_percent_expiration" value="<?= Utils::formatPercent($setting['percent_expiration'], false); ?>"/>
                        <label class="mdl-textfield__label" for="setting_percent_expiration">% por mora</label>
                    </div>
                </div>
            </div>
            <div class="row buttons">
				<?php echo CHtml::submitButton('Guardar', array('class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange')); ?>
			</div>
        </form>
    </div>
</div>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		<?php if(Yii::app()->user->getFlash("success") == 'ok'){ ?>
			actionAlert("Modificado con éxito","success");
		<?php } ?>	
	});
</script>
