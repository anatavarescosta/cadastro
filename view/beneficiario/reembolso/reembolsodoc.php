<div class="container">
	<input type="hidden" name="testeSoli" id="testeSoli">
	<form action="<?php echo HOME_URI; ?>/beneficiario/solicitacao/a/p2" method="post" id="formSolBene" onSubmit="return validaForm('formSolBene')">
		<div class="row mb-4">
			<h4>
				<span class=" align-bottom material-symbols-outlined">
					upload_file
                </span>
				Anexar os documentos
			</h4>
		</div>

		<div class="alert alerta-atencao mb-4" role="alert">
			<p class="m-0">Caso algum documento não seja enviado corretamente, o protocolo ficará parado aguardando a correção pelo beneficiário.</p>
		</div>

		<div class="row">
			<div class="col-md-12 bloco">
				<div class="accordion" id="itensReembolso">
					<div class="accordion-item">
						<h2 class="accordion-header">						
							<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<span class=" align-bottom material-symbols-outlined">
									keyboard_double_arrow_right
								</span>	
								Item - #1
							</button>
						</h2>
						<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#itensReembolso">
							<div class="accordion-body">

								<div class="row">
									<div class="col-md-6">
										<span><b>Médico:</b> 123 - Fulano de tal </span><br>
										<span><b>Pocedimento:</b> 30103930 - Abcesso de unha (Drenagem)</span><br>
										<span><b>Data Realização:</b> 22/06/2023</span><br>
										<span><b>Urgência:</b> 1 <b>Motivo:</b> Teste</span><br>
									</div>
									<div class="col-md-6">
										<span><b>Prestador:</b> Executante Teste </span><br>
										<span><b>CPF:</b> 101.010.101-22</span><br>
										<span><b>Documento:</b> Recibo <b>N°:</b> 123456</span><br>
										<span><b>Valor: 200,00</b></span><br>
									</div>										
								</div>

								<div class="alert alerta-informativo mt-3 mb-3" role="alert">
									<p class="m-0">
										<b>FORMULÁRIO</b>,
										Este formulário deve ser impresso, assinado e anexado ao pedido. <a href="#!">Clique aqui para Baixar</a>
									</p>
								</div>		
								
								<div class="row mb-2">
									<div class="col-md-3">
										<p>Formulário Assinado</p>
									</div>
									<div class="col-md-9 linhaArquivo">								
										<input type="file" name="file[]" id="upJusComp" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>
								
								<div class="row mb-2">
									<div class="col-md-3">
										<p>Certificado</p>
									</div>
									<div class="col-md-9 linhaArquivo">							
										<input type="file" name="file[]" id="upLaudoExame" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>

								<div class="row mb-2">
									<div class="col-md-3">
										<p>Laudo / Relatório</p>
									</div>
									<div class="col-md-9 linhaArquivo">								
										<input type="file" name="file[]" id="upJusComp" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>	

								<div class="row mb-2">
									<div class="col-md-3">
										<p>Nota Fiscal</p>
									</div>
									<div class="col-md-9 linhaArquivo">							
										<input type="file" name="file[]" id="upLaudoExame" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>

								<div class="row mb-2">
									<div class="col-md-3">
										<p>Recibo</p>
									</div>
									<div class="col-md-9 linhaArquivo">							
										<input type="file" name="file[]" id="upLaudoExame" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>

								<div class="row mb-2">
									<div class="col-md-3">
										<p>Procuração Publica (Jurídico)</p>
									</div>
									<div class="col-md-9 linhaArquivo">								
										<input type="file" name="file[]" id="upJusComp" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>	
								<div class="row mb-2">
									<div class="col-md-3">
										<p>Parecer</p>
									</div>
									<div class="col-md-9 linhaArquivo">							
										<input type="file" name="file[]" id="upLaudoExame" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>

								<div class="row mb-2">
									<div class="col-md-3">
										<p>Negativa</p>
									</div>
									<div class="col-md-9 linhaArquivo">								
										<input type="file" name="file[]" id="upJusComp" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>																		
																
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header">									
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								<span class=" align-bottom material-symbols-outlined">
									keyboard_double_arrow_right
								</span>									
								Item - #2
							</button>
						</h2>
						<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#itensReembolso">
							<div class="accordion-body">
								
							<div class="row">
									<div class="col-md-6">
										<span><b>Médico:</b> 123 - Fulano de tal </span><br>
										<span><b>Pocedimento:</b> 30103930 - Abcesso de unha (Drenagem)</span><br>
										<span><b>Data Realização:</b> 22/06/2023</span><br>
										<span><b>Urgência:</b> 1 <b>Motivo:</b> Teste</span><br>
									</div>
									<div class="col-md-6">
										<span><b>Prestador:</b> Executante Teste </span><br>
										<span><b>CPF:</b> 101.010.101-22</span><br>
										<span><b>Documento:</b> Recibo <b>N°:</b> 123456</span><br>
										<span><b>Valor: 200,00</b></span><br>
									</div>										
								</div>

								<div class="alert alerta-informativo mt-3 mb-3" role="alert">
									<p class="m-0">
										<b>FORMULÁRIO</b>,
										Este formulário deve ser impresso, assinado e anexado ao pedido. <a href="#!">Clique aqui para Baixar</a>
									</p>
								</div>		
								
								<div class="row mb-2">
									<div class="col-md-3">
										<p>Formulário Assinado</p>
									</div>
									<div class="col-md-9 linhaArquivo">								
										<input type="file" name="file[]" id="upJusComp" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>
								
								<div class="row mb-2">
									<div class="col-md-3">
										<p>Certificado</p>
									</div>
									<div class="col-md-9 linhaArquivo">							
										<input type="file" name="file[]" id="upLaudoExame" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>

								<div class="row mb-2">
									<div class="col-md-3">
										<p>Laudo / Relatório</p>
									</div>
									<div class="col-md-9 linhaArquivo">								
										<input type="file" name="file[]" id="upJusComp" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>	

								<div class="row mb-2">
									<div class="col-md-3">
										<p>Nota Fiscal</p>
									</div>
									<div class="col-md-9 linhaArquivo">							
										<input type="file" name="file[]" id="upLaudoExame" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>

								<div class="row mb-2">
									<div class="col-md-3">
										<p>Recibo</p>
									</div>
									<div class="col-md-9 linhaArquivo">							
										<input type="file" name="file[]" id="upLaudoExame" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>

								<div class="row mb-2">
									<div class="col-md-3">
										<p>Procuração Publica (Jurídico)</p>
									</div>
									<div class="col-md-9 linhaArquivo">								
										<input type="file" name="file[]" id="upJusComp" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>	
								<div class="row mb-2">
									<div class="col-md-3">
										<p>Parecer</p>
									</div>
									<div class="col-md-9 linhaArquivo">							
										<input type="file" name="file[]" id="upLaudoExame" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>

								<div class="row mb-2">
									<div class="col-md-3">
										<p>Negativa</p>
									</div>
									<div class="col-md-9 linhaArquivo">								
										<input type="file" name="file[]" id="upJusComp" class="form-control" accept=".pdf, .png, .jpg, .jpeg">
									</div>						
								</div>							

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4 mt-4">
			<h4>
				<span class=" align-bottom material-symbols-outlined">
					comment
				</span>	
				Mensagem
			</h4>
			<div class="col-md-12 bloco">
				<div class="row">
					<div class="col-md-12">
						<span><textarea name="" cols="2" rows="10"></textarea></span><br>						
					</div>
				</div>
			</div>
		</div>
	
	</form>
</div>
