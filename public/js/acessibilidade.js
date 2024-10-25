/// ALTERAR TAMANHO DA FONTE
function fonte(e){
	/*var elementos = $(".acessibi p, a, h1, h2, h3, h4, h5, h6, ul, ol");*/
    var elementos = $(".acessibi");
  	var fonte = elementos.css('font-size');     
	if (e == 'a') {		
		elementos.css("fontSize", parseInt(fonte) + 1);
	} else if('d'){
		elementos.css("fontSize", parseInt(fonte) - 1);
	}
}

/// ALTERAR CONTRASTE DO SITE

	// Quando carregar a página
$(function($) {
	// Quando clicado em uma imagem das caixas
	$('#acessb ul li a#btContraste').click(function() {
		//alert("#flag");
		// Recuperando ID da DIV da qual a imagem se encontra
        var id = $("body").find("form main").attr('id');
		
		//alert(id)
		var conteudo = $('#'+id);		
		//alert(conteudo.value)	
        if ($("#flag").val() == 0){
                $.cookie(id, 0, {expires: 365});
				conteudo.css("background-color", "white");			
				conteudo.append($("<link rel='stylesheet' href='./css/branco.css' type='text/css' media='screen' />"));			
				/*$("body").attr("../css/branco.css");*/
				$("#flag").val(0); 
			
		}else if ($("#flag").val() == 1){
				$.cookie(id, 1, {expires: 365});
               	conteudo.css("background-color", "black");
				conteudo.append($("<link rel='stylesheet' href='./css/preto.css' type='text/css' media='screen' />"));
				/*$("body").attr("../css/preto.css");*/
				$("#flag").val(1);
			
		}
	});   
}); 		

// Procurando e passando por cada box da página
//document.querySelector("body").setAttribute("id", setId);
$(function($) {
	$("body").find("form main").each(function(){
	//alert();
    // Recuperando ID
	var id = $(this).attr('id');	
    // Armazendo elemento que será oculto
    var conteudo = $('#'+id);	
	//alert(conteudo);
    // Caso ele não tenha sido criado
	if ($.cookie(id) == null){
        // Ocultamos
        //conteudo.css("display", "none");				
		conteudo.css("background-color", "white");
		conteudo.append($("<link rel='stylesheet' href='../view/css/branco.css' type='text/css' media='screen' />"));
    // Se um cookie foi criado e está com 1, ou seja, visível
	}else if ($.cookie(id) == 1){
        // Exibimos      	
    	// Se um cookie foi criado e está com 0, ou seja, oculto			
		conteudo.css("background-color", "black");
		conteudo.append($("<link rel='stylesheet' href='../view/css/preto.css' type='text/css' media='screen' />"));
		
	}else if ($.cookie(id) == 0){
        // Exibimos     	
    	// Se um cookie foi criado e está com 0, ou seja, oculto		
		conteudo.css("background-color", "white");
		conteudo.append($("<link rel='stylesheet' href='../view/css/branco.css' type='text/css' media='screen' />"));
	}
	});    
});

function mostrar(flag){
	//alert(flag);
	if (flag == 0){
		document.form.flag.value = 1;	
		//document.getElementById('teste').style.backgroundColor = 'red';
	}else{
		document.form.flag.value = 0;			
		//document.getElementById('teste').style.backgroundColor = 'blue';
	}
}
