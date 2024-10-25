<?php
require_once "config.php";
require_once ABSPATH.'/functions/global_functions.php';

    global $rota;

    $getUrl = strip_tags(trim(filter_input(INPUT_GET,'url',FILTER_DEFAULT)));
    $setUrl = (empty($getUrl) ? 'index' : $_GET['url'] );
    $rota = explode("/", $setUrl);
    $url = explode("/", $_SERVER['PHP_SELF']);
    
    if($rota[0] != 'public'){
        
        tratarRota($rota);

        // VALIDA SE É ACESSO A INDEX OU ACESSO DIRETAMENTE AO ARQUIVO DE ROTAS
        if((in_array("index", $rota)) && (in_array("rt.php", $url))){
            session_start();
            session_destroy();
            if(!in_array("a",$rota)) {
                if(sizeof($rota) != "1"){
                    $e = $rota[1];
                    header("Location: ".HOME_URI);
                    exit;
                }else{
                    header("Location: ".HOME_URI);
                    exit;
                }
            } else if($rota[0] == "selecao"){
                array_splice($rota, 0,1);
                require $rota[0].".php";
                return;
            }
        }else if(in_array("index", $rota)){
            session_start();
            session_destroy();
            require "index.php";
        }

        // VERIFICA SE EXISTE ALGUM ALERTA NA URL A SER EXIBIDO PELO SCRIPT ALERTAMODAL.PHP
        if((in_array("exibe",$rota)) || (in_array("a",$rota)) || (in_array("conf",$rota))){
            $nivelPasta = sizeof($rota)-2;
            $e = $rota[$nivelPasta+1];
            $tipoEvento = $rota[$nivelPasta];
            array_splice($rota,sizeof($rota)-2);       
        }

        //IDENTIFICA ESTRUTURA DA URL PARA SABER QUAL ARQUIVO CHAMAR
        if(sizeof($rota) == 1){
            chamaArquivo($rota);
        } else {
            if($rota[sizeof($rota)-1] == ""){
                array_splice($rota, sizeof($rota)-1,1);
            }
            $link = chamaArquivo($rota);
        }
    }

    // FUNÇÃO PARA CHAMAR O ARQUIVO REFERENTE A PÁGINA SOLICITADA
    function chamaArquivo($rt){
        session_start();

        $caminho = "/";

        $linkTeste = "";
        foreach ($rt as $key => $value) {
            $linkTeste .= $caminho . $value;
        }
        switch ($linkTeste) {
            case '/esqueciasenha': 
                require_once "controller/Senha/ControllerSenha.php";
                $paginaAtual = new ControllerSenha();
                $paginaAtual->esqueciasenha();
                die;
                break;
            case '/trocarsenha': 
                require_once "controller/Senha/ControllerSenha.php";
                $paginaAtual = new ControllerSenha();
                $paginaAtual->trocarsenha();
                die;
                break;
            case '/mudarsenha': 
                require_once "controller/Senha/ControllerSenha.php";
                $paginaAtual = new ControllerSenha();
                $paginaAtual->mudarsenha();
                die;
                break;
            case '/mudarsenha/gravar': 
                require_once "controller/Senha/ControllerSenha.php";
                $paginaAtual = new ControllerSenha();
                $paginaAtual->gravarsenha();
                die;
                break;                
            case '/loginapp': 
                require_once "controller/Loginapp/ControllerLoginapp.php";
                $paginaAtual = new ControllerLoginApp();
                die;
                break;             
            case '/acesso': 
                require_once "controller/Acesso/ControllerAcesso.php";
                $paginaAtual = new ControllerAcesso();
                die;
                break;  
            case '/': 
            case '/index': 
                require_once "controller/Login/ControllerLogin.php";
                $paginaAtual = new ControllerLogin();
                die;
                break;                  
            case '/beneficiario':
                require_once "controller/Beneficiario/ControllerBeneficiario.php";
                $paginaAtual = new ControllerBeneficiario();   
                die;
                break; 
            case '/beneficiario/solicitacao':
                require_once "controller/Beneficiario/ControllerSolicitacao.php";
                $paginaAtual = new ControllerSolicitacao();   
                die;
                break;      
            case '/beneficiario/acompanhamento':
                require_once "controller/Beneficiario/ControllerAcompanhamento.php";
                $paginaAtual = new ControllerAcompanhamento(); 
                $paginaAtual->acompanhamento();  
                die;
                break;  
            case '/beneficiario/acompanhamento/protocoloautorizacao':
                require_once "controller/Beneficiario/ControllerAcompanhamento.php";
                $paginaAtual = new ControllerAcompanhamento();   
                $paginaAtual->protocoloautorizacao();
                die;
                break;  
            case '/beneficiario/acompanhamento/protocolobeneficiario':
                require_once "controller/Beneficiario/ControllerAcompanhamento.php";
                $paginaAtual = new ControllerAcompanhamento();   
                $paginaAtual->protocolobeneficiario();
                die;
                break;                                                                         
            case '/beneficiario/complementar':
                require_once "controller/Beneficiario/ControllerComplementar.php";
                $paginaAtual = new ControllerComplementar();   
                die;
                break;                 
            case '/beneficiario/complementar/anexosacompanhamento':
                require_once "view/beneficiario/complementar/anexosacompanhamento.php";
                die;
                break;            
            case '/beneficiario/reembolso': 
                require_once "controller/Beneficiario/ControllerGerarReembolso.php";
                $paginaAtual = new ControllerReembolso();
                die;
                break;            
            case '/beneficiario/reembolso/reembolsodoc': 
                require_once "controller/Beneficiario/ControllerReembolsoDoc.php";
                $paginaAtual = new ControllerReembolsoDoc();
                die;
                break;
            case '/beneficiario/acompanharreembolso': 
                require_once "controller/Beneficiario/ControllerAcompanharReembolso.php";
                $paginaAtual = new ControllerAcompanharReembolso();
                die;
                break;   
            case '/logoff': 
                require_once "controller/Logoff/ControllerLogoff.php";
                $paginaAtual = new ControllerLogoff();
                die;
                break;  
            case '/cadbeneficiario': 
                require_once "controller/Beneficiario/ControllerCadbeneficiario.php";
                $paginaAtual = new ControllerCadbeneficiario();
                $paginaAtual->view();
                die;
                break;                                               
            case '/cadbeneficiario/gravar': 
                require_once "controller/Beneficiario/ControllerCadbeneficiario.php";
                $paginaAtual = new ControllerCadbeneficiario();
                $paginaAtual->gravar();
                die;
                break; 
            case '/beneficiario/acompanhamento/listartodosprotocolosautorizacao':   
                require_once "view/beneficiario/acompanhamento/listartodosprotocolosautorizacao.php";                                                           
                break;
            case '/beneficiario/acompanhamento/listartodosprotocolosbeneficiario':   
                require_once "view/beneficiario/acompanhamento/listartodosprotocolosbeneficiario.php";                                                           
                break;  
            case '/beneficiario/acompanhamento/mostrarlistatodosprotocolosbeneficiario':   
                require_once "view/beneficiario/acompanhamento/mostrarlistatodosprotocolosbeneficiario.php";                                                           
                break;                 
            case '/beneficiario/acompanhamento/listartodosprotocolos':   
                require_once "view/beneficiario/acompanhamento/listartodosprotocolos.php";                                                           
                break;
            case '/beneficiario/acompanhamento/linhadotempo/'.$rt[3]:   
                $_SESSION['protocolo'] = $rt[3];
                require_once "view/beneficiario/acompanhamento/linhadotempo.php";                                                           
                break;     
            case '/beneficiario/acompanhamento/linhadotempobeneficiario/'.$rt[3]:   
                $_SESSION['protocolo'] = $rt[3];
                require_once "view/beneficiario/acompanhamento/linhadotempobeneficiario.php";                                                           
                break;                   
            case '/beneficiario/acompanhamento/listartodosanexosprotocolos/'.$rt[3]:   
                $_SESSION['protocolo'] = $rt[3];
                require_once "view/beneficiario/acompanhamento/listartodosanexosprotocolos.php";                                                           
                break;      
            case '/beneficiario/acompanhamento/mudareditorimagem/'.$rt[3]:   
                $_SESSION['url'] = $rt[3];
                require_once "view/beneficiario/acompanhamento/mudareditorimagem.php";                                                           
                break;                                                  
            case '/beneficiario/complementar/view/beneficiario/complementar/listartodoscomplementarindex':
                break; 
            case '/beneficiario/view/beneficiario/reembolso/gravarconversa':
                break;         
            case '/beneficiario/view/beneficiario/acompanhamento/removearquivo':
                break;  
            case '/beneficiario/acompanhamento/listaorientacoesbeneficiario/'.$rt[3]."/".$rt[4]:
                $_SESSION['protocolo'] = $rt[3];             
                $_SESSION['idProtHistoricoANS'] = $rt[4];
                require_once "view/beneficiario/acompanhamento/listaorientacoesbeneficiario.php"; 
                break;                               
            case '/beneficiario/acompanhamento/listaorientacoes/'.$rt[3]."/".$rt[4]:   
                $_SESSION['protocolo'] = $rt[3];
                $_SESSION['status'] = $rt[4];
                require_once "view/beneficiario/acompanhamento/listaorientacoes.php";                                                           
                break; 
                
            default:
                header("Location: ".HOME_URI);
                break;
        }
    }

    function tratarRota($rtTemp){
        global $rota;

        $pgTemp = $rtTemp[sizeof($rtTemp)-1];
        
        if (substr($pgTemp, -4) == ".php"){
            $pg = explode(".",$pgTemp);
            $rota[sizeof($rota)-1] = $pg[0];
        }
        
    }
    
?>