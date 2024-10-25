<?php 
	//Para utilizar o modal de forma geral no sistema, essa regra a baixo deve ser aplicada no footer geral
    /*
	global $e;
	global $tipoEvento;
	$index = (isset($_REQUEST['url'])) ? explode('/',$_REQUEST['url']) : ["index"] ;
	if ($index[0] == 'index') {
		if ($tipoEvento == "a"){
			require 'alertamodal.php';
			alertamodal($e,$index[0]);
		}
		return;
	}elseif(($tipoEvento == "exibe")||($tipoEvento == "a")||($tipoEvento == "conf") ){
		require 'alertamodal.php';
        alertamodal($e,$index[0]);
	}
    */
?>	
<?php
global $e;
global $tipoEvento;
global $msg_modal;
global $tipo_modal;
global $titulo_modal;

$msg_modal = "";
if($tipoEvento != ""){
    if ($tipoEvento == "a") {
        $val_get = htmlspecialchars($e, ENT_QUOTES, 'UTF-8');
        switch ($val_get) {   
            case 'es1':
                $msg_modal = "<b>Código gerado com sucesso!</b><br>Verifique o código que chegou no seu <b>e-mail</b>.";
                $tipo_modal = "alert-success";
                $titulo_modal = "SUCESSO";
                break;   
            case 'es2':
                $msg_modal = "<b>Não conseguimos atualizar a senha!</b><br>Verifique o código que chegou no seu <b>e-mail</b> e tente novamete.";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break;  
            case 'es3':
                $msg_modal = "<b>Nova senha cadastrada com sucesso!</b>.";
                $tipo_modal = "alert-success";
                $titulo_modal = "SUCESSO";
                break; 
            case 'es4':
                $msg_modal = "<b>Email não cadastrado!</b> <br>Entre em contato com nosso callcenter (81) 3413.8400 para poder cadastrar.";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break;                                                            
            case 'l1':
                $msg_modal = "<b>Carteirinha ou Senha inválida!<br></b>Verifique as informações e tente novamente.";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break;             
            case 'l2':
            case 'l3':
                $msg_modal = "<b>Acesso não autorizado!<br></b>Efetue o login para ter acesso ao sistema.";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break; 
            case 'l4':
                $msg_modal = "<b>Acesso não autorizado!<br></b>Todas as Autorizações referentes ao Plano Unicol deverão ser realizadas exclusivamente na recepção do Unicol,<br>no Edf. Pedro Stamford, e não mas através dos setores de atendimento local ou centro médico.<br><br>Contamos com seu apoio!<br>Central de Atendimento Unicol: (81)3413-8340";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break;
            case 'l5':
                $msg_modal = "<b>Acesso não autorizado!<br></b>O beneficiário a partir de 01/11/2017 faz parte da Unimed Caruaru. Favor solicitar o código da carteira junta a referida Unimed através do contato (81) 2103-5068!!";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break;
            case 'l6':
                $msg_modal = "<b>Acesso não autorizado!<br></b>No momento não será possível concluir vossa solicitação.<br>Por gentileza, entrar em contato com a Unimed N.NE. pelo canal <a href='https://www.unimednne.com.br/fale-conosco/' target='_blanck'>https://www.unimednne.com.br/fale-conosco/</a>";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break;                                                    
            case 'sp1':
                $msg_modal = "<b>Protocolo Criado com sucesso.<br><br> N° Solicitação:</b> ".$_SESSION["protocolo"]."<br>";
                $tipo_modal = "alert-success";
                $titulo_modal = "SUCESSO";
                break;  
            case 'sp2':
                $msg_modal = "<b>Protocolo Criado com sucesso.<br><br> N° Solicitação:</b> ".$_SESSION["protocolo"]."<br> <b>Nº Prot. Beneficiário:</b> ".$_SESSION["protocoloans"]."<br><br>";
                $tipo_modal = "alert-success";
                $titulo_modal = "SUCESSO";
                break;                                     
            case 'sp3':
            case 'sp4':
                $msg_modal = "<b>Algo deu errado!</b><br>Entre em contato com nosso call center 34138400.";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break; 
            case 'sp5':
                $msg_modal = "<b>Este protocolo já existe em nosso sistema!</b><br> Limpe o cache do navegador e tente novamente.";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break; 
            case 'sp6':
                $msg_modal = "<b>Verifique o tamanho dos arquivos em anexo</b><br> Tamanho máximo permitido é de 2mb.";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break;   
            case 'sp7':
                $msg_modal = "<b>Anexos</b><br>Não identificamos anexos na solicitação, tente novamente.";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break;  
            case 'sp8':
                $msg_modal = "<b>Informações</b><br>Identificamos que existem campos vazios. Por favor, revise as informações e tente novamente.";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break;    
            case 'sp9':
                $msg_modal = "<b>Prezado Beneficiário.</b> <br>Orientamos fazer contato com a Unimed Rio no número de telefone que consta no verso do seu cartão.";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break;                                            
            case 'dc1':
                $msg_modal = "<b>Arquivo enviado com sucesso</b>.";
                $tipo_modal = "alert-success";
                $titulo_modal = "SUCESSO";
                break; 
            case 'ci1':
                $msg_modal = "<b>Cadastro efetuado com sucesso</b><br>Acesse o email cadastrado para verificar sua senha de acesso.";
                $tipo_modal = "alert-success";
                $titulo_modal = "SUCESSO";
                break;  
            case 'ci2':
                $msg_modal = "<b>Carteira já cadastrada</b><br>Caso não esteja conseguindo acessar, tente o esqueci a senha ou entre em contato com nosso calcenter pelo 3413.8400.";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break; 
            case 'ms1':
                $msg_modal = "<b>Senha alterada com sucesso</b>.";
                $tipo_modal = "alert-success";
                $titulo_modal = "SUCESSO";
                break; 
            case 'ms2':
                $msg_modal = "<b>Falha ao trocar a senha</b><br>Tente novamente.";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break;    
                                                     
            default:
                $msg_modal = "Algo não está como esperado, tente novamente em alguns instantes!";
                $tipo_modal = "alert-warning";
                $titulo_modal = "ATENÇÃO";
                break;
        }
    }
}
?>

<?php 
    function alertamodal($ev,$pagina) { 
        global $tipoEvento;
        global $msg_modal;
        global $tipo_modal;
        global $titulo_modal;
?>
    <!-- Modal -->
    <div class="modal fade" id="alertaModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header <?php echo $tipo_modal; ?> alert " role="alert">
                    <h5 class="modal-title" id="ModalLabel"><?php echo $titulo_modal; ?></h5>
                </div>
                <div class="modal-body">
                    <?php echo $msg_modal; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
	<script>
        myModal = new bootstrap.Modal(document.getElementById('alertaModal'), {
            keyboard: true
        })
        myModal.show()
	</script>    
    <script>
        const myModal = document.getElementById('alertaModal');
        myModal.addEventListener('hidden.bs.modal', event => {
            <?php if(($tipoEvento == "exibe") || ($tipoEvento == "a") || ($tipoEvento == "conf")){ ?>
                <?php if($pagina == "index") { ?>
                    window.location.href = "<?php echo HOME_URI;?>/";
                <?php } else { ?>
                    window.location.href = "<?php echo HOME_URI;?>/<?php echo $pagina; ?>/";
                <?php } ?>
            <?php } else { ?>
                window.location.href = "<?php echo HOME_URI;?>/beneficiario";
            <?php } ?>
        })
    </script>    
<?php } ?>