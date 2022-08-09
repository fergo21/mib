<?php 
// echo "<pre>";
// print_r();die;
?>
<div class="content-print">
	<div class="section1-print">
		<div class="data-mib">
			<div class="logo">
				<img src="<?php echo Yii::app()->baseUrl; ?>/images/mib_logo.jpg">
				<span>De Ivana Belén Sandoval</span>
			</div>
			<span class="detail">
				Indumentaria Deportiva, Escolar - Uniformes - Diseños - Serigrafía - Bordado Textil
			</span>
			<span class="address">
				Belgrano 775 - Galería Impulso - Local 18 (Planta baja)
				<br>
				B° Centro - 4600 - San Salvador de Jujuy
				<hr>
				IVA RESPONSABLE MONOTRIUTO
			</span>
		</div>
		<div class="ticket-mib">
			<div class="top-ticket">
				<div class="x"> X </div>
				<span>N° <?= $model->idtickets; ?></span>
				<span><?= $model->code; ?></span>
			</div>
			<div class="content-data">
				<div class="data-afip">
					<h2>RECIBO</h2>
					<p>CUIT: 27-35307354-6</p>
					<p>ING. BRUTOS: A-1-62991</p>
					<p>INIC. ACTIV.: 01-09-2018</p>
				</div>
				<div class="date">
					<p>Fecha</p>
					<p class="date-date"><?= Utils::format_date($model->date, 'es'); ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="section2-print">
		<div class="detail-text">
			<strong>Señor(es): </strong> <span><?= $modelTutor->name.' '.$modelTutor->surname ?></span>
		</div>
		<div class="detail-text">
			<strong>Domicilio: </strong> <span><?= $modelStudent->address ?></span>
		</div>
	</div>
	<div class="section3-print">
		<div class="detail-text">
			<strong>Recibí la cantidad de pesos:</strong> <span><?= $model->amount; ?></span>
		</div>
		<div class="detail-text">
			<strong>En concepto de:</strong> <span><?= $model->dues; ?> cuota(s) de <?= $modelOrder->dues ?> - </span>
		</div>

		<ul>
			<?php foreach(json_decode($modelOrder->size) as $product){ 
				echo "<li>". $product->product . "</li>";
			}?> 
		</ul>
		<div class="paid-print">
			<div class="detail-paid">
				<div class="detail-text">
					<strong>Efectivo:</strong> ........................... <span>$ <?= $model->amount; ?></span>
				</div>
				<div class="detail-text">
					<strong>Cheque N°:</strong> ...................................................................
				</div>
				<div class="detail-text">
					<strong>Banco:</strong> .............................. <span>$ </span>
				</div>
			</div>
		</div>
		<div class="total-signature">
			<div class="total-print">
				TOTAL: $ <span class="total"><?= $model->amount; ?></span>
			</div>
			<div class="signature-print">
				<p><strong>Firma:</strong> ..................................................<p>
				<p><strong>Aclaración:</strong> .............................................<p>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		window.print();
		window.onfocus=function(){ window.history.back();}
	});
</script>