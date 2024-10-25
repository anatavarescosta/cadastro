<?php
class AcessaFtp {
    private $ftp_conn;

    public function __construct() {
        $this->ftp_conn = $this->conectarFtp();
    }

    private function conectarFtp() {
        $ftp_server = "10.10.10.3";
        $ftp_username = "unimedrecife";
        $ftp_password = "!ftpun!m3dr#c!f3#";

        $conn = ftp_connect($ftp_server);
        if (!$conn) {
            die("Não foi possível conectar ao servidor FTP Guias");
        }

        $login = ftp_login($conn, $ftp_username, $ftp_password);
        if (!$login) {
            die("Não foi possível fazer login no servidor FTP");
        }

        ftp_pasv($conn, true);

        return $conn;
    }

    public function fechaFtp() {
        ftp_close($this->ftp_conn);
    }

    public function buscar($caminhoAnx, $ext, $codAnx, $cont) {
        $remote_file = "autorizador/solicitacao/$caminhoAnx";
        $ext = ($ext == "peg") ? "jpeg" : $ext;
        $local_file_desc = ABSPATH . "/includes/downloads/beneficiario/anx-$codAnx-$cont.$ext";

        $retorno = ftp_get($this->ftp_conn, $local_file_desc, $remote_file, FTP_BINARY);
        //ftp_close($this->ftp_conn);

        return $retorno;
    }

    public function gravar($destino, $origem, $protocolo){
        $retorno = ftp_put($this->ftp_conn, $destino, $origem);
        //ftp_chmod($this->ftp_conn, 0777, $destino);

        return $retorno;
    }

    public function verificar($caminho){
        $retorno = ftp_nlist($this->ftp_conn,$caminho);

        return $retorno;
    }

    public function criarCaminho($caminho){
        if(ftp_mkdir($this->ftp_conn,$caminho)){ 
            ftp_chmod($this->ftp_conn, 0777, $caminho); 
            return true;
        } else {
            return false;
        }
    }

    /*
    public function removerCaminho($caminho){
        $retorno = ftp_nlist($this->$ftp_conn, $caminho);
        if (empty($retorno)) {
            return ftp_rmdir($ftp, $caminho);
        } else {
            echo "O diretório '$diretorio' não está vazio. Exclua o conteúdo primeiro.";
        }
    }
    */
}

?>