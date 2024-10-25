/*$(document).ready(function() {
	$('#strHospital').select2();
});*/

// GERAL
function chamaModal(nomeModal) {
  myModal = new bootstrap.Modal(document.getElementById(nomeModal), {
    keyboard: true,
  });
  myModal.show();
}

function fechaModal(nomeModal) {
  myModal = new bootstrap.Modal(nomeModal);
  myModal.hide();
}

// SOLICITAÇÃO
const testeSoli = document.getElementById("testeSoli");
if (!Object.is(testeSoli, null)) {
  document.getElementById("estadoResidencia").style.display = "none";
  document.getElementById("municipioResidencia").style.display = "none";

  const meuElemento = document.getElementById("espMed");
  meuElemento.addEventListener("focus", function (event) {
    let cooperado = $("#coop").val();
    if (cooperado == 0) {
      document.getElementById("espMed").style.borderColor = "#6aa84f";
      $("#coop").val("1");
    } else {
      document.getElementById("espMed").style.borderColor = "#f44336";
      $("#coop").val("0");
    }
  });
}
function resideAtendimento(valor) {
  if (valor == "sim") {
    document.getElementById("estadoResidencia").style.display = "none";
    document.getElementById("municipioResidencia").style.display = "none";
  } else {
    document.getElementById("estadoResidencia").style.display = "block";
    document.getElementById("municipioResidencia").style.display = "block";
  }
}

// ACOMPANHAMENTO
const testeAcomp = document.getElementById("testeAcomp");
if (!Object.is(testeAcomp, null)) {
  const btn_cancelar = document.getElementById("btn_cancelar");
  //btn_cancelar.addEventListener('click', function() {
  //chamaModal('mdCancelar');
  //});
}

// COMPLEMENTAR
const testeComp = document.getElementById("testeComp");
if (!Object.is(testeComp, null)) {
  const btn_comp = document.getElementById("btn_comp");
  btn_comp.addEventListener("click", function () {
    chamaModal("exbAnexo");
  });
}
const testeCompTodos = document.getElementById("testeCompTodos");
if (!Object.is(testeCompTodos, null)) {
  const btn_listaracomp = document.getElementById("btn_listaracomp");
  btn_listaracomp.addEventListener("click", function () {
    chamaModal("exbTodosAnexo");
  });
}
const testeCompTodosAnexos = document.getElementById("testeCompTodosAnexos");
if (!Object.is(testeCompTodosAnexos, null)) {
  const btn_anexosacomp = document.getElementById("btn_anexosacomp");
  btn_anexosacomp.addEventListener("click", function () {
    chamaModal("envAnexo");
  });
}

/*const testeComp = document.getElementById('testeComp');
if (!Object.is(testeComp, null)){
    const anxComp = document.getElementById('anxComp');
    anxComp.addEventListener('click', function() { 
        chamaModal('exbAnexo');
    });

    const envAnx = document.getElementById('envAnx');
    envAnx.addEventListener('click', function() { 
        chamaModal('envAnexo');
    });

}*/

/*SOLICITACAO*/
function getNomeMedico(codigo) {
  ajax = ajaxInit();
  if (ajax) {
    //location.href = "../view/beneficiario/solicitacao/listamedicos.php?codigo="+codigo;
    ajax.open(
      "GET",
      "../view/beneficiario/solicitacao/listamedicos.php?codigo=" + codigo,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          var arrayvalor = ajax.responseText.split("#");
          if (arrayvalor[0] != 0 && arrayvalor[0] != "") {
            //alert(ajax.responseText);
            document.formSolBene.crm.value = arrayvalor[0];
            document.formSolBene.nomeMed.value = arrayvalor[1];
            MostrarEspecialidade(codigo);
          } else {
            document.formSolBene.crm.value = "";
            document.formSolBene.nomeMed.value = "";
            if (codigo == "") {
              MostrarEspecialidade(codigo);
            } else {
              //alert(arrayvalor[0]);
              if (codigo != "" && arrayvalor[0] == "0") {
                MostrarEspecialidade("");
              } else {
                MostrarEspecialidade(0);
              }
            }
          }
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

function MostrarEspecialidade(medico) {
  ajax = ajaxInit();
  if (ajax) {
    //location.href = "solicitacao/listarmedico.php?codespecialidade="+especialidade;
    ajax.open(
      "GET",
      "../view/beneficiario/solicitacao/listarespecialidade.php?codmedico=" +
        medico,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          //document.getElementById('espMed').style.display = 'block';
          document.getElementById("espMed").innerHTML = ajax.responseText;
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

function getmedico(medico) {
  var valtext = document.getElementById("nomeMed").value;
  var validamedico = valtext.split("#");
  ValidaMedicoExiste(validamedico[0]);

  if (retornomedicoexiste == 1) {
    document.formSolBene.crm.value = validamedico[0];
    MostrarEspecialidade(validamedico[0]);
  } else {
    if (medico == "") {
      MostrarEspecialidade(medico);
      document.formSolBene.crm.value = "";
    } else {
      MostrarEspecialidade(0);
      document.formSolBene.crm.value = "9999";
    }
  }
}

var retornomedicoexiste = 0;
function ValidaMedicoExiste(medico) {
  ajax = ajaxInit();
  if (ajax) {
    //location.href = "auditoria/solicitacaobeneficiario/verificamedicoexiste.php?medico="+medico;
    ajax.open(
      "GET",
      "../view/beneficiario/solicitacao/verificamedicoexiste.php?medico=" +
        medico,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          //	alert(ajax.responseText);
          retornomedicoexiste = ajax.responseText;
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

function MostrarFlags(codigo, carteira, codunimed) {
  var arraytratamento = codigo.split("_");

  if (arraytratamento[0] == 1) {
    document.getElementById("hospital").style.display = "block";
    document.getElementById("tipostratamento").style.display = "none";
    document.getElementById("tea").style.display = "none";

    document.formSolBene.serarealizado.value = "0";
    document.formSolBene.contrato.value = "";
    document.formSolBene.strHospital.value = "0";
    document.formSolBene.tipotea.value = "0";
  } else {
    if (arraytratamento[1] == 12) {
      document.getElementById("tipostratamento").style.display = "block";
      document.getElementById("hospital").style.display = "none";
      document.getElementById("tea").style.display = "none";
    } else if (
      arraytratamento[1] == 27 ||
      arraytratamento[1] == 28 ||
      arraytratamento[1] == 33
    ) {
      document.getElementById("tea").style.display = "block";
      document.getElementById("hospital").style.display = "none";
      document.getElementById("tipostratamento").style.display = "none";
    } else {
      document.getElementById("hospital").style.display = "none";
      document.getElementById("tipostratamento").style.display = "none";
      document.getElementById("tea").style.display = "none";
    }

    document.formSolBene.serarealizado.value = "0";
    document.formSolBene.contrato.value = "";
    document.formSolBene.strHospital.value = "0";
    document.formSolBene.tipotea.value = "0";
  }
}

function SerarRealizado(tratamento, serarealizado) {
  var arraytipo = tratamento.split("_");

  if (arraytipo[1] == 12) {
    document.formSolBene.contrato.value = "";
    document.formSolBene.strHospital.value = "0";

    if (serarealizado == "H") {
      document.getElementById("hospital").style.display = "block";
      document.getElementById("nomehospital1").style.display = "block";
      document.getElementById("tea").style.display = "none";
    } else {
      document.getElementById("hospital").style.display = "none";
      document.getElementById("nomehospital1").style.display = "none";
      document.getElementById("tea").style.display = "none";
    }
  }
}

function MostrarLocalAtendimento(flag) {
  //alert(flag);
  if (flag == "N") {
    document.getElementById("campoResidencia").style.display = "block";
  } else {
    document.getElementById("campoResidencia").style.display = "none";
  }
}

function MostrarDoucumentosTipoTratamento(codigo) {
  var arraytratamento = codigo.split("_");

  ajax = ajaxInit();
  if (ajax) {
    //location.href = "../view/beneficiario/solicitacao/listadocumentos.php?codigo="+arraytratamento[1];
    ajax.open(
      "GET",
      "../view/beneficiario/solicitacao/listadocumentos.php?codigo=" +
        arraytratamento[1],
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("listaDocs").innerHTML = ajax.responseText;
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

//ADICIONAR MATERIAIS ESPECIAIS
var itCountAnexosAut = 1;

function AnexosAut(flag, codpredefinidos) {
  var totaldocumento = eval("document.formSolBene.totaldocumento" + flag);
  //alert(totaldocumento.value);
  if (totaldocumento.value == 0) {
    itCountAnexosAut = 1;
  } else {
    itCountAnexosAut++;
  }

  texto =
    " <div class='row' id='nomestodosarquivos" +
    flag +
    "'> " +
    " <div class='col-md-12'> " +
    " <span class=' align-bottom material-symbols-outlined cursorPointer align-bottom text-danger' onclick='removeAnexosAut(" +
    flag +
    "," +
    itCountAnexosAut +
    ");' > " +
    " delete " +
    " </span> " +
    " Item - " +
    flag +
    "." +
    itCountAnexosAut +
    " <input type='file' accept='.png,.jpg,.jpeg,.pdf' id='arquivo" +
    flag +
    itCountAnexosAut +
    "' name='arquivo" +
    flag +
    itCountAnexosAut +
    "' class='form-control mt-2' value=''  onchange='checkFileSize(this," +
    flag +
    itCountAnexosAut +
    ")'> " +
    " <p id='fileSizeMessage" +
    flag +
    itCountAnexosAut +
    "' class='font-vermelho'></p>" +
    " <input type='hidden' name='codpredefinidos" +
    flag +
    itCountAnexosAut +
    "' id='codpredefinidos" +
    flag +
    itCountAnexosAut +
    "' value='" +
    codpredefinidos +
    "'> " +
    " </div> " +
    " </div> ";

  p = document.getElementById("todosarquivos" + flag);
  var div = document.createElement("div");
  div.innerHTML = texto;
  div.setAttribute("id", "meuId" + flag + itCountAnexosAut);
  div.setAttribute("class", "p-2");
  p.appendChild(div);

  totaldocumento.value = itCountAnexosAut;
}

function removeAnexosAut(flag, contador) {
  var i = document.getElementById("meuId" + flag + contador);
  i.remove();
}

function checkFileSize(fileInput, id) {
  const fileSizeMessage = document.getElementById("fileSizeMessage" + id);

  if (fileInput.files.length > 0) {
    const file = fileInput.files[0];
    const fileSizeInBytes = file.size;
    const fileSizeInKB = fileSizeInBytes / 1024;
    const fileSizeInMB = fileSizeInKB / 1024;
    if (fileSizeInMB > "2.097152") {
      fileSizeMessage.innerHTML = `Tamanho do arquivo: ${fileSizeInMB.toFixed(
        2
      )} MB é maior que o permitido de 2MB`;
      fileInput.value = "";
    } else {
      fileSizeMessage.innerHTML = "";
    }
  }
}

function GravarSolicitacaoBeneficiario() {
  var erro = 0;
  var mensagem = "Os seguintes campos não foram preenchidos:\n\n";

  if (document.formSolBene.carteira.value == "") {
    mensagem = mensagem + "Digite uma carteira\n";
    erro = 1;
  }
  if (document.formSolBene.email.value == "") {
    mensagem = mensagem + "Digite um email\n";
    erro = 1;
  }

  if (document.formSolBene.telFixo.value == "") {
    mensagem = mensagem + "Digite um telefone residêncial\n";
    erro = 1;
  }

  if (document.formSolBene.telCel.value == "") {
    mensagem = mensagem + "Digite um telefone celular\n";
    erro = 1;
  }

  if (document.formSolBene.crm.value == "") {
    mensagem = mensagem + "Digite um crm\n";
    erro = 1;
  }
  if (document.formSolBene.nomeMed.value == "") {
    mensagem = mensagem + "Digite um nome do médico\n";
    erro = 1;
  }
  if (document.formSolBene.espMed.value == "") {
    mensagem = mensagem + "Selecione uma especialidade\n";
    erro = 1;
  }
  if (document.formSolBene.tipoTratamento.value == "0_0") {
    mensagem = mensagem + "Selecione uma tipo de tratamento\n";
    erro = 1;
  } else {
    if (document.getElementById("listaDocs").innerHTML != "") {
      var docs = document.formSolBene.totalitensdocumento.value;

      if (docs > 0) {
        var arraydocs = 0;

        for (f = 1; f <= docs; f++) {
          var itens = eval("document.formSolBene.totaldocumento" + f);

          if (itens.value > 0) {
            for (i = 1; i <= itens.value; i++) {
              arraydocs = arraydocs + 1;

              var id = document.getElementById("meuId" + f + i);
              if (id.style.display != "none") {
                var arquivo = eval("document.formSolBene.arquivo" + f + i);
                //alert(arquivo.value);
                if (arquivo.value == "") {
                  mensagem =
                    mensagem +
                    "Insira um arquivo no item " +
                    f +
                    "." +
                    i +
                    "\n";
                  erro = 1;
                }
              }
            }
          }
        }

        if (arraydocs == 0) {
          mensagem = mensagem + "Existem arquivos para serem anexados\n";
          erro = 1;
        }
      }
    }
  }

  if (document.getElementById("mostrarprorrogacao").style.display == "block") {
    if (document.formSolBene.documento.value == "0") {
      mensagem = mensagem + "Selecione uma tipo de documento\n";
      erro = 1;
    }
  }
  if (document.getElementById("pacientemedicadoonc").style.display == "block") {
    if (document.formSolBene.pacientemedicado.value == "") {
      mensagem = mensagem + "Selecione qual tratamento\n";
      erro = 1;
    }
  }
  if (document.getElementById("tea").style.display == "block") {
    if (document.formSolBene.tipotea.value == "") {
      mensagem = mensagem + "Selecione um tratamento\n";
      erro = 1;
    }
  }
  if (document.getElementById("tipostratamento").style.display == "block") {
    if (document.formSolBene.serarealizado.value == "0") {
      mensagem = mensagem + "Será realizado\n";
      erro = 1;
    }
  }
  if (document.getElementById("hospital").style.display == "block") {
    if (
      document.formSolBene.contrato.value == "" &&
      document.formSolBene.strHospital.value == ""
    ) {
      mensagem = mensagem + "Digite uma sugestão de hospital\n";
      erro = 1;
    }
  }

  if (document.formSolBene.estadoTratamento.value == "") {
    mensagem = mensagem + "Selecione um estado\n";
    erro = 1;
  }
  if (document.formSolBene.municipioTratamento.value == "") {
    mensagem = mensagem + "Selecione uma cidade\n";
    erro = 1;
  }
  if (document.formSolBene.localatendimento.value == "") {
    mensagem = mensagem + "Selecione um local de atendimento\n";
    erro = 1;
  } else {
    if (document.formSolBene.localatendimento.value == "S") {
      if (document.formSolBene.estadoResidencia.value == "") {
        mensagem = mensagem + "Selecione um estado\n";
        erro = 1;
      }
      if (document.formSolBene.estadoResidencia.value == "") {
        mensagem = mensagem + "Selecione uma cidade\n";
        erro = 1;
      }
    }
  }

  //alert(erro);
  if (erro == 1) {
    alert(mensagem);
    return false;
    /*}else{
		
		vLink = montaLink(document.formSolBene,'../view/beneficiario/solicitacao/gravarsolicitacao.php','');
		ajax = ajaxInit();
		if(ajax) {			
			location.href = vLink;
			ajax.open("POST", vLink , false);
			ajax.onreadystatechange = function() {
				if(ajax.readyState == 4) {
					if(ajax.status == 200) {
						document.getElementById('mostrarmensagem').innerHTML = ajax.responseText;
						modal.style.display = "block";
						location.reload();
					} else {
						alert(ajax.statusText);
					}
				}
			}
			ajax.send(null);
		}*/
  }
}

function MostrarCidadeSolicitacao(codestado, tipo) {
  ajax = ajaxInit();
  if (ajax) {
    // location.href = "solicitacao/listacidadesolicitacao.php?codestado="+codestado;
    ajax.open(
      "GET",
      "../view/beneficiario/solicitacao/listacidadesolicitacao.php?codestado=" +
        codestado,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          if (tipo == "T") {
            document.getElementById("municipioTratamento").innerHTML =
              ajax.responseText;
          } else {
            document.getElementById("municipioResidencia").innerHTML =
              ajax.responseText;
          }
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

/*fim solicitação*/

/*buscar solicitação*/
function BuscarProtocolo(protocolo) {
  var ef = 0;
  //var mensagem = 'Os seguintes campos não foram preenchidos:<br><br>';

  if ($("#protocolo").val() == "") {
    valida_addBorda("protocolo");
    ef = 1;
  } else {
    valida_remBorda("protocolo");
  }

  if (ef == 1) {
    return false;
  } else {
    ajax = ajaxInit();
    if (ajax) {
      // location.href = "../view/beneficiario/acompanhamento/linhadotempo.php.?protocolo="+protocolo;
      ajax.open(
        "POST",
        "linhadotempo/" +
          protocolo,
        false
      );
      ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
          if (ajax.status == 200) {
            document.getElementById("bscprotocoloautorizacao").style.display =
              "none";
            document.getElementById("linhadotempo").innerHTML =
              ajax.responseText;
          } else {
            alert(ajax.statusText);
          }
        }
      };
      ajax.send(null);
    }
  }
}

function CancelarProtocolo() {
  var erro = 0;
  var mensagem = "Os seguintes campos não foram preenchidos:<br><br>";

  if (document.formBuscProtocolo.protocolo.value == "") {
    mensagem = mensagem + "Digite um protocolo<br>";
    erro = 1;
  }

  if (erro == 1) {
    document.getElementById("mensagem").innerHTML = mensagem;
    //document.getElementById('btn_cancelar').click();
    return false;
  } else {
    ajax = ajaxInit();
    if (ajax) {
      // location.href = "../view/beneficiario/acompanhamento/cancelarprotocolo.php?protocolo="+document.formBuscProtocolo.protocolo.value;
      ajax.open(
        "GET",
        "../view/beneficiario/acompanhamento/cancelarprotocolo.php?protocolo=" +
          document.formBuscProtocolo.protocolo.value,
        false
      );
      ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
          if (ajax.status == 200) {
            //window.location.assign(window.location.href+'/a/'+ajax.responseText);
            document.getElementById("linhadotempo").innerHTML =
              ajax.responseText;
            //document.getElementById('btn_cancelar').click();
          } else {
            alert(ajax.statusText);
          }
        }
      };
      ajax.send(null);
    }
  }
}

function montaTabelaProtocolo(tipo) {
  $("#listaProtocolo").fancyTable({
    pagination: true,
    perPage: 10,
    globalSearch: true,
    inputPlaceholder: "Filtrar...",
  });
}

function MostrarListaProtocolo() {
  ajax = ajaxInit();
  if (ajax) {
    // location.href = "../view/beneficiario/acompanhamento/listartodosprotocolos.php?codunimed="+codunimed+"&carteira="+carteira;
    ajax.open(
      "GET",
      "listartodosprotocolos.php",
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("mensagembuscar").innerHTML =
            ajax.responseText;
          chamaModal("mdBuscar");
          montaTabelaProtocolo("autorizacao");
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

function MostrarListaTodosProtocolosBeneficiario() {
  ajax = ajaxInit();
  if (ajax) {
    // location.href = "../view/beneficiario/acompanhamento/listartodosprotocolos.php?codunimed="+codunimed+"&carteira="+carteira;
    ajax.open(
      "GET",
      "mostrarlistatodosprotocolosbeneficiario.php",
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("mensagembuscar").innerHTML =
            ajax.responseText;
          chamaModal("mdBuscar");
          montaTabelaProtocolo("beneficiario");
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

const bscprotocolobeneficiario = document.getElementById(
  "bscprotocolobeneficiario"
);
if (!Object.is(bscprotocolobeneficiario, null)) {
  MostrarListaProtocoloBeneficiario();
}
function MostrarListaProtocoloBeneficiario() {
  var form_buscaProtocolo = document.formBuscProtocolo;
  ajax = ajaxInit();
  if (ajax) {
    ajax.open("GET", "listartodosprotocolosbeneficiario.php", false);
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("bscprotocolobeneficiario").innerHTML = ajax.responseText;
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

const bscprotocoloautorizacao = document.getElementById(
  "bscprotocoloautorizacao"
);
if (!Object.is(bscprotocoloautorizacao, null)) {
  MostrarListaProtocoloAutorizacao();
}
function MostrarListaProtocoloAutorizacao() {
  var form_buscaProtocolo = document.formBuscProtocolo;
  ajax = ajaxInit();
  if (ajax) {
    ajax.open("GET", "listartodosprotocolosautorizacao.php", false);
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("bscprotocoloautorizacao").innerHTML = ajax.responseText;
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

/*
const testeBuscar = document.getElementById('testeBuscar');
if (!Object.is(testeBuscar, null)){
    const btn_buscar = document.getElementById('btn_buscar');
    btn_buscar.addEventListener('click', function() { 
        chamaModal('mdBuscar');
    });
}
*/

const exbconversaReembolso = document.getElementById("exbconversaReembolso");
if (!Object.is(exbconversaReembolso, null)) {
  exbconversaReembolso.addEventListener("hidden.bs.modal", (event) => {
    $("body").removeAttr("class");
    $("body").removeAttr("style");
  });
}

const mdBuscar = document.getElementById("mdBuscar");
if (!Object.is(mdBuscar, null)) {
  mdBuscar.addEventListener("hidden.bs.modal", (event) => {
    $("body").removeAttr("class");
    $("body").removeAttr("style");
  });
  //montaTabelaProtocolo();
}

function SelecionaProtocolo(protocolo) {
  document.formBuscProtocolo.protocolo.value = protocolo;
  BuscarProtocolo(protocolo);
  $("#mdBuscar").modal("hide");

  const bscprotocoloautorizacao = document.getElementById("bscprotocoloautorizacao");
  if (!Object.is(bscprotocoloautorizacao, null)) {
    document.getElementById("bscprotocoloautorizacao").style.display = "none";
  }
}

function SelecionaProtocoloBeneficiario(idprotocolo,protocolo) {
  document.formBuscProtocolo.protocolo.value = protocolo;
  BuscarProtocoloBeneficiario(protocolo);
  $("#mdBuscar").modal("hide");

  const bscprotocolobeneficiario = document.getElementById("bscprotocolobeneficiario");
  if (!Object.is(bscprotocolobeneficiario, null)) {
    document.getElementById("bscprotocolobeneficiario").style.display = "none";
  }
}

function BuscarProtocoloBeneficiario(protocolo) {
  var ef = 0;
  //var mensagem = 'Os seguintes campos não foram preenchidos:<br><br>';

  if ($("#protocolo").val() == "") {
    valida_addBorda("protocolo");
    ef = 1;
  } else {
    valida_remBorda("protocolo");
  }

  if (ef == 1) {
    return false;
  } else {
    ajax = ajaxInit();
    if (ajax) {
      // location.href = "../view/beneficiario/acompanhamento/linhadotempo.php.?protocolo="+protocolo;
      ajax.open(
        "POST",
        "linhadotempobeneficiario/" +
          protocolo,
        false
      );
      ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
          if (ajax.status == 200) {
            document.getElementById("bscprotocolobeneficiario").style.display =
              "none";
            document.getElementById("linhadotempo").innerHTML =
              ajax.responseText;
          } else {
            alert(ajax.statusText);
          }
        }
      };
      ajax.send(null);
    }
  }
}
/*fim busar solicitacao*/

/*acompanhar*/
function BuscarDocumentacaoComplementar(protocolo) {
  var erro = 0;
  var mensagem = "Os seguintes campos não foram preenchidos:<br><br>";

  if (document.formCompBene.protocolo.value == "") {
    mensagem = mensagem + "Digite um protocolo<br>";
    erro = 1;
  }

  if (erro == 1) {
    document.getElementById("mensagem").innerHTML = mensagem;
    document.getElementById("btn_comp").click();
    return false;
  } else {
    ajax = ajaxInit();
    if (ajax) {
      //location.href = "../view/beneficiario/complementar/listarcomplementar.php?protocolo="+document.formCompBene.protocolo.value;
      ajax.open(
        "GET",
        "../view/beneficiario/complementar/listarcomplementar.php?protocolo=" +
          protocolo,
        false
      );
      ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
          if (ajax.status == 200) {
            document.getElementById("acompanhar").innerHTML = ajax.responseText;
          } else {
            alert(ajax.statusText);
          }
        }
      };
      ajax.send(null);
    }
  }
}

function MostrarListaComplementar(codunimed, carteira) {
  ajax = ajaxInit();
  if (ajax) {
    // location.href = "../view/beneficiario/acompanhamento/listartodoscomplementar.php?codunimed="+codunimed+"&carteira="+carteira;
    ajax.open(
      "GET",
      "../view/beneficiario/complementar/listartodoscomplementar.php?codunimed=" +
        codunimed +
        "&carteira=" +
        carteira,
      false
    );
    ajax.onreadystatechange = function () {
      //if(ajax.readyState == 4) {
      if (ajax.status == 200) {
        document.getElementById("mensagemcomplementar").innerHTML =
          ajax.responseText;
        chamaModal("exbTodosAnexo");
        //document.getElementById('btn_listaracomp').click();
      } else {
        alert(ajax.statusText);
      }
      //}
    };
    ajax.send(null);
  }
}
function MostrarListaComplementarIndex(codunimed, carteira) {
  ajax = ajaxInit();
  if (ajax) {
    // location.href = "../view/beneficiario/acompanhamento/listartodoscomplementar.php?codunimed="+codunimed+"&carteira="+carteira;
    ajax.open(
      "GET",
      "../view/beneficiario/complementar/listartodoscomplementarindex.php?codunimed=" +
        codunimed +
        "&carteira=" +
        carteira,
      false
    );
    ajax.onreadystatechange = function () {
      //if(ajax.readyState == 4) {
      if (ajax.status == 200) {
        document.getElementById("mensagemcomplementar").innerHTML =
          ajax.responseText;
        chamaModal("exbTodosAnexo");
        //document.getElementById('btn_listaracomp').click();
      } else {
        alert(ajax.statusText);
      }
      //}
    };
    ajax.send(null);
  }
}

function SelecionaProtocoloComplementar(protocolo) {
  document.formCompBene.protocolo.value = protocolo;
  BuscarDocumentacaoComplementar(protocolo);
  $("#exbTodosAnexo").modal("hide");
}

function AbriAnexosComplementar(codanexoscomplemetar) {
  //alert(codanexoscomplemetar);
  document.formCompAnexos.codanexoscomplemetar.value = codanexoscomplemetar;
  document.getElementById("btn_anexosacomp").click();
}

function GarvarAnexosComplementar() {
  vForm = validaForm("formCompAnexos");
  if (vForm) {
    document.formCompAnexos.codprotocolo.value =
      document.formCompBene.protocolo.value;
    return true;
  } else {
    return false;
  }
}
/**/

/*Reembolso*/

const testeReemb = document.getElementById("testeReemb");
if (!Object.is(testeReemb, null)) {
  const btn_listarreemb = document.getElementById("btn_listarreemb");
  btn_listarreemb.addEventListener("click", function () {
    chamaModal("exbReembolso");
  });
}
const ExibirReemb = document.getElementById("reembolso");
if (!Object.is(ExibirReemb, null)) {
  ExibirListarReembolso();
}
function ExibirListarReembolso() {
  var form_insere = document.formReemb;
  ajax = ajaxInit();
  if (ajax) {
    ajax.open(
      "GET",
      "../view/beneficiario/reembolso/listarreembolso.php?protocolo=&data1=&data2=&codunimed=" +
        form_insere.codunimedreembolso.value +
        "&carteira=" +
        form_insere.carteirareembolso.value,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("reembolso").innerHTML = ajax.responseText;
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}
function ListarReembolso() {
  vForm = validaForm("formReemb");
  if (vForm) {
    var form_insere = document.formReemb;
    var data_1 = form_insere.data1.value;
    var data_2 = form_insere.data2.value;
    var erro = 0;

    if (form_insere.data1.value == "") {
      data_1 = "00/00/0000";
    }
    if (form_insere.data2.value == "") {
      data_2 = "00/00/0000";
    }

    var Compara01 = parseInt(
      data_1.split("/")[2].toString() +
        data_1.split("/")[1].toString() +
        data_1.split("/")[0].toString()
    );
    var Compara02 = parseInt(
      data_2.split("/")[2].toString() +
        data_2.split("/")[1].toString() +
        data_2.split("/")[0].toString()
    );

    //alert(Compara01)
    if (Compara01 > Compara02) {
      msg = msg + "A data inicial não pode ser maior que a data final.";
      erro = 1;
    }

    if (erro == 1) {
      document.getElementById("mensagemreembolso").innerHTML = mensagem;
      document.getElementById("btn_listarreemb").click();
      return false;
    }

    ajax = ajaxInit();
    if (ajax) {
      ajax.open(
        "GET",
        "../view/beneficiario/reembolso/listarreembolso.php?protocolo=" +
          form_insere.protocolo.value +
          "&data1=" +
          form_insere.data1.value +
          "&data2=" +
          form_insere.data2.value +
          "&codunimed=" +
          form_insere.codunimedreembolso.value +
          "&carteira=" +
          form_insere.carteirareembolso.value,
        false
      );
      ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
          if (ajax.status == 200) {
            document.getElementById("reembolso").innerHTML = ajax.responseText;
          } else {
            alert(ajax.statusText);
          }
        }
      };
      ajax.send(null);
    }
  }
}

const ExibirDocComp = document.getElementById("acompanhar");
if (!Object.is(ExibirDocComp, null)) {
  ExibirListarDocComp();
}
function ExibirListarDocComp() {
  var form_insere = document.formCompBene;
  codunimed = form_insere.compCodUsuario.value;
  carteira = form_insere.compCartUsuario.value;
  ajax = ajaxInit();
  if (ajax) {
    ajax.open(
      "GET",
      "../view/beneficiario/complementar/listartodoscomplementarindex.php?codunimed=" +
        codunimed +
        "&carteira=" +
        carteira,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("acompanhar").innerHTML = ajax.responseText;
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

// EXIBIR CHAT DO BENEFICIÁRIO
function openChat() {
  var chatbot = document.getElementById("chatbot");
  chatbot.classList.remove("d-none");
}

function barra(objeto) {
  if (objeto.value.length == 2 || objeto.value.length == 5) {
    objeto.value = objeto.value + "/";
  }
}

const testeanexosReemb = document.getElementById("testeanexosReemb");
if (!Object.is(testeanexosReemb, null)) {
  const btn_listaranexosreemb = document.getElementById(
    "btn_listaranexosreemb"
  );
  btn_listaranexosreemb.addEventListener("click", function () {
    chamaModal("exbAnexosReembolso");
  });
}

function MostrarImagemReembolso(protocolo) {
  ajax = ajaxInit();
  if (ajax) {
    //location.href = "../view/beneficiario/reembolso/listaranexosreembolso.php?protocolo="+protocolo;
    ajax.open(
      "GET",
      "../view/beneficiario/reembolso/listaranexosreembolso.php?protocolo=" +
        protocolo,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("mensagemanexosreembolso").innerHTML =
            ajax.responseText;
          document.getElementById("btn_listaranexosreemb").click();
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

function MostrarPopoupReembolso(
  codanexos,
  nome,
  codprotocoloans,
  url,
  tipo,
  contitem,
  linha,
  totalanexo
) {
  for (it = 0; it <= contitem; it++) {
    for (l = 1; l <= totalanexo; l++) {
      for (c = 1; c <= 5; c++) {
        if (l == atob(linha)) {
          document.getElementById("cor" + it + c + l).style.color = "black";
        } else {
          document.getElementById("cor" + it + c + l).style.color = "";
        }
      }
    }
  }

  ajax = ajaxInit();
  if (ajax) {
    //location.href = "../view/beneficiario/reembolso/mudareditorimagem.php?codanexos="+codanexos+"&nome="+nome+"&codprotocoloans="+codprotocoloans;
    ajax.open(
      "GET",
      "../view/beneficiario/reembolso/mudareditorimagem.php?codanexos=" +
        codanexos +
        "&nome=" +
        nome +
        "&codprotocoloans=" +
        codprotocoloans,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("mensagemanexosreembolso").innerHTML =
            ajax.responseText;
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }

  /*var nome;
	nome = window.open("../view/beneficiario/reembolso/mudareditorimagem.php?codanexos="+codanexos+"&nome="+nome+"&codprotocoloans="+codprotocoloans,"anexos","scrollbars=1,width=800,height=800");
	nome.moveTo(200,100);*/
}

const testeconversaReemb = document.getElementById("testeconversaReemb");
if (!Object.is(testeconversaReemb, null)) {
  const btn_listarconversareemb = document.getElementById(
    "btn_listarconversareemb"
  );
  btn_listarconversareemb.addEventListener("click", function () {
    chamaModal("exbconversaReembolso");
  });
}

function MostrarConversaReembolso(protocolo, etapas) {
  ajax = ajaxInit();
  if (ajax) {
    //location.href = "../view/beneficiario/reembolso/listarconversa.php?protocolo="+protocolo;
    ajax.open(
      "GET",
      "../view/beneficiario/reembolso/listarconversa.php?protocolo=" +
        protocolo,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("mensagemconversareembolso").innerHTML =
            ajax.responseText;
          document.getElementById("btn_listarconversareemb").click();
          ExibirConversaReembolso(protocolo, etapas);
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

const testegravaconversaReemb = document.getElementById(
  "testegravaconversaReemb"
);
if (!Object.is(testegravaconversaReemb, null)) {
  const btn_gravaconversareemb = document.getElementById(
    "btn_gravaconversareemb"
  );
  btn_gravaconversareemb.addEventListener("click", function () {
    chamaModal("exbgravaconversaReembolso");
  });
}

function ExibirConversaReembolso(protocolo, codreembolsoxetapas) {
  ajax = ajaxInit();
  if (ajax) {
    //location.href = "../view/beneficiario/reembolso/listarconversa.php?protocolo="+protocolo;
    ajax.open(
      "GET",
      "../view/beneficiario/reembolso/form_conversa.php?protocolo=" +
        protocolo +
        "&codreembolsoxetapas=" +
        codreembolsoxetapas,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("mensagemgravaconversareembolso").innerHTML =
            ajax.responseText;
          //document.getElementById('btn_gravaconversareemb').click();
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

function GravarConversaReembolso() {
  vForm = validaForm("formConve");
  if (vForm) {
    ajax = ajaxInit();
    if (ajax) {
      location.href =
        "../view/beneficiario/reembolso/gravarconversa.php?protocolo=" +
        document.formConve.protocolo.value +
        "&codreembolsoxetapas=" +
        document.formConve.codreembolsoxetapas.value +
        "&obs=" +
        document.formConve.obs.value;
      ajax.open(
        "GET",
        "./view/beneficiario/reembolso/gravarconversa.php?protocolo=" +
          document.formConve.protocolo.value +
          "&codreembolsoxetapas=" +
          document.formConve.codreembolsoxetapas.value +
          "&obs=" +
          document.formConve.obs.value,
        false
      );
      ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
          if (ajax.status == 200) {
            $("#exbconversaReembolso").modal("hide");
            MostrarConversaReembolso(
              document.formConve.protocolo.value,
              document.formConve.codreembolsoxetapas.value
            );
          } else {
            alert(ajax.statusText);
          }
        }
      };
      ajax.send(null);
    }
  }
}

function getprestador(valor) {
  var validaprestador = valor.split("#");
  document.formSolBene.contrato.value = validaprestador[0];
}

function MostrarPopoupObs(protocolo, status) {
  ajax = ajaxInit();
  if (ajax) {
    //location.href = "../view/beneficiario/acompanhamento/listaorientacoes.php?protocolo="+protocolo+"&status="+status;
    ajax.open(
      "POST",
      "listaorientacoes/" +
        protocolo +
        "/" +
        status,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("mensagemorientacao").innerHTML =
            ajax.responseText;
          document.formBuscProtocolo.protocolo.value = protocolo;
          chamaModal("mdOrienta");
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

function MostrarPopoupObsBeneficiario(protocolo,idHistoricoANS) {
  ajax = ajaxInit();
  if (ajax) {
    //location.href = "../view/beneficiario/acompanhamento/listaorientacoes.php?protocolo="+protocolo+"&status="+status;
    ajax.open(
      "POST",
      "listaorientacoesbeneficiario/" +
        protocolo +
        "/" +
        idHistoricoANS,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("mensagemorientacao").innerHTML =
            ajax.responseText;
          //document.formBuscProtocolo.protocolo.value = protocolo;
          chamaModal("mdOrienta");
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

function MostrarPopoupGuia(codanexos, nome, protocolo, path, extensao) {
  ajax = ajaxInit();
  if (ajax) {
    location.href =
      "../view/beneficiario/acompanhamento/listaguias.php?protocolo=" +
      protocolo +
      "&path=" +
      path;
    ajax.open(
      "GET",
      "../view/beneficiario/acompanhamento/listaguias.php?protocolo=" +
        protocolo +
        "&path=" +
        path,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("mensagemorientacao").innerHTML =
            ajax.responseText;
          chamaModal("mdOrienta");
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

function removeArquivos(protocolo) {
  ajax = ajaxInit();
  if (ajax) {
    ajax.open(
      "GET",
      "../view/beneficiario/acompanhamento/removearquivo.php?protocolo=" +
        protocolo,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          //$('#exbconversaReembolso').modal('hide');
          //MostrarConversaReembolso(document.formConve.protocolo.value,document.formConve.codreembolsoxetapas.value)
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}

function VisualizarAnexosProtocolo(protocolo) {
  ajax = ajaxInit();
  if (ajax) {
    // location.href = "../view/beneficiario/acompanhamento/listartodosanexosprotocolos.php?protocolo="+protocolo;
    ajax.open(
      "POST",
      "listartodosanexosprotocolos/" +
        protocolo,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("mensagemanexos").innerHTML =
            ajax.responseText;
          document.formBuscProtocolo.protocolo.value = protocolo;
          chamaModal("mdAnexos");
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }

  /*document.formBuscProtocolo.protocolo.value = protocolo;
	BuscarProtocolo(protocolo);
	$('#mdBuscar').modal('hide');

	const mensagembuscarindex = document.getElementById('mensagembuscarindex')
	if (!Object.is(mensagembuscarindex, null)){
		document.getElementById("mensagembuscarindex").style.display = "none";
	}*/
}

/*function MostrarPopoupGuia(codanexos,nome,protocolo,url,extensao){	
  var link = document.createElement("a");
  link.download = "novo_arquivo";
  link.href = url;
  link.click();
}*/

function MostrarImagemAnexos(codanexos) {
  ajax = ajaxInit();
  if (ajax) {
    //location.href = "../view/beneficiario/acompanhamento/mudareditorimagem.php?codanexos="+codanexos;
    ajax.open(
      "GET",
      "mudareditorimagem/" +
        codanexos,
      false
    );
    ajax.onreadystatechange = function () {
      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          document.getElementById("mensagemanexos").innerHTML =
            ajax.responseText;
          //chamaModal('mdAnexos');
        } else {
          alert(ajax.statusText);
        }
      }
    };
    ajax.send(null);
  }
}
