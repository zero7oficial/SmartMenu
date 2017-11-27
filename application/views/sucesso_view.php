							
							<?php echo $mensagem; ?>
							<form method="POST"  action="<?php echo base_url(); ?>index.php/inicio/sucRedirect">
							
								<input name="userid" class="hidden" value="<?php echo $checando[0]->ID; ?>" />
								<button type="submit" class="btn btn-lg btn-pizza">OK</button>
							</form>