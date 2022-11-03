<?php
/* @var $this TicketsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tickets',
);

$this->menu=array(
	array('label'=>'Create Tickets', 'url'=>array('create')),
	array('label'=>'Manage Tickets', 'url'=>array('admin')),
);
?>

<div class="mdl-grid ui-colors mib-box">
    <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp teal">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Pedidos</h2>
            </div>
            <div class="mdl-card__supporting-text">
            	<div>
            		<a href="<?=  Yii::app()->baseUrl; ?>/orders/create">Generar pedido</a>
            		<a href="<?=  Yii::app()->baseUrl; ?>/orders/admin">Consultar pedido</a>
                    <a href="<?=  Yii::app()->baseUrl; ?>/orders/presupuesto">Presupuesto</a>
            	</div>
            	<i class="material-icons big-icon">shopping_cart</i>
                <!-- <h3></h3> -->
            </div>
        </div>
    </div>
        <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
            <div class="mdl-card mdl-shadow--2dp red">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Facturación</h2>
                </div>
                <div class="mdl-card__supporting-text">
                	<div>
    	            	<a href="<?=  Yii::app()->baseUrl; ?>/tickets/create">Facturar</a>
    	            	<a href="<?=  Yii::app()->baseUrl; ?>/tickets/cancel">Anular Factura</a>
    	            	<a href="<?=  Yii::app()->baseUrl; ?>/tickets/admin">Consultar Factura</a>
                	</div>
                    <i class="material-icons big-icon">unarchive</i>
                </div>
            </div>
        </div>
    <?php if(Yii::app()->user->getRoles()->type == "Administrador"){ ?>
        <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
            <div class="mdl-card mdl-shadow--2dp purple">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Reportes</h2>
                </div>
                <div class="mdl-card__supporting-text">
                	<div>
    	            	<a href="<?=  Yii::app()->baseUrl; ?>/reports">Generar reporte</a>
    	            </div>
                    <i class="material-icons big-icon">poll</i>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp green">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Anular factura</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <h3>#00d45a</h3>
            </div>
        </div>
    </div> -->

    <!-- <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp gray">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Por pagar</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <h3>#444747</h3>
            </div>
        </div>
    </div>


    <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp orange">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Por vencer</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <h3>#ffc107</h3>
            </div>
        </div>
    </div> -->


    <!-- <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp light-blue">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Light blue</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <h3>#03A9F4</h3>
            </div>
        </div>
    </div>

    <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp dark-gray">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Dark gray</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <h3>#333434</h3>
            </div>
        </div>
    </div> -->
</div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        <?php if(Yii::app()->user->getFlash("success") == 'ok' && Yii::app()->user->getFlash("redirect") != ''){ ?>
            actionAlertPrompt("success", "¡Pagado!", "¿Quieres imprimir la factura?", null, "<?= Yii::app()->user->getFlash('print'); ?>");
        <?php }else if(Yii::app()->user->getFlash("success") == 'ok'){ ?>
            actionAlert("¡Factura anulada con éxito!","success");
        <?php } ?>
    });
</script>