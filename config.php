<?php
/**
 * Configuração geral
 */

// Caminho para a raiz
define( 'ABSPATH', dirname( __FILE__ ) );

// URL da home
//define('HOME_URI', 'http://localhost/autorizador' );
//define('HOME_URI', 'https://'.$_SERVER['SERVER_NAME'] );
define('HOME_URI', 'http://'.$_SERVER['SERVER_NAME'].':8888/cadastro' );

// Nome do host da base de dados
define( 'HOSTNAME', '10.10.10.3' );

// Nome do DB
define( 'DB_NAME', 'atualizacad' );

// Usuário do DB
define( 'DB_USER', 'root' );

// Senha do DB
define( 'DB_PASSWORD', '' );

// Charset da conexão PDO
define( 'DB_CHARSET', 'utf8' );

// Se você estiver desenvolvendo, modifique o valor para true
define( 'DEBUG', true );

define('NOMESISTEMA','Atualização Cadastral');
define('VERSAOSISTEMA','v. 2.0');

define('LIST_BLOQ_UNIMED', array('037'));



/**
 * Não edite daqui em diante
 */

// Carrega o loader, que vai carregar a aplicação inteira
//require_once ABSPATH . '/loader.php';
?>