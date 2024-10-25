// ********************************************************************
// Autor: Ana Tavares 
// Data: 18/11/2009
// Descricao: Funcao que monta Selects com Uso de Ajax.
// Modo de Usar: Passar 2 parametros, no primeiro serão os parametros da pagina ajax.asp, no segundo o select a ser montado
// Exemplo: montaCombo('sql=centrocustoxfilial&filial='+document.form.FILIAL.value,document.form.CENTROCUSTO);
// Ver Exemplo em: /asp/md_ajax/default.asp
// *******************************************************************
// Funcao que inicializa o Ajax
function ajaxInit() {
	var req;

	try {
		req = new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e) {
			try {
					req = new ActiveXObject("Msxml2.XMLHTTP");
					} catch(ex) {
						try {
							req = new XMLHttpRequest();
							} catch(exc) {
								alert("Esse browser não tem recursos para uso do Ajax");
								req = null;
							}
					}
			}

	return req;
}

// Funcao que inicializa o Ajax
function ajaxInitAvac() {
	var req;

	try{ //esta sessão é exclusiva para IExplorer
		req = new ActiveXObject("Msxml2.XMLHTTP.8.0");
	} catch(e8){
		try{ //esta sessão é exclusiva para IExplorer
			req = new ActiveXObject("Msxml2.XMLHTTP.7.0");
		} catch(e7){
			try{ //esta sessão é exclusiva para IExplorer
				req = new ActiveXObject("Msxml2.XMLHTTP.6.0");
			} catch(e6){
				try{ //esta sessão é exclusiva para IExplorer
					req = new ActiveXObject("Msxml2.XMLHTTP.5.0");
				} catch(e5){
					try{ //esta sessão é exclusiva para IExplorer
						req = new ActiveXObject("Msxml2.XMLHTTP.4.0");
					} catch(e4){
						try{ //esta sessão é exclusiva para IExplorer
							req = new ActiveXObject("Msxml2.XMLHTTP.3.0");
						} catch(e3){
	
			
									try {
										req = new ActiveXObject("Msxml2.XMLHTTP");
										} catch(e) {
											try {
													req = new ActiveXObject("Microsoft.XMLHTTP");
													} catch(ex) {
														try {
															req = new XMLHttpRequest();
															} catch(exc) {
																alert("Esse browser não tem recursos para uso do Ajax");
																req = null;
															}
													}
											}
						}
					}
				}
			}
		}
	}
	alert(req);
	return req;
}

// Função que cria a mensagem Carregando...
function criaDiv() {
	divcarregando = document.createElement('div');
	divcarregando.setAttribute("id", "carregando");
	document.form.appendChild(divcarregando);
	//document.getElementById("carregando").style.position = "absolute"; 
	/*document.getElementById("carregando").style.top  = 250; 
	tela = top.document.form.clientWidth;*/
	//document.getElementById("carregando").style.left = 1200;// tela-212; 
	document.getElementById("carregando").style.fontSize = "12px"; 
	document.getElementById("carregando").style.fontFamily = "Tahoma";
	//document.getElementById("carregando").style.zIndex = 1000;
	document.getElementById("carregando").innerHTML = "<table border=0 cellpadding=1 cellspacing=0 width=66 style='filter: alpha(opacity=75); background-color:#E6E6E6; border-bottom-color:#096DA7;'><tr><td align=center><br><h1 class=fontblue align=center>Aguarde...</h1><img src='img/loader_unimed.gif' width='66' height='66'></td></tr></table>";
	document.getElementById("carregando").style.display = "block";
	document.form.style.cursor = 'wait'; 
}

// Função que cria a mensagem Carregando...
function criaDivNovo() {
	divcarregando = document.createElement('div');
	divcarregando.setAttribute("id", "carregando");
	document.form.appendChild(divcarregando);
	//document.getElementById("carregando").style.position = "absolute"; 
	/*document.getElementById("carregando").style.top  = 250; 
	tela = top.document.form.clientWidth;*/
	//document.getElementById("carregando").style.left = 1200;// tela-212; 
	document.getElementById("carregando").style.fontSize = "12px"; 
	document.getElementById("carregando").style.fontFamily = "Tahoma";
	//document.getElementById("carregando").style.zIndex = 1000;
	document.getElementById("carregando").innerHTML = "<div style='position: absolute;top:40%;left:60%;'><center><font size='3' color='#007831'>Aguarde...</font><br><br><img src='../../../img/loader_unimed.gif' width='66' height='66'></center></div>";
	document.getElementById("carregando").style.display = "block";
	document.form.style.cursor = 'wait'; 
}

// Função que tira a mensagem Carregando... da tela.
function destroiDivNovo() {
	document.getElementById("carregando").style.display = "none"; // ESCONDE A MENSAGEM "CARREGANDO..."	
	document.form.style.cursor = 'default'; // COLOCA O CURSOR DO MOUSE NO MODO DEFAULT
}
function destroiDiv() {
	document.getElementById("carregando").style.display = "none"; // ESCONDE A MENSAGEM "CARREGANDO..."	
	document.form.style.cursor = 'default'; // COLOCA O CURSOR DO MOUSE NO MODO DEFAULT
}


//Função que monta o link do ajax com todos os campos preenchidos.
// Passar o Objeto form, o nome do arquivo ASP para processamento e parametros manuais.

//A função montaLink serve para ir no form indicado, pegar todos os campos e gerar uma "string" de parametros para ser enviada.
//Ela serve tanto para o método GET quanto para o método POST
function montaLink(form,pagina,parametros) {
	var elementosFormulario = form.elements;



    var qtdElementos = elementosFormulario.length;
	
	var strLink = pagina+"?"+parametros;
	
	if (parametros != "") {
		strLink = strLink+"&";	
	}
	
	for(i=0; i < qtdElementos; i++) {
		
		if((elementosFormulario[i].type == "radio") || (elementosFormulario[i].type == "checkbox")) {
			if(elementosFormulario[i].checked) {
				strLink = strLink + elementosFormulario[i].name + "="+ elementosFormulario[i].value + "&";	
			} 
		} else if (elementosFormulario[i].type == "select-multiple"){
			quantidade = elementosFormulario[i].length;
			
			nome = elementosFormulario[i].name;
			strLink = strLink + elementosFormulario[i].name + "=";
			var primeiraEntrada = true;
			for(j=0;j<quantidade;j++){	
				nomefinal = elementosFormulario[i].options[j].selected;
				if (nomefinal) {
					if(primeiraEntrada) {
						strLink = strLink + elementosFormulario[i].options[j].value;
						primeiraEntrada = false;
					} else {	
						strLink = strLink + "," + elementosFormulario[i].options[j].value;	
					}
				}
			}	
			strLink = strLink + "&"
		} else {
			if((elementosFormulario[i].type != "button") && 
			   (elementosFormulario[i].type != "reset") && 
			   (elementosFormulario[i].type != "submit") && 
			   (elementosFormulario[i].type != "undefined")){
					strLink = strLink + elementosFormulario[i].name + "="+ elementosFormulario[i].value + "&"; 
//					alert(elementosFormulario[i].destino);	
			}
		}
		if ((elementosFormulario[i].destino != "undefined") && 
			(elementosFormulario[i].destino != null) &&
			(elementosFormulario[i].type != "button") && 
			(elementosFormulario[i].type != "reset") && 
			(elementosFormulario[i].type != "submit") && 
			(elementosFormulario[i].type != "undefined")) {
			strLink = strLink + elementosFormulario[i].name + "DESTINO="+ elementosFormulario[i].destino + "&"; 
		}
	}			
	
	return strLink;
}

/*Funções modificadas para o envio de formulários, as funções que estão abaixo, algumas são versões das funções que já existem, elas foram modificadas para 
realizar o envio de dados via metodo post.*/

//////////////////////////////////////////////////////////

//Usuário: Alfredo Rangel <alfredo.rangel@gisanet.com.br>
//Especialidade que está utilizando a função: 
//Fonoaudiologia PGMDC
//Arquivo: 
//DUA: 29/07/2008

//////////////////////////////////////////////////////////

var http_request = false;

function makePOSTRequest( url, parameters ) {	 

  http_request = false;
  if (window.XMLHttpRequest) { // Mozilla, Safari,...
	 http_request = new XMLHttpRequest();
	 if (http_request.overrideMimeType) {
		// set type accordingly to anticipated content type
		//http_request.overrideMimeType('text/xml');
		http_request.overrideMimeType('text/html');
	 }
  } else if (window.ActiveXObject) { // IE
	 try {
		http_request = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
		try {
		   http_request = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
	 }
  }
  if (!http_request) {
	 alert('Não foi possível criar uma instância do objeto XMLHTTP');
	 return false;
  }
  
  http_request.onreadystatechange = alertContents;
  http_request.open('POST', url, true);
	/*Desabilitar a linha abaixo para efetuar testes na função*/
	//url = url +"?"+parameters
	//window.open(url,'s');
  http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http_request.setRequestHeader("Content-length", parameters.length);
  http_request.setRequestHeader("Connection", "close");
  http_request.send(parameters);
}

function alertContents() {

  if (http_request.readyState == 4) {
	if (http_request.status == 200) {
		result = http_request.responseText;
		alert(document.getElementById('msg'));
		if (document.getElementById('msg') == '[object]') {
			document.getElementById('msg').innerHTML = http_request.responseText;
			document.getElementById('ALERT1').style.display = 'block';
		//	iniciar(tempo,dif);
		}else {
			divName = document.getElementById('divResposta').innerHTML = result;
		}
	 } else {
		alert('Ocorreu um erro, contate o help desk Gisanet.');
/*		result = http_request.responseText;
		divName = document.getElementById('divResposta').innerHTML = result;
		*/
	 }
  }
}
   
   
   
   
function montaLink_2(vForm,parametros) {
	
	vForm = eval('document.'+vForm+'')
	
	var elementosFormulario = vForm.elements;
	
	
    var qtdElementos = elementosFormulario.length;
	
	var strLink = parametros;
			
	if (parametros != "") {
		strLink = strLink+"&";	
	}
	
	for(i=0; i < qtdElementos; i++) {
		
		if((elementosFormulario[i].type == "radio") || (elementosFormulario[i].type == "checkbox")) {
			if(elementosFormulario[i].checked) {
				strLink = strLink + elementosFormulario[i].name + "="+ elementosFormulario[i].value + "&";	
			} 
		} else if (elementosFormulario[i].type == "select-multiple"){
			quantidade = elementosFormulario[i].length;
			
			nome = elementosFormulario[i].name;
			strLink = strLink + elementosFormulario[i].name + "=";
			var primeiraEntrada = true;
			for(j=0;j<quantidade;j++){	
				nomefinal = elementosFormulario[i].options[j].selected;
				if (nomefinal) {
					if(primeiraEntrada) {
						strLink = strLink + elementosFormulario[i].options[j].value;
						primeiraEntrada = false;
					} else {	
						strLink = strLink + "," + elementosFormulario[i].options[j].value;	
					}
				}
			}	
			strLink = strLink + "&"
		} else {
			if((elementosFormulario[i].type != "button") && 
			   (elementosFormulario[i].type != "reset") && 
			   (elementosFormulario[i].type != "submit") && 
			   (elementosFormulario[i].type != "undefined")){
					strLink = strLink + elementosFormulario[i].name + "="+ elementosFormulario[i].value + "&"; 
//					alert(elementosFormulario[i].destino);	
			}
		}
		if ((elementosFormulario[i].destino != "undefined") && 
			(elementosFormulario[i].destino != null) &&
			(elementosFormulario[i].type != "button") && 
			(elementosFormulario[i].type != "reset") && 
			(elementosFormulario[i].type != "submit") && 
			(elementosFormulario[i].type != "undefined")) {
			strLink = strLink + elementosFormulario[i].name + "DESTINO="+ elementosFormulario[i].destino + "&"; 
		}
	}	
	strLink = strLink+"varAleatoria="+Math.random();
	return strLink;
}



function enviarConsulta(pagina, formulario) {
	poststr = montaLink_2(formulario,'')
	
	makePOSTRequest(pagina, poststr);
 }
 
var divName = 'carregando'; // div that is to follow the mouse
// (must be position:absolute)
var offX = 5;          // X offset from mouse position
var offY = 5;          // Y offset from mouse position
function mouseX(evt) {if (!evt) evt = window.event; if (evt.pageX) return evt.pageX; else if (evt.clientX)return evt.clientX + (document.documentElement.scrollLeft ?  document.documentElement.scrollLeft : document.body.scrollLeft); else return 0;}
function mouseY(evt) {if (!evt) evt = window.event; if (evt.pageY) return evt.pageY; else if (evt.clientY)return evt.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop); else return 0;}
 
function follow(evt) {if (document.getElementById) {var obj = document.getElementById(divName).style; obj.visibility = 'visible';
obj.left = (parseInt(mouseX(evt))+offX) + 'px';
obj.top = (parseInt(mouseY(evt))+offY) + 'px';}}


//function montaCombo(sql,obj,proximo) {
//	var valores;
//	var retorno;
//	
//	divcarregando = document.createElement('div');
//	divcarregando.setAttribute("id", "carregando");
//	document.body.appendChild(divcarregando);
//	
//	document.getElementById("carregando").style.position = "absolute"; 
//	document.getElementById("carregando").style.top  = 250; 
//	tela = top.document.body.clientWidth;
//	document.getElementById("carregando").style.left = 350;// tela-212; 
//	//document.getElementById("carregando").style.background = "#E6E6E6"; 
//	document.getElementById("carregando").style.fontSize = "12px"; 
//	document.getElementById("carregando").style.fontFamily = "Tahoma"; 
//	//document.getElementById("carregando").style.color = "#096DA7";
//	//document.getElementById("carregando").innerHTML = "Carregando...";
//
//	
//	ajax = ajaxInit();
//
//	if(ajax) {
//		//location.href = "ajax/ajax.php?" + sql;
//		ajax.open("GET", "ajax/ajax.php?" + sql, false);
//		ajax.onreadystatechange = function() {
//			if(ajax.readyState == 1) {
//				document.getElementById("carregando").innerHTML = "<table border=1 cellpadding=1 cellspacing=0 width=120 style='filter: alpha(opacity=75); background-color:#E6E6E6; border-bottom-color:#096DA7;'><tr><td align=center><br><h1 class=fontblue align=center>Aguarde...</h1></td></tr></table>";
//				document.getElementById("carregando").style.display = "block"; // MOSTRA A MENSAGEM "CARREGANDO..." É O GMAIL É?!
//				document.body.style.cursor = 'wait';                           // MUDA O CURSOR DO MOUSE PRA UMA AMPULHETA
//			}
//			if(ajax.readyState == 2){
//				document.getElementById("carregando").innerHTML = "<table border=1 cellpadding=1 cellspacing=0 width=120 style='filter: alpha(opacity=75); background-color:#E6E6E6; border-bottom-color:#096DA7;'><tr><td align=center><br><h1 class=fontblue align=center>Carregando...</h1></td></tr></table>";
//			}
//			if(ajax.readyState == 4) {
//				if(ajax.status == 200) {
//					valores = ajax.responseText;					// Valores recebidos pela pagina ASP
//					if(valores == "expirou"){						// Se a Sessao do usuario expirou
//						top.location.href='/login.asp?msg=Sua Sessão Expirou, Faça o Login Novamente';
//					}
//					vetor = valores.split(";");					    // Cria o Array com os Resultados
//					var qtd =  vetor.length;						// qtd recebe a quantidade de elementos do array acima
//					qtd = (qtd-1)/2;								// qtd sempre vem com um valor a mais, entao é preciso diminuir de um e dividir por 2 pois o array vem com codigo e descricao
//					if(qtd > 1) {									// se tiver mais de uma opcao, deve aparecer a opcao 'Escolha...' antes de tudo.
//						qtd++;										// incrementa um o qtd para poder caber o 'Escolha...'
//						obj.options.length = qtd;					// seta a quantidade de opcoes do select
//						obj.options[0].text = 'Escolha...'			// defino o primeiro texto para 'Escolha...'
//						obj.options[0].value = 0;					// defino o primeiro valor pra 0
//						cont2 = 1;									// este contador auxiliar deve comecar de 1 pois a opcao zero 'Escolha...' ja existe
//					} else {										// se nao tiver mais de uma opcao
//						obj.options.length = qtd;					// seta a quantidade de opcoes do select
//						cont2 = 0;									// este contador auxiliar comeca em 0 para contar a quantidade de opcoes
//					} 
//					cont = 0;										// este contador vai contar no array de 2 em 2, pois o array vem com codigo e descricao
//					while(cont2 < qtd) {							// enquanto o contador de opcoes for menor que a quantidade de opcoes
//						obj.options[cont2].text = vetor[cont+1];    // define o texto das opcoes. cont2 é o indice do select e cont o indice do vetor carregado pela pagina ASP
//						obj.options[cont2].value = vetor[cont];		// define o valor das opcoes. cont2 é o indice do select e cont o indice do vetor carregado pela pagina ASP
//						cont = cont+2;								// incrementa o cont em 2
//						cont2++;									// incrementa cont2 em 1
//					}
////					obj.onchange(); 								//  erro nessa chamad
//					document.getElementById("carregando").style.display = "none"; // ESCONDE A MENSAGEM "CARREGANDO..."	
//					document.body.style.cursor = 'default'; // COLOCA O CURSOR DO MOUSE NO MODO DEFAULT
//					eval(proximo);
//				} else {
//					//alert(ajax.statusText);
//					alert(ajax.statusText +'\n\nPossivel erro de SQL. \nVerificar Ajax.asp\n\n ERRO:\n'+ajax.responseText);
//				}
//			}
//		}
//		ajax.send(null);
//	}
//}	

