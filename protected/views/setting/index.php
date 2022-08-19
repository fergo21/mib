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
                <h3>Vencimiento de pago</h3>
                <div class="mdl-grid">
                	<div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" max="30" id="setting_expiration_day" name="setting_expiration_day" value="<?= $setting['expiration_day']; ?>"/>
                        <label class="mdl-textfield__label" for="setting_expiration_day">Plazo de pago</label>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" max="30" id="setting_expiration_day_2" name="setting_expiration_day_2" value="<?= $setting['expiration_day_2']; ?>"/>
                        <label class="mdl-textfield__label" for="setting_expiration_day_2">2° Plazo de pago</label>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="setting_percent_expiration" name="setting_percent_expiration" value="<?= Utils::formatPercent($setting['percent_expiration'], false); ?>"/>
                        <label class="mdl-textfield__label" for="setting_percent_expiration">% por mora</label>
                    </div>
                    
                </div>
            </div>
            <div class="form__article">
                <h3>Porcentaje de método de pago</h3>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="setting_percent_cc" name="setting_percent_cc" value="<?= Utils::formatPercent($setting['percent_cc'], false); ?>"/>
                        <label class="mdl-textfield__label" for="setting_percent_cc">% de Tarjeta de Crédito</label>
                    </div>
                </div>
            </div>
            <div class="form__article">
                <h3>Porcentaje de financiamiento</h3>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="setting_percent_f_4" name="setting_percent_f_4" value="<?= Utils::formatPercent($setting['percent_f_4'], false); ?>"/>
                        <label class="mdl-textfield__label" for="setting_percent_f_4">% cuota 4</label>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="setting_percent_f_5" name="setting_percent_f_5" value="<?= Utils::formatPercent($setting['percent_f_5'], false); ?>"/>
                        <label class="mdl-textfield__label" for="setting_percent_f_5">% cuota 5</label>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="setting_percent_f_6" name="setting_percent_f_6" value="<?= Utils::formatPercent($setting['percent_f_6'], false); ?>"/>
                        <label class="mdl-textfield__label" for="setting_percent_f_6">% cuota 6</label>
                    </div>
                </div>
            </div>
             <div class="form__article">
                <h3>Descuento por cantidad de productos</h3>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--3-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="setting_percent_qp_2" name="setting_percent_qp_2" value="<?= Utils::formatPercent($setting['percent_qp_2'], false); ?>"/>
                        <label class="mdl-textfield__label" for="setting_percent_qp_2">% con 2 productos</label>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="setting_percent_qp_3" name="setting_percent_qp_3" value="<?= Utils::formatPercent($setting['percent_qp_3'], false); ?>"/>
                        <label class="mdl-textfield__label" for="setting_percent_qp_3">% con 3 productos</label>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="setting_percent_qp_4" name="setting_percent_qp_4" value="<?= Utils::formatPercent($setting['percent_qp_4'], false); ?>"/>
                        <label class="mdl-textfield__label" for="setting_percent_qp_4">% con 4 productos</label>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="setting_percent_qp_more" name="setting_percent_qp_more" value="<?= Utils::formatPercent($setting['percent_qp_more'], false); ?>"/>
                        <label class="mdl-textfield__label" for="setting_percent_qp_more">% con mas de 5 productos</label>
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
