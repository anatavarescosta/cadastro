<?php


$SQL = "select * from ( ";
$SQL = $SQL ." SELECT h.codhistoricoprotocolo,h.carteira,(select b.nome from beneficiario b where h.carteira = b.carteira and h.codunimed = b.codunimed and b.codunimed = '034' limit 1 union select i.nome from intercambio i where h.carteira = i.carteira and h.codunimed = i.codunimed and i.codunimed <> '034' limit 1) as nome,h.codunimed,h.protocolo,h.protocoloanterior,h.manifestacao,h.subcategoria,h.resolvido,h.mensagem,date_format(h.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro,date_format(h.dataregistro,'%d/%m/%Y') as datareg,date_format(h.dataregistro,'%H:%i:%s') as horareg,date_format(h.datafinalizada,'%d/%m/%Y') as datafinal,date_format(h.datafinalizada,'%H:%i:%s') as horafinal,h.codusuario,h.unidade,h.referencia,(select b.titularidade from beneficiario b where h.carteira = b.carteira and h.codunimed = b.codunimed and b.codunimed = '034' union select '0' as titularidade from intercambio i where h.carteira = i.carteira and h.codunimed = i.codunimed and i.codunimed <> '034')  as titularidade,h.flag as pegou,h.codusuariofinalizado,date_format(h.datafinalizada,'%d/%m/%Y %H:%i:%s') as datafinalizada,h.codespecialidade,h.codprofissional,h.tipoagendamento,pe.codstatus as livre,(select ct.nome from categoria ct where ct.id_categoria = h.categoria) as categoria,(select s.nome from tipo_sentimento s where s.codtiposentimento = h.sentimento) as sentimento,(select cn.nome from canalatendimentoprotocoloans cn where cn.codcanalatendimento = h.codcanalatendimento) as canal,h.dataregistro as dataordena ";
$SQL = $SQL ." from historicoprotocolo h,protocoloansxetapas pe ";
if ($plano != ""){
    $SQL = $SQL ." inner join beneficiario b on (h.carteira = b.carteira and h.codunimed = b.codunimed and b.codunimed = '034' and b.codplano in(".$plano.")) ";
}
$SQL = $SQL ." where pe.codhistoricoprotocolo = h.codhistoricoprotocolo and pe.flag = 1 ";
if ($finalizado != 0){   
    if ($colaborador != ""){
        $SQL = $SQL ." and pe.codstatus = 6 and pe.codusuario = ".$colaborador;
    }else{
        $SQL = $SQL ." and pe.codstatus = 6 ";
    }
}else{
    if ($colaborador != ""){
        $SQL = $SQL ." and pe.codusuario = ".$colaborador." ";
    }
}
if ($solicitante == 24){
    $SQL = $SQL ." and h.unidade =".$solicitante." ";
}
if (($data1 != "") and ($data2 != "")){
    $ano = date("Y")-1;
    if ($arraydata1[2] < $ano){
        $SQL = $SQL ." and h.dataregistro between '"."2022"."-"."01"."-"."01"." 00:00:01' AND  '".$arraydata2[2]."-".$arraydata2[1]."-".$arraydata2[0]." 23:59:59' ";
    }else{
        $SQL = $SQL ." and h.dataregistro between '".$arraydata1[2]."-".$arraydata1[1]."-".$arraydata1[0]." 00:00:01' AND  '".$arraydata2[2]."-".$arraydata2[1]."-".$arraydata2[0]." 23:59:59' ";
    }
}
if ($protocolo != ""){
$SQL = $SQL ." and h.protocoloanterior = '".$protocolo."' ";
//$SQL = $SQL ." and h.protocolo = '".$protocolo."'";
}
if ($status != ""){
    if ($substatus != ""){
        $SQL = $SQL ." and pe.codstatus in(".$status.") and pe.codsubstatus = ".$substatus;
    }else{
        $SQL = $SQL ." and pe.codstatus in(".$status.") ";
    }
}
if ($setor != ""){
    $SQL = $SQL ." and exists (select et.protocolo from protocoloansxetapas et where et.codhistoricoprotocolo = h.codhistoricoprotocolo and et.codstatus in(".$setor.") and et.codusuario in (select p.codusuario from usuario u,perfilxusuario p where u.codusuario = p.codusuario and u.codusuario = pe.codusuario)       
                              ) ";
}
if ($carteira != ""){
$SQL = $SQL ." and h.carteira = '".$carteira."'";
$SQL = $SQL ." and h.codunimed = '".$codunimed."'";
}
if ($solicitante != ""){
    if ($solicitante != 24){
        $SQL = $SQL." and h.unidade = ".$solicitante;
    }
}
if ($tipocarteira != ""){
    if ($tipocarteira == "034"){
        $SQL = $SQL ." and h.codunimed = '034'";
    }else{
        $SQL = $SQL ." and h.codunimed <> '034'";
    }
}
if ($manifestacao != ""){
    $SQL = $SQL." and h.manifestacao = ".$manifestacao;
}
if ($categoria != ""){
    $SQL = $SQL." and h.categoria = ".$categoria;
}
if ($sentimento != ""){
    $SQL = $SQL." and h.sentimento = ".$sentimento;
}   
if ($_REQUEST["especialidade"] != ""){
    if ($tipoagendamento[1] == 1){
        $SQL = $SQL." and h.codespecialidade = ".$tipoagendamento[0];
        /*$SQL = $SQL." and h.codhistoricoprotocolo in ( ";
        $SQL = $SQL." select distinct he.codhistoricoprotocolo from historicoprotocoloxespecialidade he where he.codhistoricoprotocolo = h.codhistoricoprotocolo and he.codespecialidade = ".$especialidade.")";*/
    }else{
        $SQL = $SQL." and h.codprofissional = ".$tipoagendamento[0];
        /*$SQL = $SQL." and h.codhistoricoprotocolo in ( ";
        $SQL = $SQL." select distinct hp.codhistoricoprotocolo from historicoprotocoloxprofissionalsaude hp where hp.codhistoricoprotocolo = h.codhistoricoprotocolo and hp.codprofissionalsaude =".$medico.")";*/
    }
}
if ($cancelar == 1){
    $SQL = $SQL." and h.codusuariofinalizado is not null ";
}
if ($classificacao != ""){
    $SQL = $SQL." and h.codhistoricoprotocolo = (select c.codhistoricoprotocolo from classificacaojudicialprotocoloansxprotocoloans c where c.codhistoricoprotocolo  =  h.codhistoricoprotocolo and c.protocolo = h.protocolo and c.codclassificacaojudicialprotocoans = ".$classificacao.")";   
}
$SQL = $SQL." and h.referencia = 'P' ";
if ($cancelar == 1){
    $SQL = $SQL." and h.codusuariofinalizado is not null ";
}else{
    $SQL = $SQL." and h.codusuariofinalizado is null ";
}
if ($canal != "") {
    $SQL = $SQL." and h.codcanalatendimento = ".$canal;
}

$SQL = $SQL." UNION ";
$SQL = $SQL." SELECT h.codhistoricoprotocolo,h.carteira,(select b.nome from beneficiario b where h.carteira = b.carteira and h.codunimed = b.codunimed and b.codunimed = '034' limit 1 union select i.nome from intercambio i where h.carteira = i.carteira and h.codunimed = i.codunimed and i.codunimed <> '034' limit 1) as nome,h.codunimed,h.protocolo,h.protocoloanterior,h.manifestacao,h.subcategoria,h.resolvido,h.mensagem,date_format(h.dataregistro,'%d/%m/%Y %H:%i:%s') as dataregistro,date_format(h.dataregistro,'%d/%m/%Y') as datareg,date_format(h.dataregistro,'%H:%i:%s') as horareg,date_format(h.datafinalizada,'%d/%m/%Y') as datafinal,date_format(h.datafinalizada,'%H:%i:%s') as horafinal,h.codusuario,h.unidade,h.referencia,(select b.titularidade from beneficiario b where h.carteira = b.carteira and h.codunimed = b.codunimed and b.codunimed = '034' union select '0' as titularidade from intercambio i where h.carteira = i.carteira and h.codunimed = i.codunimed and i.codunimed <> '034')  as titularidade,h.flag as pegou,h.codusuariofinalizado,date_format(h.datafinalizada,'%d/%m/%Y %H:%i:%s') as datafinalizada,h.codespecialidade,h.codprofissional,h.tipoagendamento,pe.codstatus as livre,(select ct.nome from categoria ct where ct.id_categoria = h.categoria) as categoria,(select s.nome from tipo_sentimento s where s.codtiposentimento = h.sentimento) as sentimento,(select cn.nome from canalatendimentoprotocoloans cn where cn.codcanalatendimento = h.codcanalatendimento) as canal,h.dataregistro as dataordena ";
$SQL = $SQL ." from historicoprotocolo h,protocoloansxetapas pe";
if ($plano != ""){
    $SQL = $SQL ." inner join beneficiario b on (h.carteira = b.carteira and h.codunimed = b.codunimed and b.codunimed = '034' and b.codplano in(".$plano.")) ";
}
$SQL = $SQL ." where pe.codhistoricoprotocolo = h.codhistoricoprotocolo and pe.flag = 1 ";
if ($finalizado != 0){   
    if ($colaborador != ""){
        $SQL = $SQL ." and pe.codstatus = 6 and pe.codusuario = ".$colaborador;
    }else{
        $SQL = $SQL ." and pe.codstatus = 6 ";
    }
}else{
    if ($colaborador != ""){
        $SQL = $SQL ." and pe.codusuario = ".$colaborador." ";
    }
}
if ($solicitante == 24){
    $SQL = $SQL ." and h.unidade =".$solicitante." ";
}
if (($data1 != "") and ($data2 != "")){
    $ano = date("Y")-1;
    if ($arraydata1[2] < $ano){
        $SQL = $SQL ." and h.dataregistro between '"."2022"."-"."01"."-"."01"." 00:00:01' AND  '".$arraydata2[2]."-".$arraydata2[1]."-".$arraydata2[0]." 23:59:59' ";
    }else{
        $SQL = $SQL ." and h.dataregistro between '".$arraydata1[2]."-".$arraydata1[1]."-".$arraydata1[0]." 00:00:01' AND  '".$arraydata2[2]."-".$arraydata2[1]."-".$arraydata2[0]." 23:59:59' ";
    }
}
if ($protocolo != ""){
$SQL = $SQL ." and h.protocolo = '".$protocolo."' ";
//$SQL = $SQL ." and h.protocolo = '".$protocolo."'";
}
if ($status != ""){
    if ($substatus != ""){
        $SQL = $SQL ." and pe.codstatus in(".$status.") and pe.codsubstatus = ".$substatus;
    }else{
        $SQL = $SQL ." and pe.codstatus in(".$status.") ";
    }
}
if ($setor != ""){
    $SQL = $SQL ." and exists (select et.protocolo from protocoloansxetapas et where et.codhistoricoprotocolo = h.codhistoricoprotocolo and et.codstatus in(".$setor.") and et.codusuario in (select p.codusuario from usuario u,perfilxusuario p where u.codusuario = p.codusuario and u.codusuario = pe.codusuario)       
                              ) ";
}
if ($carteira != ""){
$SQL = $SQL ." and h.carteira = '".$carteira."'";
$SQL = $SQL ." and h.codunimed = '".$codunimed."'";
}
if ($solicitante != ""){
    if ($solicitante != 24){
        $SQL = $SQL." and h.unidade = ".$solicitante;
    }
}
if ($tipocarteira != ""){
    if ($tipocarteira == "034"){
        $SQL = $SQL ." and h.codunimed = '034'";
    }else{
        $SQL = $SQL ." and h.codunimed <> '034'";
    }
}
if ($manifestacao != ""){
    $SQL = $SQL." and h.manifestacao = ".$manifestacao;
}
if ($categoria != ""){
    $SQL = $SQL." and h.categoria = ".$categoria;
}
if ($sentimento != ""){
    $SQL = $SQL." and h.sentimento = ".$sentimento;
}   
if ($_REQUEST["especialidade"] != ""){
    if ($tipoagendamento[1] == 1){
        $SQL = $SQL." and h.codespecialidade = ".$tipoagendamento[0];
        /*$SQL = $SQL." and h.codhistoricoprotocolo in ( ";
        $SQL = $SQL." select distinct he.codhistoricoprotocolo from historicoprotocoloxespecialidade he where he.codhistoricoprotocolo = h.codhistoricoprotocolo and he.codespecialidade = ".$especialidade.")";*/
    }else{
        $SQL = $SQL." and h.codprofissional = ".$tipoagendamento[0];
        /*$SQL = $SQL." and h.codhistoricoprotocolo in ( ";
        $SQL = $SQL." select distinct hp.codhistoricoprotocolo from historicoprotocoloxprofissionalsaude hp where hp.codhistoricoprotocolo = h.codhistoricoprotocolo and hp.codprofissionalsaude =".$medico.")";*/
    }
}
if ($cancelar == 1){
    $SQL = $SQL." and h.codusuariofinalizado is not null ";
}
if ($classificacao != ""){
    $SQL = $SQL." and h.codhistoricoprotocolo = (select c.codhistoricoprotocolo from classificacaojudicialprotocoloansxprotocoloans c where c.codhistoricoprotocolo  =  h.codhistoricoprotocolo and c.protocolo = h.protocolo and c.codclassificacaojudicialprotocoans = ".$classificacao.")";   
}
$SQL = $SQL." and h.referencia = 'P' ";
if ($cancelar == 1){
    $SQL = $SQL." and h.codusuariofinalizado is not null ";
}else{
    $SQL = $SQL." and h.codusuariofinalizado is null ";
}
if ($canal != "") {
    $SQL = $SQL." and h.codcanalatendimento = ".$canal;
}
$SQL = $SQL." ) as w ";
$SQL = $SQL." group by w.carteira,w.protocolo ";
$SQL = $SQL." order by w.dataordena ";
$SQL = $SQL." LIMIT $limite OFFSET $inicial ";
//echo $SQL ;
//exit;
$result = mysql_query($SQL);
$total = mysql_num_rows($result);















?>