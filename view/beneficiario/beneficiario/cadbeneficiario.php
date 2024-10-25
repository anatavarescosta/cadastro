<?php
get_headerLogin();
//session_start();
if(isset($_SESSION['codunimed'])){
    header("Location: ".HOME_URI."/beneficiario");	
    die;
}
?>
<div class="container-fluid login">

	<div class="row">

		<div class="col-12 col-md-6 bloco-form">

			<div class="container form-cadben">
		
				<div class="row" >
					<div class="col-md-12 logo-form mb-3 d-md-none" >
						<img src="<?php echo HOME_URI; ?>/public/images/marca-unimed-recife.png">
					</div>
					<div class="col-md-12 logo-form" >						
						<img src="<?php echo HOME_URI; ?>/public/images/logo_autorizador.png" class="img-fluid" alt="Logo AutorizadorWEB Unimed Recife">
					</div>
				</div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5><b>ATENÇÃO</b></h5>
                        <div class="alert alerta-atencao" role="alert">
                            <p>
                                <b>Beneficiário Intercâmbio</b><br>
                                Não encotramos sua carteira em nosso sistema, Caso tenha certeza que não tem cadastro conosco, preencha o formulário a baixo para se cadastrar.<br>
                                <a href='<?php echo HOME_URI; ?>'>Efetuar login</a>
                            </p>
                        </div>
                    </div>
                </div>

				<div class="row">

					<div class="col-md-12 mb-4">

						<form method="post" name="formCadBene" id="formCadBene" action="<?php echo HOME_URI; ?>/cadbeneficiario/gravar" onsubmit="return validaForm('formCadBene');">		
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-group mt-3">
                                        <input name="codunimed" type="text" class="" id="codunimed" placeholder="Unimed" value="" required onkeypress="return somenteNumeros(event)" maxlength="3">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group mt-3">
                                        <input name="carteira" type="text" class="" id="carteira" placeholder="Carteira" value="" required onkeypress="return somenteNumeros(event)" maxlength="13">
                                    </div>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-md-9">					
                                    <div class="input-group mt-3">
                                        <input name="nome" type="text" class="" id="nome" placeholder="Nome" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group mt-3">
                                        <select name="sexo" id="sexo" required>
                                            <option value="0">Sexo</option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Feminino</option> 
                                        </select>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mt-3">
                                        <input name="dtnascimento" type="text" class="" id="dtnascimento" placeholder="Nascimento (dd-mm-aaaa)" value="" required onkeypress="return somenteNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6">                            
                                    <div class="input-group mt-3">
                                        <select name="acomodacao" id="acomodacao" required>
                                            <option value="0">Acomodação</option>
                                            <option value="1">Apartamento</option>
                                            <option value="2">Enfermaria</option> 
                                        </select>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">					
                                    <div class="input-group mt-3">
                                        <input name="email" type="email" class="" id="email" placeholder="email" value="" required>
                                    </div>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mt-3">
                                        <input name="telFixo" type="text" class="" id="telFixo" placeholder="Tel. Fixo" value="" required onkeypress="return somenteNumeros(event)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mt-3">
                                        <input name="telCel" type="text" class="" id="telCel" placeholder="Tel. Celular" value="" required onkeypress="return somenteNumeros(event)">
                                    </div>
                                </div>
                            </div>
							<div class="input-group mt-3">
								<button type="submit" class="btn btn-primary me-2">Cadastrar</button>
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