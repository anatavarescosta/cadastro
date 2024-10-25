// VALIDAÇÃO DOS FORMULÁRIOS
function validaForm(tipoForm){
    if(tipoForm == "formCadBene"){
        ef = 0;   
        codunimed = $("#codunimed").val()
        if (codunimed.length != 3){ 
            valida_addBorda("codunimed");
            ef = 1;
        } else {
            valida_remBorda("codunimed");
        }

        carteira = $("#carteira").val()
        if (carteira.length != 13){ 
            valida_addBorda("carteira");
            ef = 1;
        } else {
            valida_remBorda("carteira");
        }

        if ($("#sexo").val() == "0"){ 
            valida_addBorda("sexo");
            ef = 1;
        } else {
            valida_remBorda("sexo");
        }

        if ($("#acomodacao").val() == "0"){ 
            valida_addBorda("acomodacao");
            ef = 1;
        } else {
            valida_remBorda("acomodacao");
        }

        if(ef == 0){
            return true;
        } else {
            return false;
        }        
    }

    if(tipoForm == "formSolBene"){
        ef = 0;
        /* Contato */
        /*
        if ($("#email").val() == ""){ 
            valida_addBorda("email");
            ef = 1;
        } else {
            valida_remBorda("email");
        }
        */

        if ($("#telFixo").val() == ""){ 
            valida_addBorda("telFixo");
            ef = 1;
        } else {
            valida_remBorda("telFixo");
        }

        if ($("#telCel").val() == ""){ 
            valida_addBorda("telCel");
            ef = 1;
        } else {
            valida_remBorda("telCel");
        }  

        /* Cooperado */
        if ($("#crm").val() == ""){ 
            valida_addBorda("crm");
            ef = 1;
        } else {
            valida_remBorda("crm");
        }

        if ($("#nomeMed").val() == ""){ 
            valida_addBorda("nomeMed");
            ef = 1;
        } else {
            valida_remBorda("nomeMed");
        }

        if ($("#espMed").val() == "0"){ 
            valida_addBorda("espMed");
            ef = 1;
        } else {
            valida_remBorda("espMed");
        }  

        /* Tipo Tratamento */
        if ($("#tipoTratamento").val() == "0_0"){ 
            valida_addBorda("tipoTratamento");
            ef = 1;
        } else {
			if (document.getElementById('listaDocs').innerHTML != ""){		   
			    var docs = document.formSolBene.totalitensdocumento.value;	
			    if (docs > 0){
				    var arraydocs = 0;				   
                    var vTeste = 0;
                    var totalArquivos = 0;
				    for(f=1;f<=docs;f++){
						var itens = eval('document.formSolBene.totaldocumento'+f);	
                        totalArquivos = totalArquivos + parseInt(itens.value);
						if (itens.value > 0){
							for(i=1;i<=itens.value;i++){
								arraydocs = arraydocs + 1;
								//var id = document.getElementById('meuId'+f+i);	
								//if(id.style.display != 'none'){
									var arquivo = eval('document.formSolBene.arquivo'+f+i);	
                                    if (typeof arquivo === 'undefined') {
                                        vTeste++;
                                    } else {
                                        if (arquivo.value == ""){	
                                            //alert('Insira um arquivo no item '+f+"."+i);
                                            ef = 1;
                                        }
                                    }
								//}
							}
						}
				    }
                    if(vTeste == totalArquivos){
                        valida_addBorda("tipoTratamento"); 
                        ef = 1;
                    }else{
                        valida_remBorda("tipoTratamento");   
                    }

				    if (arraydocs == 0){
					   	alert('Existem arquivos para serem anexados');
						ef = 1;  
				    }
				}
		   }else{
				valida_remBorda("tipoTratamento");   
		   }
        } 

        $("input[type='file']").each(function(index, element){
            let idFile = $(element).attr('id');
            var count = $('[id="'+idFile+'"]').length;
            if($(element).val() == '') {    
                for (let index = 1; index <= count; index++) {
                    valida_addBorda(idFile);    
                }
                ef = 1;
            } else {
                valida_remBorda(idFile);
            }
        });
        
        if (document.getElementById('hospital').style.display != "none"){
			if($("#strHospital").val() == "0"){ 
            	valida_addBorda("strHospital");
            	ef = 1;
			}else{
				valida_remBorda("strHospital");
			}
        } else {
            valida_remBorda("strHospital");
        }

        if (document.getElementById('mostrarprorrogacao').style.display != "none"){ 
			if($("#documento").val() == "0"){
				valida_addBorda("documento");
				ef = 1;
			}else{
				valida_remBorda("documento");	
			}
        } else {
            valida_remBorda("documento");
        }

        if (document.getElementById('pacientemedicadoonc').style.display != "none"){ 
			if($("#pacientemedicado").val() == "0"){
            	valida_addBorda("pacientemedicado");
            	ef = 1;
			}else{
				valida_remBorda("pacientemedicado");	
			}
        } else {
            valida_remBorda("pacientemedicado");
        }

        if (document.getElementById('tea').style.display != "none"){ 
			if($("#tipotea").val() == "0"){
            	valida_addBorda("tipotea");
            	ef = 1;
			}else{
				valida_remBorda("tipotea");	
			}
        } else {
            valida_remBorda("tipotea");
        }

        if (document.getElementById('tipostratamento').style.display != "none"){ 
            if ($("#serarealizado").val() == "0"){
				valida_addBorda("serarealizado");
            	ef = 1;
			}else{
				valida_remBorda("serarealizado");
			}
        } else {
            valida_remBorda("serarealizado");
        }

        /* Localidade */        
        if ($("#estadoTratamento").val() == "0"){ 
            valida_addBorda("estadoTratamento");
            ef = 1;
        } else {
            valida_remBorda("estadoTratamento");
        }

        if ($("#municipioTratamento").val() == "0"){ 
            valida_addBorda("municipioTratamento");
            ef = 1;
        } else {
            valida_remBorda("municipioTratamento");
        }

        if($("#localatendimento").val() == "0"){
            valida_addBorda("localatendimento");
			 ef = 1;
        } else{
            valida_remBorda("localatendimento");
            if($("#localatendimento").val() == "N"){
                if ($("#estadoResidencia").val() == "0"){ 
                    valida_addBorda("estadoResidencia");
                    ef = 1;
                } else {
                    valida_remBorda("estadoResidencia");
                }
        
                if ($("#municipioResidencia").val() == "0"){ 
                    valida_addBorda("municipioResidencia");
                    ef = 1;
                } else {
                    valida_remBorda("municipioResidencia");
                } 
            }
        }

        if(ef == 0){
            return true;
        } else {
            return false;
        }
    } 
    if(tipoForm == "formConve"){ 
        ef = 0;   
        if ($("#obs").val() == ""){ 
            valida_addBorda("obs");
            ef = 1;
        } else {
            valida_remBorda("obs");
        }

        if(ef == 0){
            return true;
        } else {
            return false;
        }
    }
    if(tipoForm == "formReemb"){ 
        ef = 0;   
        if ($("#protocolo").val() == ""){ 
            valida_addBorda("protocolo");
            ef = 1;
        } else {
            valida_remBorda("protocolo");
        }

        if (($("#data1").val() == "") && ($("#data2").val() == "")){
            data_1 = "00/00/0000";	
            data_2 = "00/00/0000";
        } else {
            vData = true;
            if (($("#data1").val() != "") && ($("#data2").val() == "")){ 
                valida_addBorda("data2");
                valida_remBorda("protocolo");
                vData = false;
                ef = 1;
            } else {
                valida_remBorda("data2");
            }
    
            if (($("#data2").val() != "") && ($("#data1").val() == "")){ 
                valida_addBorda("data1");
                valida_remBorda("protocolo");
                vData = false;
                ef = 1;
            } else {
                valida_remBorda("data1");
            }

            if(vData){
                ef = 0;
                valida_remBorda("protocolo");

                data_1 = $("#data1").val();	
                data_2 = $("#data2").val();

                var Compara01 = parseInt(data_1.split("/")[2].toString() + data_1.split("/")[1].toString() + data_1.split("/")[0].toString());
                var Compara02 = parseInt(data_2.split("/")[2].toString() + data_2.split("/")[1].toString() + data_2.split("/")[0].toString());
                
                if (Compara01 > Compara02) {
                    document.getElementById('mensagemreembolso').innerHTML = "A data inicial não pode ser maior que a data final.";
                    document.getElementById('btn_listarreemb').click();
                    return false;
                }
            }
        }        


        if(ef == 0){

            return true;
        } else {
            return false;
        }
    }    
    if(tipoForm == "formCompAnexos"){ 
        ef = 0;   
        if ($("#arquivo").val() == ""){ 
            valida_addBorda("arquivo");
            ef = 1;
        } else {
            valida_remBorda("arquivo");
        }

        if(ef == 0){
            return true;
        } else {
            return false;
        }
    }
}

function mascara(src, mask){

	var i = src.value.length;
	var saida = mask.substring(0,1);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida){
	    src.value += texto.substring(0,1);
	}
	return;
}

function valida_addBorda(idTag){
    $("#"+idTag).addClass("border border-danger");
}

function valida_remBorda(idTag){
    $("#"+idTag).removeClass("border border-danger");
}

// SOMENTE NÚMERO
function somenteNumeros(e) {
    var charCode = e.charCode ? e.charCode : e.keyCode;
    if (charCode != 8 && charCode != 9) {
        if (charCode < 48 || charCode > 57) {
            return false;
        }
    }
}

// MENU LATERAL
function Menu() {
    aberto = $("#menu").val();
    if(aberto === "0" || aberto.trim() === ""){
        $("#navLateral").attr('style','width:auto');
        $("#main").attr('style','margin-left:280px');
        $("#menu").val("1");
    } else {
        $("#navLateral").attr('style','width:0');
        $("#main").attr('style','margin-left:0');
        $("#menu").val("0");
    }
}

function esqueciSenha(){
    ef = 0;

    if ($("#login").val() == ""){ 
        valida_addBorda("login");
        ef = 1;
    } else {
        valida_remBorda("login");
    }

    if(ef == 0){
		ajax = ajaxInit();
		if(ajax) {
		   ajax.open("GET","view/enviaremail.php?carteira="+document.form.login.value,false);
		   ajax.onreadystatechange = function() {
			 if(ajax.readyState == 4) {
			   if(ajax.status == 200) {	
			   		if (ajax.responseText == 0){
                        document.frm_senha.action = "index/a/es4";
						document.frm_senha.submit();
					}else{
                        document.frm_senha.carteira.value = document.form.login.value;
                        document.frm_senha.submit();
					}
			   }
			 }
		   }
		   ajax.send(null);
		}
       
    } else {
        return false;
    }
}

function trocarSenha(){
    ef = 0;

    if ($("#codEmail").val() == ""){ 
        valida_addBorda("codEmail");
        ef = 1;
    } else {
        valida_remBorda("codEmail");
    }

    if ($("#senha").val() == ""){ 
        valida_addBorda("senha");
        ef = 1;
    } else {
        valida_remBorda("senha");
    }

    if(ef == 0){
			window.location.assign(window.location.pathname+'login');
    } else {
        return false;
    }
}

$("#codunimed").on("input", function() {
    var codunimed = $(this);
    var carteira = $("#carteira");
    
    if (codunimed.val().length === 3) {
        carteira.focus();
    }
});

$("#dtnascimento").on("input", function() {
    var inputValue = $(this).val();
    inputValue = inputValue.replace(/\D/g, "");
    
    if (inputValue.length >= 2) {
        inputValue = inputValue.substring(0, 2) + "-" + inputValue.substring(2);
    }
    if (inputValue.length >= 5) {
        inputValue = inputValue.substring(0, 5) + "-" + inputValue.substring(5, 9);
    }
    
    $(this).val(inputValue);
});