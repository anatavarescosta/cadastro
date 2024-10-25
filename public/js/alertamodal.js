const urlAtual = window.location.href;
const alertamodal = document.getElementById('cont_alertamodal');
const btn_cancelar = document.getElementById('btn_cancelar');
const btn_enviaSolicitacao = document.getElementById('btn_enviaSolicitacao');
const anxComp = document.getElementById('anxComp');

btn_cancelar.addEventListener('click', function() {
  alertamodal.innerHTML = '<div class="modal fade" id="alertaModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">'+
                              '<div class="modal-dialog" role="document">'+
                                  '<div class="modal-content">'+
                                      '<div class="modal-header alert-warning alert " role="alert">'+
                                          '<h5 class="modal-title" id="ModalLabel"> ATENÇÃO </h5>'+
                                      '</div>'+
                                      '<div class="modal-body">'+
                                          'Deseja cancelar este protocolo?'+
                                      '</div>'+
                                      '<div class="modal-footer">'+
                                          '<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btn_confirma" onClick="envia()">Confirmar</button>'+
                                          '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>'+
                                      '</div>'+
                                  '</div>'+
                              '</div>'+
                            '</div>';
  chamaModal();
})

btn_enviaSolicitacao.addEventListener('click', function() {
  alertamodal.innerHTML = '<div class="modal fade" id="alertaModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">'+
                            '<div class="modal-dialog" role="document">'+
                                '<div class="modal-content">'+
                                    '<div class="modal-header alert-warning alert " role="alert">'+
                                        '<h5 class="modal-title" id="ModalLabel"> ATENÇÃO </h5>'+
                                    '</div>'+
                                    '<div class="modal-body">'+
                                        'Deseja cancelar este protocolo?'+
                                    '</div>'+
                                    '<div class="modal-footer">'+
                                        '<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btn_confirma" onClick="envia()">Confirmar</button>'+
                                        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                          '</div>';
    //chamaModal();
})

anxComp.addEventListener('click', function() {
    alertamodal.innerHTML = '<div class="modal fade" id="alertaModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">'+
                                '<div class="modal-dialog" role="document">'+
                                    '<div class="modal-content">'+
                                        '<div class="modal-header alert-info alert " role="alert">'+
                                            '<h5 class="modal-title" id="ModalLabel"> ANEXOS </h5>'+
                                        '</div>'+
                                        '<div class="modal-body">'+
                                            'Lista com os anexos enviados para este protocolo!'+
                                        '</div>'+
                                        '<div class="modal-footer">'+
                                            '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                              '</div>';
    chamaModal();
  })

function chamaModal(){
  myModal = new bootstrap.Modal(document.getElementById('alertaModal'), {
      keyboard: true
  })
  myModal.show()
}

function envia(){
  if (urlAtual.charAt(urlAtual.length - 1) === '/') {
    urlAtual.slice(0, -1);
  }
  window.location.href = urlAtual+"/a/p1";
  //alert('ok');
}
