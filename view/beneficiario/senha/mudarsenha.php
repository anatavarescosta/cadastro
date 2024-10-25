<?php
    get_header();
?>
<body>

<div class="container mt-4">
    <h5>MUDAR A SENHA</h5> 
    <div class="row">
        <div class="col-md-4">
            <form name="frmTsenha" id="frmTsenha" action="mudarsenha/gravar" method="post" onsubmit="return validasenha()">
                <div class="form-group">
                    <label for="senha">Nova Senha</label>
                    <input type="password" class="form-control" id="senhaUsuario" name="senhaUsuario" placeholder="Nova Senha">
                    <a href="#" onclick="verSenha('senhaUsuario')">Ver senha</a>
                </div>
                <div class="form-group">
                    <label for="rsenha">Repita a senha</label>
                    <input type="password" class="form-control" id="senhaUsuarioConfirmacao" name="senhaUsuarioConfirmacao" placeholder="Repita a senha">
                    <a href="#" onclick="verSenha('senhaUsuarioConfirmacao')">Ver senha</a>
                </div>                
                <button type="submit" class="btn btn-success btn-block mt-4" id="salvar">  Alterar  </button>
            </form>        
        </div>
        <div class="col-md-4">
            <ul>
                <li id="caracteres" class="">Mínimo de 8 caracteres.</li>
                <li id="carac-mai" class="">Mínimo de 1 caracter Maiúsculo.</li>
                <li id="carac-min" class="">Mínimo de 1 caracter Minusculo.</li>
                <li id="numero" class="">Mínimo de 1 Número.</li>
                <li id="carac-esp" class="">Mínimo de 2 caracteres especiais.</li>
                <li id="txt-senha" class="">As senhas são iguais.</li>
            </ul>
        </div> 
        <div class="col-md-4"></div>
    </div>

</div>
<script src="<?php echo HOME_URI;?>/public/js/validasenha.js"></script>

<?php get_footer(); ?>