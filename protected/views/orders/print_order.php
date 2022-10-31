<div class="print-container">
	<div class="print-header-info">
		<img src="<?= Yii::app()->baseUrl ?>/images/mib_logo.jpg"/>
		<h1 class="print-header-title">Siempre <span>Juntos</span> a los egresados</h1>
		<p class="print-header-description">Diseñá, imaginá...Te lo hacemos realidad...</p>
	</div>
	<div class="print-body-info">
		<ul>
			<?php if(isset($data['student'])){ ?>
				<li>
					<strong>Estudiante:</strong>
					<p><?= $data['student']; ?></p>
				</li>
			<?php } ?>
			<?php if(isset($data['school-name'])) { ?>
				<li>
					<strong>Colegio:</strong>
					<p><?= $data['school-name']; ?></p>
				</li>
			<?php } ?> 
			<?php if(isset($data['promo'])) { ?>
				<li>
					<strong>Colegio:</strong>
					<p><?= $data['promo']['school']; ?></p>
				</li>
			<?php } ?> 
			<?php if(isset($data['promo'])){ ?>
				<li>
					<strong>Promo:</strong>
					<p><?= $data['promo']['year'].$data['promo']['division'].' - Turno: '.$data['promo']['shift'].' - Promo: '.$data['promo']['year_promo']; ?></p>
					<img src="<?= $data['promo']['image_promo']; ?>" width="150">
				</li>
			<?php } ?>
			<li>
				<strong>Combo:</strong>
				<ul>
					<?php foreach(json_decode($data['size']) as $value){ ?>
						<li><p><?= $value->quantity; ?> <?= $value->product; ?> <?php if(!$isPresupuesto){ ?> - Talle: <?= $value->talles; ?> <?php } ?> </p></li>
					<?php } ?>
				</ul>
			</li>
			<li>
				<strong><?= isset($data['total_per_due']) ? 'Oferta' : 'Pedido'; ?>:</strong>
				<p>Total: $<?= $data['total_amount']; ?></p>
				<?php if(isset($data['total_per_due'])) { ?>
					<?php foreach($data['total_per_due'] as $i => $due) { ?>
						<p>
							<?= $i+1; ?> 
							<?= $i === 0 ? "pago" : "cuotas" ?> 
							<?= ($i < 3 && $i !== 0) ? 'sin interés' : ''; ?> 
							de 
							$<?= $due; ?>
						</p>
					<?php } 
				}else { ?>
					<p>
						<?= $data['dues']; ?> 
						<?= intval($data['dues']) === 1 ? 'pago' : 'cuotas'; ?> 
						<?= (intval($data['dues']) <= 3 && intval($data['dues']) !== 0) ? 'sin interés' : ''; ?> 
						de 
						$<?= $data['total_due']; ?></p>
				<?php } ?>
			</li>
		</ul>
	</div>
	<p class="print-footer-signature">Firma:.....................................</p>
</div>