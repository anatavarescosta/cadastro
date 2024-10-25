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
						<form method="post" name="form" id="form" action="<?php echo HOME_URI; ?>/trocarsenha" class="" onSubmit="return trocarSenha();">
							<input name="carteira" type="hidden" class="" id="carteira" value="<?php echo $_SESSION["carteira"];?>">
							<div class="input-group mt-3">
								<input name="codEmail" type="text" class="" id="codEmail" placeholder="Código do email" value="" required>
							</div>
							<div class="input-group mt-3">
								<input name="senha" type="password" class="" id="senha" placeholder="Senha" value="" required>
							</div>
							<div class="input-group mt-3">
								<button type="submit" class="btn btn-primary me-2">Trocar a senha</button>
							</div>
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