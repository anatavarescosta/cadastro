<?php 
get_header();
?>
<div class="container mb-4">
	
	<div class="row mt-2">
		<div class="col-md-12">
			<h5>ACESSO RÁPIDO</h5>
			<div class="row">

				<div class="col-6 col-md-3 verdeb text-white blocoAcessoRapido" title="Solicitar Autorização">
					<div class="row">
						<div class="col-md-3 d-none d-sm-block">
							<span class=" align-bottom material-symbols-outlined iconeAcessoRapido">
								lab_profile
							</span>
						</div>
						<div class="col-md-9">					
							<h4 class="tituloAcessoRapido">
								<b>
									<a href="<?php echo HOME_URI."/beneficiario/acompanhamento/protocoloautorizacao"; ?>">Protocolo de Autorização</a>
								</b>
							</h4>
						</div>
					</div>				
				</div>

				<div class="col-6 col-md-3 petroleo text-white blocoAcessoRapido" title="Acompanhar Solicitação">
					<div class="row">
						<div class="col-md-3 d-none d-sm-block">
							<span class=" align-bottom material-symbols-outlined iconeAcessoRapido">
								manage_search
							</span>
						</div>
						<div class="col-md-9">					
							<h4 class="tituloAcessoRapido">
								<b>
									<a href="<?php echo HOME_URI."/beneficiario/acompanhamento/protocolobeneficiario";?>">Protocolo do Beneficiário</a>
								</b>
							</h4>
						</div>
					</div>	
				</div>

			</div>
		</div>
	</div>

</div>

<?php get_footer(); ?>