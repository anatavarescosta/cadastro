<?php 
function encriptar($pValor) {
	return base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($pValor)))));
}

function decriptar($pValor) {
	return base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($pValor)))));
}
?>