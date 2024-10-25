<?php
get_header();
?>

<div class="container">
	<input type="hidden" name="testeSoli" id="testeSoli">
	<form action="<?php echo HOME_URI; ?>/beneficiario/solicitacao/a/p2" method="post" id="formSolBene" onSubmit="return validaForm('formSolBene')">
		<div class="row mb-4">
			<h4>
				<span class=" align-bottom material-symbols-outlined">
					person
				</span>
				Informações Pessoais
			</h4>
			<div class="col-md-12 bloco">
				<div class="row">
					<div class="col-md-8">
						<span><b>Número da Carteira:</b> 0 034 000000000000</span><br>
						<span><b>Nome:</b> João de Beltrano da Silva</span><br>
						<span><b>Nome Social: Maria de Beltrano da Silva</b></span><br>
					</div>
					<div class="col-md-4">
						<span><b>CPF:</b> 000.000.000-00</span><br>
						<span><b>RG:</b> 00.00.000</span><br>
						<span><b>Nascimento:</b> 01/02/1987</span>
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4">
			<h4>
				<span class=" align-bottom material-symbols-outlined">
					contacts
				</span>				
				Contato
			</h4>
			<div class="col-md-12 bloco">
				<div class="row">
					<div class="col-md-6">
						<input type="text" name="email" id="email" placeholder="Email">
					</div>				
					<div class="col-md-3">
						<input type="text" name="telFixo" id="telFixo" placeholder="Telefone fixo">
					</div>
					<div class="col-md-3">
						<input type="text" name="telCel" id="telCel" placeholder="Celular">
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4">
			<h4>
				<span class=" align-bottom material-symbols-outlined">
					home_health
				</span>
				Dados do Plano de Saúde
			</h4>
			<div class="col-md-12 bloco">
				<div class="row">
					<div class="col-md-6">
						<span><b>Registro:</b> 492625221</span><br>
						<span><b>Produto:</b> Unirede Recife - If - Basico - Com Obst - Com Coparticipação </span>
					</div>
					<div class="col-md-6">
						<span><b>Tipo Contratação:</b> Individual ou Familiar</span><br>
						<span><b>Regulamentação:</b> Plano Regulamentado</span>
					</div>
				</div>
			</div>
		</div>		

		<div class="row mb-4">
			<h4>
				<span class=" align-bottom material-symbols-outlined">
					checklist
				</span>
				Dados pedido do reembolso
			</h4>
			<div class="col-md-12 bloco">

				<div class="row">

					<div class="col-md-12">
						<b class="pergunta-atendimento" id="tipoPrestador">Tipo do Prestador:</b>
						<input type="radio" name="tPrest" value="Sim"><label for="Sim">Físico</label>
						<input type="radio" name="tPrest" value="Não"><label for="Não">Jurídico</label>
					</div>

					<div class="col-md-2">
						<input type="text" name="crm" id="crm" placeholder="CRM" onkeypress="return somenteNumeros(event)">
					</div>
									
					<div class="col-md-7">
						<input type="text" name="nomeMed" id="nomeMed" placeholder="Nome do Médico">
					</div>

					<div class="col-md-3">
						<select name="espMed" id="espMed">
							<option value="0">Especialidade médica</option>
							<option value="1">Clínica Médica</option>
							<option value="2">Ortopedia e Traumatologia</option>
						</select>
					</div>

					<div class="col-md-3 mt-3">
						<input type="text" name="codProcedimento" id="codProcedimento" placeholder="Código Procedimento" onkeypress="return somenteNumeros(event)">
					</div>

					<div class="col-md-9 mt-3">
						<input type="text" name="nomeProcedimento" id="nomeProcedimento" placeholder="Nome do Procedimento">
					</div>

					<div class="col-md-12">
						<b class="pergunta-atendimento">Comprovante:</b>
						<input type="radio" name="comprovante" value="Sim"><label for="Sim">Nota Fiscal</label>
						<input type="radio" name="comprovante" value="Não"><label for="Não">Recibo</label>
					</div>

					<div class="col-md-3">
						<input type="text" name="dtProcedimento" id="dtProcedimento" placeholder="Data Procedimento">
					</div>	

					<div class="col-md-4">
						<input type="text" name="valProcedimento" id="valProcedimento" placeholder="Valor Procedimento">
					</div>

					<div class="col-md-12 mt-3">
						<button type="submit" class="btn btn-primary" id="btn_addProcedimento">Adicionar Procedimento</button>
					</div>

				</div>				

			</div>
		</div>

		<div class="col-md-12 mb-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="titulo-linha">
                                    <th class="txtBold">Item:</th>
                                    <th class="txtBold">Nome:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="verdeb-txt">
                                    <td>165847293</td>
                                    <td>jahd iuhaksjd kjhaisdsaf d uaid </td>
                                </tr>
                                <tr class="verdeb-txt">
									<td>165847293</td>
                                    <td>jahd iuhaksjd kjhaisdsaf d uaid </td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 

		<div class="row mb-4">
			<h4>
				<span class=" align-bottom material-symbols-outlined">
					comment
				</span>	
				Motivo da solicitação de Reembolso
			</h4>
			<div class="col-md-12 bloco">
				<div class="row">
					<div class="col-md-12">
						<textarea name="obsSolicitacao" id="obsSolicitacao" cols="30" rows="5"></textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4">
			<h4>
				<span class=" align-bottom material-symbols-outlined">
					account_balance
				</span>
				Dados Bancário
			</h4>
			<div class="col-md-12 bloco">
			
				<div class="row">
					<div class="col-md-12">
						<b class="pergunta-atendimento" id="respContrato">Responsável contratual:</b>
						<input type="radio" name="rspContrato" value="Sim"><label for="Sim">Sim</label>
						<input type="radio" name="rspContrato" value="Não"><label for="Não">Não</label>
					</div>
				
					<div class="col-md-8">
						<input type="text" name="nomeRecebSoli" id="nomeRecebSoli" placeholder="Nome Recebedor/Solicitante">
					</div>

					<div class="col-md-2">
						<input type="text" name="cpf" id="cpf" placeholder="CPF" onkeypress="return somenteNumeros(event)">
					</div>

					<div class="col-md-2">
						<input type="text" name="rg" id="rg" placeholder="RG" onkeypress="return somenteNumeros(event)">
					</div>

					<div class="col-md-12">
						<b class="pergunta-atendimento" id="tipoConta">Tipo da conta:</b>
						<input type="radio" name="tpConta" value="Sim"><label for="Sim">Corrente</label>
						<input type="radio" name="tpConta" value="Não"><label for="Não">Poupança</label>
					</div>

					<div class="col-md-12 mt-2 mb-3">
						<select name="selBanco" id="selBanco">
							<option value="0">Escolha o Banco</option>
							<option value="1">Itaú</option>
							<option value="2">Banco do Brasil</option>
							<option value="2">Santander</option>
							<option value="2">Caixa Econômica</option>
						</select>
					</div>

					<div class="col-md-3">
						<input type="text" name="agencia" id="agencia" placeholder="Agência" onkeypress="return somenteNumeros(event)">
					</div>	

					<div class="col-md-4">
						<input type="text" name="conta" id="conta" placeholder="Número da Conta">
					</div>

				</div>
						
			</div>
		</div>	


		
		<div class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary" id="btn_enviaSolicitacao">Enviar Solicitação</button>
			</div>
		</div>
	
	</form>

</div>

<?php
get_footer();
?>