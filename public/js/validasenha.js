function validasenha(){
    var numeros = /[0-9]/;
    var alfabetoMin = /[a-z]/;
    var alfabetoMai = /[A-Z]/;
    var chEspeciais = /[~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<]/g;
    var conteudo = $("#senhaUsuario").val();
    var ef = 0;
    
    if(conteudo.length < 8){
        $("#caracteres").removeClass("verdeb-txt");
        $("#caracteres").addClass("magenta-txt"); 
        $("#txt-senha").addClass("magenta-txt");
        ef = 1;
    } else {
        $("#caracteres").removeClass("magenta-txt");
        $("#caracteres").addClass("verdeb-txt"); 
    }
    if((!conteudo.match(chEspeciais)) || (conteudo.match(chEspeciais).length < 2)){
        $("#carac-esp").removeClass("verdeb-txt");
        $("#carac-esp").addClass("magenta-txt"); 
        ef = 1;
    } else {
        $("#carac-esp").removeClass("magenta-txt");
        $("#carac-esp").addClass("verdeb-txt"); 
    }
    if(!conteudo.match(numeros)){
        $("#numero").removeClass("verdeb-txt");
        $("#numero").addClass("magenta-txt"); 
        ef = 1;
    } else {
        $("#numero").removeClass("magenta-txt");
        $("#numero").addClass("verdeb-txt"); 
    }
    if(!conteudo.match(alfabetoMin)){
        $("#carac-min").removeClass("verdeb-txt");
        $("#carac-min").addClass("magenta-txt"); 
        ef = 1;
    } else {
        $("#carac-min").removeClass("magenta-txt");
        $("#carac-min").addClass("verdeb-txt"); 
    }
    if(!conteudo.match(alfabetoMai)){
        $("#carac-mai").removeClass("verdeb-txt");
        $("#carac-mai").addClass("magenta-txt"); 
        ef = 1;
    }  else {
        $("#carac-mai").removeClass("magenta-txt");
        $("#carac-mai").addClass("verdeb-txt"); 
    } 
    if($("#senhaUsuario").val() != $("#senhaUsuarioConfirmacao").val()){
        $("#txt-senha").removeClass("verdeb-txt");
        $("#txt-senha").addClass("magenta-txt"); 
        ef = 1;
    }  else if(($("#senhaUsuario").val() == "") || ($("#senhaUsuarioConfirmacao").val() == "")) {
        $("#txt-senha").removeClass("verdeb-txt");
        $("#txt-senha").addClass("magenta-txt"); 
        ef = 1;
    } else {
        $("#txt-senha").removeClass("magenta-txt");
        $("#txt-senha").addClass("verdeb-txt"); 
    }   

    if(ef == 0){
        return true;
    } else {
        return false;
    }    
    
}
function verSenha(){
    $("#senhaUsuario").attr('type', 'text');
    $("#senhaUsuarioConfirmacao").attr('type', 'text');
}