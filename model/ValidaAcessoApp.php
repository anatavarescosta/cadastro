<?php
class ValidaAcessoApp{
    
    public function validar($codUnimed,$carteira,$token){
        $url = "https://guiamed-sml.unimedrecife.com.br:9191/unimedrecife/Validacredenciais/$carteira/$codUnimed";
        $headers = [
            "Accept: application/json",
            "Username:unimedrecife",
            "Identify:816aaa526f83d5d199e20079f6aea035",
            "Token:$token",
        ];

        $ch = curl_init();        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);   
            
        $conteudoJson = curl_exec($ch);
        $acesso = json_decode($conteudoJson);

        curl_close($ch);

        return $acesso;
    }
}
?>