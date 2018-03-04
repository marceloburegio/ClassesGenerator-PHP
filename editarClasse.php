<?php
// Includes
require_once('config.inc.php');
require_once('classes/config.classes.php');

// Inicializando a Fachada
$objFachada = FachadaBDR::getInstance();

// Obtendo os dados via get
$intSistemaId = (int)    @$_GET['sistemaId'];
$strSubpacote = (string) @$_GET['subpacote'];

// Validando o SistemaId e Subpacote
if ($intSistemaId > 0 && !empty($strSubpacote)) {
	
	// Listando os sistemas
	$arrObjSistemas = $objFachada->listarSistemas();
	
	// Obtendo a classe básica
	$objClasseBasica = $objFachada->procurarClasse($intSistemaId, $strSubpacote);
	
	// Topo
	include_once('includes/incTopo.php');
?>
<!-- Lista de atributos -->
<script language="javascript" type="text/javascript">
var html_atributos = '';
<?php
	// Listando os atributos da classe básica
	$arrObjAtributos = $objClasseBasica->getAtributos();
	foreach ($arrObjAtributos as $objAtributo) {
?>
var html_atributos = html_atributos +
'	<div class="atributo">'+
'		<table cellspacing="1" cellpadding="2" border="0" bgcolor="#EEEEEE">'+
'			<tbody>'+
'				<tr>'+
'					<td class="atr_tipo">'+
'						<select name="tipoAtributos[]">'+
'							<option value=""> --- </option>'+
<?php
		foreach ($arrTiposAtributo as $arrTipoAtributo) {
?>
'							<option value="<?php echo $arrTipoAtributo[0];?>" <?php echo ($objAtributo->getTipo() == $arrTipoAtributo[0]) ? "selected=\"selected\"":"";?>><?php echo $arrTipoAtributo[1];?></option>'+
<?php
		}
?>
'						</select>'+
'					</td>'+
'					<td class="atr_nome"><input type="text" name="nomeAtributos[]" value="<?php echo $objAtributo->getNome();?>" /></td>'+
'					<td class="atr_desc"><input type="text" name="resumoAtributos[]" value="<?php echo $objAtributo->getResumo();?>" /></td>'+
'					<td class="atr_coluna"><input type="text" name="colunasBd[]" value="<?php echo $objAtributo->getColunaBd();?>" /></td>'+
'					<td class="atr_check" align="center">'+
'						<input type="checkbox" class="check_pk" <?php echo ($objAtributo->getChavePk()) ? "checked=\"checked\"":"";?>/>'+
'						<input type="hidden" name="atributosPk[]" class="atributosPk" value="<?php echo ($objAtributo->getChavePk()) ? "true":"false";?>" >'+
'					</td>'+
'					<td class="atr_excl" align="center"><a href="javascript:;" class="remover"><img src="imagens/excluir.gif" width="25" height="25" border="0" alt="Excluir" title="Excluir" /></a></td>'+
'					<td class="atr_mover" align="center"><img src="imagens/change.gif" width="31" height="25" border="0" alt="Mover" title="Mover" /></td>'+
'				</tr>'+
'			</tbody>'+
'		</table>'+
'	</div>';
<?php
	}
?>
</script>
<!-- <script language="javascript" type="text/javascript" src="js/jquery-ui-core-sortable-1.6rc2.min.js"></script> -->
<script language="javascript" type="text/javascript" src="js/jquery-ui-1.10.2.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="js/editarClasse.js.php?versao=1.0"></script>


<div id="box">
	<h3 class="box_label_filtro">Editando SubPacote: <?php echo $strSubpacote;?></h3>
	<div class="clear"></div>
</div>


<form id="formEditarClasse" action="xt_editarClasse.php" method="post">
<input type="hidden" name="sistemaIdAtual" value="<?php echo $intSistemaId;?>">
<input type="hidden" name="subpacoteAtual" value="<?php echo $strSubpacote;?>">

<div id="cls_info">
	<table cellspacing="2" cellspadding="2" border="0" bgcolor="#EEEEEE" align="center">
		<tr>
			<td><b>Sistema</b></td>
			<td>
				<select name="sistemaId">
					<option value=""> --- </option>
<?php
	foreach ($arrObjSistemas as $objSistema) {
?>
					<option value="<?php echo $objSistema->getSistemaId();?>" <?php echo ($objSistema->getSistemaId() == $intSistemaId) ? 'selected="selected"':'';?>><?php echo $objSistema->getNome();?></option>
<?php
	}
?>
				</select>
			</td>
		</tr>
		<tr>
			<td><b>Nome da Classe</b></td>
			<td><input type="text" name="nomeClasse" value="<?php echo $objClasseBasica->getNome();?>"/></td>
		</tr>
		<tr>
			<td><b>Resumo</b></td>
			<td><input type="text" name="resumoClasse" value="<?php echo $objClasseBasica->getResumo();?>"/></td>
		</tr>
		<tr>
			<td><b>Autor</b></td>
			<td><input type="text" name="autorClasse" value="<?php echo $objClasseBasica->getAutor();?>"/></td>
		</tr>
		<tr>
			<td><b>Tabela do BDR</b></td>
			<td><input type="text" name="tabelaBd" value="<?php echo $objClasseBasica->getTabelaBd();?>"/></td>
		</tr>
		<tr>
			<td><b>Nova Vers&atilde;o</b></td>
			<td><input type="checkbox" name="novaVersao" value="true" <?php if ($objClasseBasica->getNovaVersao()) echo 'checked="checked"'; ?>/></td>
		</tr>
		<tr>
			<td><b>NameSpace</b></td>
			<td><input type="text" name="nameSpace" value="<?php echo $objClasseBasica->getNameSpace();?>"/></td>
		</tr>
	</table>
</div>
<br/>


<div id="conteudo_atributos">
	<!-- Ação: adicionar atributo -->
	<div align="center"><a href="javascript:;" id="adicionar"><b>Adicionar Atributo</b></a></div>
	<br/>
	
	<!-- Cabeçalho dos atributos -->
	<table cellspacing="1" cellpadding="2" border="0" bgcolor="#DDDDDD">
		<tr>
			<td class="atr_tipo"><b>Tipo</b></td>
			<td class="atr_nome"><b>Nome</b></td>
			<td class="atr_desc"><b>Descricao</b></td>
			<td class="atr_coluna"><b>Coluna do BDR</b></td>
			<td class="atr_check" align="center"><b>PK</b></td>
			<td class="atr_excl" align="center"><b>Excl.</b></td>
			<td class="atr_mover" align="center"><b>Mover</b></td>
		</tr>
	</table>
	
	<!-- Lista de atributos -->
	<div id="atributos"></div>
</div>
<br/>

<div align="center">
	<div id="mensagem">&nbsp;</div>
	<br/>
	<input type="submit" value="Editar Estrutura de Classes"/>
</div>

</form>

<?php
	// Rodapé
	include_once('includes/incRodape.php');
}
