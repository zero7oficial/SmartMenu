<section id="comanda">
	<div class="container center-block">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-xs-7 center-block">
				
					<table class="table">						
						<tr>
							<td>MESA</td>
							<td>PEDIDO</td>
							<td>VALOR</td>
						</tr>
						<?php foreach ($pedidos as $ped) { ?>
						<tr>
							<td><?php echo $ped->mesa_id ?></td>
							<td><?php echo $ped->titpizza  ?></td>
							<td>R$ 
							<?php
							$this->load->helper("funcoes"); 
							$valor = $ped->precPizza;

							echo formata_preco($valor);

							?></td>
						</tr>
						<?php } ?>
					</table>
				</div>
				<div class="col-xs-5">
					Informações Gerais
				</div>
			</div>
		</div>
	</div>
</section>