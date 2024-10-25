function aceite(){
    myModal = new bootstrap.Modal(document.getElementById('modalLgpd'), {
        //keyboard: true
    })
    myModal.show();
}

function aceiteRecusa(){
    window.location.assign(window.location.origin)
}

function aceiteSim(){
    ajax = ajaxInit();
	if(ajax) {
	   ajax.open("GET","view/beneficiario/beneficiario/validalgpd.php",false);
	   ajax.onreadystatechange = function() {
		 if(ajax.readyState == 4) {
		    if(ajax.status == 200) {		
                myModal.hide();
		    }
		 }
	   }
	   ajax.send(null);
	}
}