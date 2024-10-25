<?php 
if (!isset($_SESSION['nome'])){
	session_start(); 
}
?>
<!-- MENU -->
<div id="main" class="container"></div>
<nav class="main navbar navbar-expand-sm m-0 p-0">
	<div class="container-fluid">
		<a href="<?php echo HOME_URI ?>/beneficiario" class="navbar-brand mb-0" title="<?php echo NOMESISTEMA; ?> - Unimed Recife"><div class="img-marca">&nbsp;</div></a>
		<button class="navbar-toggler" type="button" onclick="Menu()">
            <span class="navbar-toggler-icon"></span>
        </button>
		<div class="collapse navbar-collapse">
			<ul class="dropdown-mn navbar-nav me-auto mb-2 mb-lg-0">
				<li>
					<a href="#!" onclick="Menu()" title="Menu Lateral">
						<span class=" align-bottom material-symbols-outlined">menu</span> MENU
					</a>
					<input type="hidden" name="menu" id="menu" value="">
				</li>				
				<li>
					<a href="<?php echo HOME_URI ?>/beneficiario/" title="Página inicial"> Início</a>				
				</li>
				<li>
					<a href="#!" title="Menu de Solicitação">Solicitação</a>
					<ul>
						<li class="item-menu">
							<a href="<?php echo bloqueioSolicitacao() ? HOME_URI."/beneficiario/a/sp9" : HOME_URI."/beneficiario/solicitacao" ;?>" class="subitem" title="Solicitar Autorização">Solicitar Autorização</a>
							<a href="<?php echo HOME_URI ?>/beneficiario/acompanhamento" class="subitem" title="Acompanhar Solicitação">Acompanhar Solicitação</a>
							<a href="<?php echo HOME_URI ?>/beneficiario/complementar" class="subitem" title="Documentos Complementares">Documentos Complementares</a>
						</li>	
					</ul>					
				</li>
				<li>
					<a href="#!" title="Menu de Reembolso">Reembolso</a>
					<ul>
						<li class="item-menu">
							<!--a href="<?php // echo HOME_URI ?>/beneficiario/reembolso" class="subitem">Solicitar Reembolso</a-->
							<a href="<?php echo HOME_URI ?>/beneficiario/acompanharreembolso" class="subitem" title="Acompanhar Reembolso">Acompanhar Reembolso</a>
						</li>	
					</ul>					
				</li>
				<li>
					<a href="#!" title="Menu de Reembolso">Perfil</a>
					<ul>
						<li class="item-menu">
							<!--a href="<?php // echo HOME_URI ?>/beneficiario/reembolso" class="subitem">Solicitar Reembolso</a-->
							<a href="<?php echo HOME_URI ?>/mudarsenha" class="subitem" title="Acompanhar Reembolso">Mudar a Senha</a>
						</li>	
					</ul>					
				</li>													
			</ul>			
		</div>		
	</div>
</nav>   

<div class="container-fluid mb-4">
	<div class="row bem-vindo">
		<div class="col-md-12">
			<b>Olá: </b><?php if (isset($_SESSION['nome'])){ echo $_SESSION['nome']; }?> - <a href="<?php if (isset($logoff)){ echo $logoff; } else { echo HOME_URI.'/logoff/'; }?>" title="Sair do Sistema">Sair</a>
		</div>
	</div>
</div>

<div id="navLateral" class="sidebar">
	<a href="javascript:void(0)" class="closebtn" onclick="Menu()">
		<span class=" align-bottom material-symbols-outlined">
			close
		</span>
	</a>
	<ul class="itens-menu navbar-nav nav-sidebar">
		<li>
			<a class="nav-item" href="<?php echo HOME_URI ?>/beneficiario/" title="Página inicial">Início</a>
		</li>		
		<li>
			<a class="nav-item" href="#">Solicitação</a>
			<div class="sub-menu">
				<a href="<?php echo HOME_URI ?>/beneficiario/solicitacao" title="Solicitar Autorização">Solicitar Autorização</a>
				<a href="<?php echo HOME_URI ?>/beneficiario/acompanhamento" title="Acompanhar Solicitação">Acompanhar Solicitação</a>
				<a href="<?php echo HOME_URI ?>/beneficiario/complementar" title="Documentos Complementares">Documentos Complementares</a>
			</div>
		</li>
		<li>
			<a class="nav-item" href="#">Reembolso</a>
			<div class="sub-menu">
				<!--a href="#">Solicitar Reembolso</a-->
				<a href="<?php echo HOME_URI ?>/beneficiario/acompanharreembolso" title="Acompanhar Reembolso">Acompanhar Reembolso</a>
			</div>
		</li>
		<li>
			<a class="nav-item" href="#">Perfil</a>
			<div class="sub-menu">
				<!--a href="#">Solicitar Reembolso</a-->
				<a href="<?php echo HOME_URI ?>/mudarsenha" title="Acompanhar Reembolso">Mudar a Senha</a>
			</div>
		</li>
	</ul>
</div>
<!-- MENU -->

