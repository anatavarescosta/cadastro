// JavaScript Document
function validarData(campo){
	
	var expReg = /^(([0-2]\d|[3][0-1])\/([0]\d|[1][0-2])\/[1-2][0-9]\d{2})$/;
	var msgErro = 'Formato inválido de data.';
	//alert(campo);
	if ((campo.value.match(expReg)) && (campo.value!='')){
		
		var dia1 = campo.value.substring(0,2);
		var mes1 = campo.value.substring(3,5);
		var ano1 = campo.value.substring(6,10);
		
		data1 = ano1 +"-"+ mes1 +"-"+ dia1;
		
		now = new Date();
		
		var dia2 = now.getDate();
		var mes2 = now.getMonth()+1;
		var ano2 = now.getFullYear();		
		
		data2 = ano2 +"-"+ mes2 +"-"+ dia2;
		
		//alert(ano1+mes1+dia1+"-"+ano2+mes2+dia2)
		
		if (data1 > data2){
			alert("Data incorreta !!! \nA data não pode ser maior que a data de hoje.");
			campo.value = "";
			return false;
		}else{
			return true;	
		}
		
		/*	if(mes==4 || mes==6 || mes==9 || mes==11 && dia > 30){
				alert("Dia incorreto !!! O mês especificado contém no máximo 30 dias.");
				return false;
			} else{
				if(ano%4!=0 && mes==2 && dia>28){
					alert("Data incorreta!! O mês especificado contém no máximo 28 dias.");
					return false;
				} else{
					if(ano%4==0 && mes==2 && dia>29){
						alert("Data incorreta!! O mês especificado contém no máximo 29 dias.");
						return false;
					}
				}
			}*/
	} else {
		alert(msgErro);
		campo.value = "";
		campo.focus();
		return false;
	}
}
