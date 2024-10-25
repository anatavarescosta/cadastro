<?php 
get_header();
 
require_once(ABSPATH."/model/banco.php");
$dados = new Banco(); 

$carteira 	= $_SESSION["carteira"];
$codunimed	= $_SESSION["codunimed"];

$att = 0;
$totalcomplementar = $dados->getMostrarTotalProtocolosComplementar($codunimed,$carteira);
if($totalcomplementar > 0){
	$rscomplementar = $dados->getListarTotalProtocolosComplementar($codunimed,$carteira);
	$complementar = "O protocolo de número: <b>".$rscomplementar[1]."</b> requer sua atenção. ";
	$att = 1;
}else{
	$complementar = "<b>Não há protocolo com documentação pendente.</b>";
}
?>
<div class="container mb-4">

	<div class="row mt-2">
		<div class="col-md-12">
			<h5><b>INFORMATIVO:</b></h5>
			<div class="alert alerta-informativo" role="alert">
				<p class="m-0">
					<b>FIQUE DE OLHO NAS SUAS AUTORIZAÇÕES</b>,<br>
					Cliente Unimed Recife, agora você pode acompanhar através do aplicativo Unimed Recife, todas as autorizações de consultas, exames e procedimentos. Para habilitar esta função, vá nas configurações do seu celular e atualize o APP Unimed Recife ou, caso ainda não tenha instalado o aplicativo, <a href="http://onelink.to/ufkqc4">baixe agora</a> e dê a autorização para notificações quando for solicitada.

					Fique de olho e acompanhe de perto tudo o que é autorizado no seu plano e saiba quando suas solicitações de autorização forem liberadas com mais agilidade, na palma da sua mão.
					<br>
					<br>
					* Os REEMBOLSOS devem ser solicitados presencialmente, em uma das unidades administrativas da Unimed Recife, e podem ser acompanhados pelo APP.<br>
					* <a href="<?php echo HOME_URI.'/includes/downloads/Formulario_de_analise_preliminar_de_Solicitacao_de_Reembolso.pdf';?>" target="_blank" target="_blank" >Confira aqui</a> as documentações necessárias para solicitação de reembolso.
				</p>
			</div>
		</div>
	</div>	
	<?php if($att == 1){ ?>
	<div class="row mt-2">
		<div class="col-md-12">
			<h5><b>ATENÇÃO</b></h5>
			<div class="alert alerta-atencao" role="alert">
				<form action='<?php echo HOME_URI."/beneficiario/complementar"; ?>' method='POST'>
					<input type='hidden' name='protocolo' id='protocolo' value='<?php echo $rscomplementar[1]; ?>' />
					<button class='linkDocComPrincipal'><?php echo $complementar;?></button>
				</form>	
			</div>
		</div>
	</div>
	<?php } ?>
	
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
									<a href="<?php echo bloqueioSolicitacao() ? HOME_URI."/beneficiario/a/sp9" : HOME_URI."/beneficiario/solicitacao" ;?>">Solicitar Autorização</a>
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
									<a href="<?php echo HOME_URI."/beneficiario/acompanhamento";?>">Acompanhar Solicitação</a>
								</b>
							</h4>
						</div>
					</div>	
				</div>

				<div class="col-6 col-md-3 petroleo text-white blocoAcessoRapido" title="Documento Complementar">
					<div class="row">
						<div class="col-md-3 d-none d-sm-block">
							<span class=" align-bottom material-symbols-outlined iconeAcessoRapido">
								add_notes
							</span>
						</div>
						<div class="col-md-9">					
							<h4 class="tituloAcessoRapido">
								<b>
									<a href="<?php echo HOME_URI."/beneficiario/complementar";?>">Documento Complementar</a>
								</b>
							</h4>
						</div>
					</div>	
				</div>				

				<div class="col-6 col-md-3 petroleo text-white blocoAcessoRapido" title="Acompanhar Reembolso">
					<div class="row">
						<div class="col-md-3 d-none d-sm-block">
							<span class=" align-bottom material-symbols-outlined iconeAcessoRapido">
								currency_exchange
							</span>
						</div>
						<div class="col-md-9">					
							<h4 class="tituloAcessoRapido">
								<b>
									<a href="<?php echo HOME_URI."/beneficiario/acompanharreembolso";?>">Acompanhar Reembolso</a>
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