<?php
/* @var $this TicketsController */
/* @var $model Tickets */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('#tickets-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

// echo "<pre>";
// print_r(Utils::searchTickets());die;
?>
<style type="text/css">
	.mdl-data-table.bordered-table tr :not(span):last-child {
		border-right: 1px solid;
	}
</style>
<div class="mdl-grid ui-tables">
	<div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--6-col-phone form__article mib-table">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title mib-table--title">
                <h1 class="mdl-card__title-text table">Cuentas</h1>
            </div>
            <div class="mdl-card__supporting-text no-padding">
				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'tickets-grid',
					'itemsCssClass' => 'mdl-data-table mdl-js-data-table stripped-table',
					'dataProvider'=>$model->search(),
					'columns'=>array(
						array(
							'header'=>'#',
							'sortable'=>false,
							'type'=>'raw',
							'value'=>'$data->idtutores'
						),
						array(
							'header'=>'Tutores',
							'type'=>'raw',
							'value'=>'$data->name." ".$data->surname',
							'sortable'=>false
						),
						array(
							'name'=>'ci',
							'sortable'=>false
						),
						array(
							'header' => 'Cuentas',
							'class'=>'ButtonColumn', //esta clase se encuentra en components (es personalizada)
							'template'=>'{view}',
							'evaluateID'=>true, // esta opcion va si o si cuando se usa ButtonColumn
							'buttons'=>array(
								'view' => array(
									'label'=>'<i class="material-icons">recent_actors</i>',
									'imageUrl'=>false,
									'url'=>'Yii::app()->createUrl("tickets/getaccounts/$data->idtutores")',
									'options'=>array('title'=>'Ver facturas'),
									'visible'=>'$data->idtutores',
									'click' => 'function(e){
										e.preventDefault();
										let url = this.href;
										let ticketsAccount = this.parentNode.parentNode.children[1].innerHTML;
										$.ajax({
											url: url,
											dataType: "json",
											type: "GET"
										})
										.done(function(data){
											if(data.length > 0){

												
												let buttons = "";
												let tr = renderAccount(data);
												
												let tableHTML = `<div class="mdl-card mdl-shadow--2dp">
										            <div class="mdl-card__title">
										                <h1 class="mdl-card__title-text">Facturación de ${ticketsAccount}</h1>
										            </div>
										            <div class="mdl-card__supporting-text no-padding">
										                <table class="mdl-data-table mdl-js-data-table bordered-table">
										                    <thead>
										                    <tr>
										                        <th class="mdl-data-table__cell--non-numeric">#</th>
										                        <th class="mdl-data-table__cell--non-numeric">Estudiantes</th>
										                        <th class="mdl-data-table__cell--non-numeric" style="width:20%;">Facturas</th>
										                    </tr>
										                    </thead>
										                    <tbody>${tr}</tbody>
										                </table>
										            </div>
										        </div>`;
												document.querySelector("#data_account").innerHTML = tableHTML;
												document.querySelector("#data_account").style.display = "block";
											}
										})
										.fail(function(err){
											console.log(err);
										});
									}'
								),
							),
						),
					),
				)); ?>
			</div>
        </div>
	</div>
	<div id="data_account" style="display:none; height: fit-content;" class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--6-col-phone form__article">
	</div>
</div>

<div class="mib-background-modal"></div>
<div class="mdl-dialog">
	<div class="mdl-dialog__content">
		<div class="mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title">
		        <h5 class="mdl-card__title-text">Factura</h5>
		    </div>
			<div class="mdl-card__supporting-text">
				<div id="fill-data-ticket"></div>
				<div class="row buttons">
					<a class="btn btn-default buttonAction close" style="cursor:pointer;">Cerrar</a>
					<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-orange center print" target="_blank">Imprimir</a>
					<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-red center cancel">Anular</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		<?php if(Yii::app()->user->getFlash("success") == 'ok'){ ?>
            actionAlert("¡Factura anulada con éxito!","success");
        <?php } ?>
    });
	const renderTicket = (id) => {
        let url = `${homeUrl}/tickets/getticket/${id}`;
        $.ajax({
            url: url,
            type: "GET"
        })
        .done(function(data){
            let response = JSON.parse(data);
            if(response.hasOwnProperty('idtickets')){
                $("#fill-data-ticket").html(`
                    <strong>Nombre y Apellido: </strong>${response.fullname}</br>
                    <strong>Pedido N°: </strong>${response.idorders}</br>
                    <strong>Fecha de pago: </strong>${new Date(response.date).toLocaleDateString()}</br>
                    <strong>Total: </strong>$ ${response.amount}</br>
                    <strong>Forma de pago: </strong>${response.form_of_payment}</br>
                    <strong>Cuota(s) N°: </strong>${response.dues}</br>
                    <strong>Pagado: </strong>$ ${response.paid}</br>
                    <strong>Saldo: </strong>${response.saldo !== null ? '$ '+response.saldo : ''}</br>
                    <strong>Descripción: </strong>${response.description}</br>
                    <strong>Cobrado por: </strong>${response.user}</br>
                `);
                $(".print").attr('href', `${homeUrl}/tickets/print/${response.idtickets}`);
                $(".cancel").attr('href', `${homeUrl}/tickets/cancel/${response.idtickets}`);
                $(".mib-background-modal").show();
                $(".mdl-dialog").show();
            }
        })
        .fail(function(err){
            console.log(err);
        })
	}
	const renderAccount = (data) => {
		let tr = "";
		for(let i = 0; i < data.length; i++){
			tr += `<tr>
				<td class="mdl-data-table__cell--non-numeric">${data[i].idstudents}</td>
				<td class="mdl-data-table__cell--non-numeric">${data[i].fullname}</td>
				<td class="button-column ticket-column">`;
					for(let t = 0; t < data[i].tickets.length; t++){
						let color = data[i].tickets[t].canceled === "1" ? "#f44336" : "#00d45a";

						tr += `<a class="view ticket-view" style="color:${color};  " href="#" title="Factura N° ${data[i].tickets[t].idtickets}" onclick="renderTicket(${data[i].tickets[t].idtickets})">
							<span>FN° ${data[i].tickets[t].idtickets}</span>
							</a>`;
					}
			tr += `</td></tr>`;
		}
		return tr;
	}
</script>