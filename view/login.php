<?php
get_headerLogin();
?>
<div class="container-fluid login">

	<div class="row">

		<div class="col-12 col-md-6 bloco-form">

			<div class="container form-login">
				
				<div class="row" >
					<div class="col-md-12 logo-form mb-3 d-md-none" >
						<img src="<?php echo HOME_URI; ?>/public/images/marca-unimed-recife.png">
					</div>
					<div class="col-md-12 logo-form" >						
						<img src="<?php echo HOME_URI; ?>/public/images/logo_autorizador.png" class="img-fluid" alt="Logo AutorizadorWEB Unimed Recife">
					</div>
				</div>

				<div class="row mt-4">

					<div class="col-md-12 mb-4">
						<!--<form method="post" name="form" id="form" action="controller/Acesso/ContollerAcesso.php" class="">-->
						<form method="post" name="form" id="form" action="<?php echo HOME_URI; ?>/acesso" class="">							
							<div class="input-group mt-3">
								<input name="login" type="text" class="" id="login" placeholder="Carteirinha" value="" required onKeyPress="mascara(this, '###.####.######.##-#');">
							</div>
							<div class="input-group mt-3">
								<input name="senha" type="password" class="" id="senha" placeholder="Senha" value="" required>
							</div>
							<div class="input-group mt-3">
								<p>
									<a href="#!" class="esqueci-senha" onclick="esqueciSenha()">Esqueci a senha!</a>
								</p>
							</div>							
							<div class="input-group mt-3">
								<button type="submit" class="btn btn-primary me-2">Acessar</button>
							</div>
						</form>
						<form name="frm_senha" id="frm_senha"  method="post" action="<?php echo HOME_URI."/esqueciasenha/a/es1"?>">
							<input type="hidden" id="carteira" name="carteira" value="">			
						</form>
						
					</div>

				</div>

			</div>

		</div>

	</div>

</div>
<?php
get_footerLogin();
?>